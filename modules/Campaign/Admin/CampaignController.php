<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 7/30/2019
 * Time: 1:56 PM
 */
namespace Modules\Campaign\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Campaign\Models\Campaign;
use Modules\Core\Helpers\AdminMenuManager;


class CampaignController extends AdminController
{
    /**
     * @var Campaign
     */
    protected $campaign;

    public function __construct(Campaign $campaign)
    {
        parent::__construct();
        AdminMenuManager::setActive('campaign');
        $this->campaign = $campaign;
    }

    public function index(Request $request)
    {
        $this->checkPermission('campaign_view');
        $query = $this->campaign::query() ;
        $query->orderBy('id', 'desc');
        if (!empty($s = $request->input('s'))) {
            $query->where('name', 'LIKE', '%' . $s . '%');
            $query->orderBy('name', 'asc');
        }

        $data = [
            'rows'               => $query->paginate(20),
            'breadcrumbs'        => [
                [
                    'name' => __('Campaign'),
                    'url'  => route('campaign.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Campaign Management")
        ];
        return view('Campaign::admin.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('campaign_create');
        $row = new Campaign();
        $data = [
            'row'            => $row,
            'enable_multi_lang'=>true,
            'breadcrumbs'    => [
                [
                    'name' => __('Campaigns'),
                    'url'  => route('campaign.admin.index')
                ],
                [
                    'name'  => __('Create Campaign'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__('Create Campaign'),
            'product'=>$row
        ];

        return view('Campaign::admin.detail', $data);

    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('campaign_update');
        $row = $this->campaign::find($id);
        if (empty($row)) {
            return redirect(route('campaign.admin.index'));
        }

        $data = [
            'row'            => $row,
            'breadcrumbs'    => [
                [
                    'name' => __('Campaigns'),
                    'url'  => route('campaign.admin.index')
                ],
                [
                    'name'  => __('Edit Campaign'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Edit: :name",['name'=>$row->title]),
            'product'=>$row
        ];

        return view('Campaign::admin.detail', $data);
    }

    public function store( Request $request, $id ){

        $request->validate([
            'name'=>'required',
            'start_date'=>'required|date:Y-m-d',
            'end_date'=>'required|date:Y-m-d',
        ]);

        if($id>0){
            $this->checkPermission('campaign_update');
            $row = $this->campaign::find($id);
            if (empty($row)) {
                return redirect(route('campaign.admin.index'));
            }

        }else{
            $this->checkPermission('campaign_create');
            $row = new $this->campaign();
        }
        $dataKeys = [
            'name',
            'start_date',
            'end_date',
            'discount_amount',
            'status',
        ];


        $row->fillByAttr($dataKeys,$request->input());

        $res = $row->save();

        if ($res) {
            if($id > 0 ){
                return back()->with('success',  __('Campaign updated') );
            }else{
                return redirect(route('campaign.admin.edit',$row->id))->with('success', __('Campaign created') );
            }
        }
    }

    public function bulkEdit(Request $request)
    {

        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }

        switch ($action){
            case "delete":
                foreach ($ids as $id) {
                    $query = $this->campaign::where("id", $id);
                    $query->first()->delete();
                }
                return redirect()->back()->with('success', __('Deleted success!'));
                break;
            case "clone":
                $this->checkPermission('campaign_create');
                foreach ($ids as $id) {
                    (new $this->campaign())->saveCloneByID($id);
                }
                return redirect()->back()->with('success', __('Clone success!'));
                break;
            default:
                // Change status
                foreach ($ids as $id) {
                    $query = $this->campaign::where("id", $id);
                    $data = ['status' => $action];

                    $query->update($data);
                }
                return redirect()->back()->with('success', __('Update success!'));
                break;
        }


    }

}
