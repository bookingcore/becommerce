<?php
namespace Modules\Product\Models;

use App\BaseModel;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends BaseModel
{
    use NodeTrait;
    protected $table = 'product_category';
    protected $fillable = [
        'name',
        'content',
        'slug',
        'status',
        'parent_id'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'name';

    public static function getModelName()
    {
        return __("Product Category");
    }

    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'name');
        if (strlen($q)) {
            $query->where('name', 'like', "%" . $q . "%");
        }
        $a = $query->limit(10)->get();
        return $a;
    }

    public static function getCachedTree(){
        return parent::query()->where('status','publish')->get()->toTree();
    }

    public function getDetailUrl($locale = false)
    {
        return url(app_get_locale(false , false , '/')."category/".$this->slug);
    }
}
