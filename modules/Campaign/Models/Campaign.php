<?php


namespace Modules\Campaign\Models;


use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\SEO;

class Campaign extends BaseModel
{

    use SoftDeletes;
    protected $table = 'campaigns';

    public function saveCloneByID($clone_id){
        $old = parent::find($clone_id);
        if(empty($old)) return false;

        $old->name = $old->name." - Copy";
        $new = $old->replicate();
        $new->save();
    }
}
