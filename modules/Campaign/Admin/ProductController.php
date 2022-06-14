<?php


namespace Modules\Campaign\Admin;


use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Campaign\Models\Campaign;
use Modules\Campaign\Models\CampaignProduct;
use Modules\Product\Models\Product;

class ProductController extends AdminController
{

    public $campaign_product;
    public $product;

    public function __construct(CampaignProduct $campaign_product,Product $product)
    {
        parent::__construct();
        $this->campaign_product = $campaign_product;
        $this->product = $product;
    }

    public function add(Campaign $campaign,Request $request){
        $this->checkPermission('campaign_create');

        $request->validate([
            'product_id'=>'required'
        ]);

        $item  = CampaignProduct::firstOrNew([
            'product_id'=>$request->input('product_id'),
            'campaign_id'=>$campaign->id
        ]);

        $item->status = $campaign->status;
        $item->start_date = $campaign->start_date;
        $item->end_date = $campaign->end_date;
        $item->discount_amount = $campaign->discount_amount;
        $item->save();

        return redirect()->back()->with('success',__("Product Added"));

    }

    public function search(Campaign $campaign,Request $request)
    {
        $query = $this->product::query()->select('products.*')
            ->leftJoin('campaign_products', function ($join) {
                $join->on('campaign_products.product_id', 'products.id');
            })
            ->leftJoin('campaigns', function ($join) use ($campaign) {
                $join->on('campaigns.id', 'campaign_products.campaign_id');
                $join->where(function($q) use ($campaign){
                    $q->where('campaigns.start_date','<=', $campaign->end_date->format('Y-m-d 23:59:59'));
                    $q->where('campaigns.end_date','>=', $campaign->start_date->format('Y-m-d'));
                });
            })
            ->whereNull('campaigns.id');
        if ($s = $request->query('q')) {
            $query->where('products.title', 'like', '%' . $s . '%');
            $query->orWhere('products.id', '=', $s);
        }
        $res = [];
        foreach ($query->paginate(20) as $product) {
            $res[] = [
                'id' => $product->id,
                'text' => $product->title . ' - #' . $product->id
            ];
        }

        return [
            'results' => $res
        ];

    }

    public function bulkEdit(Request $request,Campaign $campaign)
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
                    $query = $this->campaign_product::where("id", $id);
                    $query->first()->delete();
                }
                return redirect()->back()->with('success', __('Deleted success!'));
                break;
            default:
                // Change status
                foreach ($ids as $id) {
                    $query = $this->campaign_product::where("id", $id);
                    $data = ['status' => $action];

                    $query->update($data);
                }
                return redirect()->back()->with('success', __('Update success!'));
                break;
        }


    }
}
