<?php
namespace Modules\Core\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductTerm;
use Modules\Product\Models\ProductVariationTerm;

class Term extends BaseModel
{
    use SoftDeletes;
    protected $table = 'core_terms';
    protected $fillable = [
        'name',
        'content',
        'image_id',
        'icon',
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'name';

    protected $translation_class = TermTranslation::class;

    /**
     * @param $term_IDs array or number
     * @return mixed
     */
    static public function getTermsById($term_IDs){
        $listTerms = [];
        if(empty($term_IDs)) return $listTerms;
        $terms = parent::query()->with(['translations','attribute'])->find($term_IDs);
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
        return $this->hasOne(\Modules\Core\Models\Attribute::class, "id" , "attr_id");
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

    static public function getTermsByIdForAPI($term_IDs){
        $listTerms = null;
        if(empty($term_IDs)) return $listTerms;
        $terms = parent::query()->with(['translations','attribute'])->find($term_IDs);
        if(!empty($terms)){
            foreach ($terms as $term){
                $attr = $term->attribute;
                $attrTranslation = $attr->translate(app()->getLocale());
                $dataAttr = array(
                    'id'=>$attr->id,
                    'title'=>$attrTranslation->name,
                    'slug'=>$attr->slug,
                    'service'=>$attr->service,
                    'display_type'=>$attr->display_type,
                    'hide_in_single'=>$attr->hide_in_single,
                );
                if(!empty($dataAttr) and empty($dataAttr['hide_in_single'])){
                    if(empty($listTerms[$term->attr_id]['child'])) $listTerms[$term->attr_id]['parent'] = $dataAttr;
                    if(empty($listTerms[$term->attr_id]['child'])) $listTerms[$term->attr_id]['child'] = [];
                    $termTranslation = $term->translate(app()->getLocale());
                    $dataAttr = array(
                        'id'=>$term->id,
                        'title'=>$termTranslation->name,
                        'content'=>$term->content,
                        'image_id'=>get_file_url($term->image_id,'full'),
                        'icon'=>$term->icon,
                        'attr_id'=>$term->attr_id,
                        'slug'=>$term->slug,
                    );
                    $listTerms[$term->attr_id]['child'][] = $dataAttr;
                }
            }
        }
        return $listTerms;
    }

    public function dataForApi(){
        $translation = $this->translate(app()->getLocale());
        return [
            'id'=>$this->id,
            'name'=>$translation->name,
            'slug'=>$this->slug,
        ];
    }


    public function product(){
        return $this->belongsToMany(Product::class, ProductTerm::getTableName(),'term_id','target_id');
    }
}
