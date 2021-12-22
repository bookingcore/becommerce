<?php
namespace Modules\Core\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Terms extends BaseModel
{
    use SoftDeletes;
    protected $table = 'core_terms';
    protected $fillable = [
        'name',
        'content'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'name';

    /**
     * @param $term_IDs array or number
     * @return mixed
     */
    static public function getTermsById($term_IDs){
        $listTerms = [];
        if(empty($term_IDs)) return $listTerms;
        $terms = parent::find($term_IDs);
        if(!empty($terms)){
            foreach ($terms as $term){
                if(!empty($attr = $term->attribute)){
                    if(empty($listTerms[$term->attr_id]['child'])) $listTerms[$term->attr_id]['parent'] = $attr;
                    if(empty($listTerms[$term->attr_id]['child'])) $listTerms[$term->attr_id]['child'] = [];
                    $listTerms[$term->attr_id]['child'][] = $term;
                }
            }
        }
        return $listTerms;
    }

    public function attribute()
    {
        return $this->hasOne("Modules\Core\Models\Attributes", "id" , "attr_id");
    }


    public static function getForSelect2Query($service,$q=false)
    {
        $query =  static::query()->select('core_terms.id', DB::raw('CONCAT(at.name,": ",core_terms.name) as text'))
        ->join('core_attrs as at','at.id','=','core_terms.attr_id')
        ->where("at.service",$service)
        ->whereRaw("at.deleted_at is null");

        if ($query) {
            $query->where('core_terms.name', 'like', '%' . $q . '%');
        }
        return $query;
    }

}
