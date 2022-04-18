<?php


namespace Modules\Campaign\Models;


use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\SEO;
use Modules\Product\Models\Product;

class Campaign extends BaseModel
{

    use SoftDeletes;
    protected $table = 'campaigns';

    protected $casts  = [
        'start_date'=>'date',
        'end_date'=>'date',
    ];

    public function saveCloneByID($clone_id){
        $old = parent::find($clone_id);
        if(empty($old)) return false;

        $old->name = $old->name." - Copy";
        $new = $old->replicate();
        $new->save();
    }


    public function products(){
        return $this->hasManyThrough(Product::class,CampaignProduct::class,'campaign_id','id','product_id','product_id');
    }
}
