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

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::deleting(function($campaign){
            $campaign->campaign_products()->delete();
        });

    }

    public function save(array $options = [])
    {
        $res = parent::save($options); // TODO: Change the autogenerated stub
        $this->campaign_products()->update([
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'status'=>$this->status,
            'discount_amount'=>$this->discount_amount
        ]);
        return $res;
    }

    public function saveCloneByID($clone_id){
        $old = parent::find($clone_id);
        if(empty($old)) return false;

        $old->name = $old->name." - Copy";
        $new = $old->replicate();
        $new->save();
    }


    public function products(){
        return $this->belongsToMany(Product::class,CampaignProduct::getTableName(),'campaign_id','product_id');
    }

    public function campaign_products(){
        return $this->hasMany(CampaignProduct::class,'campaign_id');
    }

    public function isActiveNow(){
        if($this->status != 'active') return false;
        if($this->start_date->timestamp > time()) return false;
        if($this->end_date->timestamp < time()) return false;
        return true;
    }

}
