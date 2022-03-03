<?php
namespace Modules\Core\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends BaseModel
{
    use SoftDeletes;
    protected $table = 'core_attrs';
    protected $fillable = ['name','hide_in_single','hide_in_filter_search','position','status'];
    protected $slugField = 'slug';
    protected $slugFromField = 'name';

    protected $translation_class = AttributeTranslation::class;

    public function terms()
    {
        return $this->hasMany(Term::class, 'attr_id', 'id');
    }


    public static function getAllAttributesForApi($service_type){
        $data = [];
        $attributes = Attribute::selectRaw("id,name,slug,service")->where('service', $service_type)->get();
        foreach ($attributes as $item){
            $translation = $item->translate(app()->getLocale());
            $list_terms = $item->terms;
            $data[] = [
                'id'    => $item->id,
                'name'  => $translation->name,
                'slug'  => $item->slug,
                'terms' => $list_terms->map(function ($term) {
                    return $term->dataForApi();
                })
            ];
        }
        return $data;
    }
}
