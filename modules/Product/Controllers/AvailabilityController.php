<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/2/2019
 * Time: 9:43 AM
 */
namespace Modules\Product\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Product\Models\Product;
use Modules\FrontendController;
use Modules\Product\Models\Space;
use Modules\Product\Models\SpaceDate;

class AvailabilityController extends FrontendController{

    protected $spaceClass;
    /**
     * @var SpaceDate
     */
    protected $spaceDateClass;

    /**
     * @var Booking
     */
    protected $bookingClass;

    protected $indexView = 'Space::frontend.user.availability';

    public function __construct()
    {
        parent::__construct();
        $this->spaceClass = Space::class;
        $this->spaceDateClass = SpaceDate::class;
        $this->bookingClass = Booking::class;
    }

    public function index(Request $request){
        $this->checkPermission('space_create');

        $q = $this->spaceClass::query();

        if($request->query('s')){
            $q->where('title','like','%'.$request->query('s').'%');
        }

        if(!$this->hasPermission('space_manage_others')){
            $q->where('create_user',$this->currentUser()->id);
        }

        $q->orderBy('bc_spaces.id','desc');

        $rows = $q->paginate(15);

        $current_month = strtotime(date('Y-m-01',time()));

        if($request->query('month')){
            $date = date_create_from_format('m-Y',$request->query('month'));
            if(!$date){
                $current_month = time();
            }else{
                $current_month = $date->getTimestamp();
            }
        }
        $breadcrumbs = [
            [
                'name' => __('Spaces'),
                'url'  => 'admin/module/space'
            ],
            [
                'name'  => __('Availability'),
                'class' => 'active'
            ],
        ];
        $page_title = __('Spaces Availability');

        return view($this->indexView,compact('rows','breadcrumbs','current_month','page_title','request'));
    }

    public function loadDates(Request $request){

        $request->validate([
            'id'=>'required',
            'start'=>'required',
            'end'=>'required',
        ]);

        $space = $this->spaceClass::find($request->query('id'));
        if(empty($space)){
            return $this->sendError(__('Space not found'));
        }

        $query = $this->spaceDateClass::query();
        $query->where('target_id',$request->query('id'));
        $query->where('start_date','>=',date('Y-m-d H:i:s',strtotime($request->query('start'))));
        $query->where('end_date','<=',date('Y-m-d H:i:s',strtotime($request->query('end'))));

        $rows =  $query->take(40)->get();
        $allDates = [];

        for($i = strtotime($request->query('start')); $i <= strtotime($request->query('end')); $i+= DAY_IN_SECONDS)
        {
            $date = [
                'id'=>rand(0,999),
                'active'=>0,
                'price'=>(!empty($space->sale_price) and $space->sale_price > 0 and $space->sale_price < $space->price) ? $space->sale_price : $space->price,
                'is_instant'=>$space->is_instant,
                'is_default'=>true,
                'textColor'=>'#2791fe'
            ];
            $date['price_html'] = format_money($date['price']);
            $date['title'] = $date['event']  = $date['price_html'];
            $date['start'] = $date['end'] = date('Y-m-d',$i);

            if($space->default_state){
                $date['active'] = 1;
            }else{
                $date['title'] = $date['event'] = __('Blocked');
                $date['backgroundColor'] = 'orange';
                $date['borderColor'] = '#fe2727';
                $date['classNames'] = ['blocked-event'];
                $date['textColor'] = '#fe2727';
            }
            $allDates[date('Y-m-d',$i)] = $date;
        }
        if(!empty($rows))
        {
            foreach ($rows as $row)
            {
                $row->start = date('Y-m-d',strtotime($row->start_date));
                $row->end = date('Y-m-d',strtotime($row->start_date));
                $row->textColor = '#2791fe';
                $row->title = $row->event = format_money($row->price);

                if(!$row->active)
                {
                    $row->title = $row->event = __('Blocked');
                    $row->backgroundColor = '#fe2727';
                    $row->classNames = ['blocked-event'];
                    $row->textColor = '#fe2727';
                }else{
                    $row->classNames = ['active-event'];
                    if($row->is_instant){
                        $row->title = '<i class="fa fa-bolt"></i> '.$row->title;
                    }
                }

                $allDates[date('Y-m-d',strtotime($row->start_date))] = $row;

            }
        }

        if($request->input('for_single'))
        {
            $bookings = $this->bookingClass::getBookingInRanges($space->id,$space->type,$request->query('start'),$request->query('end'));
            if(!empty($bookings))
            {
                foreach ($bookings as $booking){
                    for($i = strtotime($booking->start_date); $i <= strtotime($booking->end_date); $i+= DAY_IN_SECONDS){
                        if(isset($allDates[date('Y-m-d',$i)])){
                            $allDates[date('Y-m-d',$i)]['active'] = 0;
                        }
                    }
                }
            }
        }

        $data = array_values($allDates);

        return response()->json($data);
    }

    public function store(Request $request){

        $request->validate([
            'target_id'=>'required',
            'start_date'=>'required',
            'end_date'=>'required'
        ]);

        $space = $this->spaceClass::find($request->input('target_id'));
        $target_id = $request->input('target_id');

        if(empty($space)){
            return $this->sendError(__('Space not found'));
        }

        if(!$this->hasPermission('space_manage_others')){
            if($space->create_user != Auth::id()){
                return $this->sendError("You do not have permission to access it");
            }
        }

        $postData = $request->input();
        for($i = strtotime($request->input('start_date')); $i <= strtotime($request->input('end_date')); $i+= DAY_IN_SECONDS)
        {
            $date = SpaceDate::where('start_date',date('Y-m-d',$i))->where('target_id',$target_id)->first();

            if(empty($date)){
                $date = new SpaceDate();
                $date->target_id = $target_id;
            }
            $postData['start_date'] = date('Y-m-d H:i:s',$i);
            $postData['end_date'] = date('Y-m-d H:i:s',$i);


            $date->fillByAttr([
                'start_date','end_date','price',
                'is_instant','active',
            ],$postData);

            $date->save();
        }

        return $this->sendSuccess([],__("Update Success"));

    }
}
