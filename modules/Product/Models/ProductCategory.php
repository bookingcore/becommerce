<?php
namespace Modules\Product\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Modules\Core\Traits\BCSearchable;
use Themes\Base\Database\Factories\ProductCategoryFactory;

class ProductCategory extends BaseModel
{
    use NodeTrait,HasFactory;
    use BCSearchable;
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

    protected static $_all = null;

    public static function getModelName()
    {
        return __("Product Category");
    }

    protected $translation_class = ProductCategoryTranslation::class;

    protected static function newFactory()
    {
        return ProductCategoryFactory::new();
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
        return route('product.category.index',['slug'=>$this->slug]);
    }

    public static function getAll(){
        if(!empty(static::$_all)) return static::$_all;
        return static::$_all = parent::query()->where('status','publish')->with(['translation'])->limit(999)->get()->toTree();
    }

    public function parent(){
        return $this->belongsTo(self::class,'parent_id');
    }
    public function child(){
        return $this->hasMany(self::class,'parent_id');
    }

    public function product(){
        return $this->hasManyThrough(Product::class, ProductCategoryRelation::class,'cat_id','id','id','target_id');
    }
    /**
     * @return bool
     */
    public static function usesSoftDelete()
    {
        static $softDelete;

        if (is_null($softDelete)) {
            $instance = new static;

            return $softDelete = method_exists($instance, 'bootSoftDeletes');
        }

        return $softDelete;
    }

    public function toSearchableArray()
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'image'=>get_file_url($this->image_id),
            'url'=>$this->getDetailUrl()
        ];
    }
}
