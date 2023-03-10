<?php
namespace Modules\Product\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\News\Models\News;
use Modules\News\Models\NewsTag;
use Modules\Theme\ThemeManager;
use Themes\Base\Database\Factories\ProductTagFactory;

class ProductTag extends BaseModel
{
    use HasFactory;

    protected $table = 'product_tags';
    protected $fillable      = [
        'name',
        'content',
        'slug'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'name';
    protected $seo_type = 'product_tags';

    public static function getModelName()
    {
        return __("Product Tag");
    }

    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'name');
        if ($q) {
            $query->where('name', 'like', "%" . $q . "%");
        }
        $a = $query->limit(10)->get();
        return $a;
    }

    public static function saveTagByName($tag_name)
    {
        $ids = [];
        if (!empty($tag_name)) {
            foreach ($tag_name as $name) {
                $find = parent::where('name', trim($name))->first();
                if (empty($find)) {
                    $tag = new self();
                    $tag->name = $name;
                    $tag->save();
                    $ids[] = $tag->id;
                } else {
                    $ids[] = $find->id;
                }
            }
        }
        return $ids;
    }

    public function getDetailUrl($locale = false)
    {
        return route('product.tag',['slug'=>$this->slug]);
    }

    public static function search($filters = []){
        return parent::query();
    }

    public function products(){
        return $this->belongsToMany(Product::class,ProductTagRelation::getTableName(),'tag_id','target_id');
    }


    protected static function newFactory()
    {
        return ProductTagFactory::new();
    }
}
