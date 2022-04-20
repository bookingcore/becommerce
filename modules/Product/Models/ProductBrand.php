<?php
namespace Modules\Product\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Theme\ThemeManager;

class ProductBrand extends BaseModel
{
    use HasFactory;
    protected $table = 'product_brand';
    protected $fillable = [
        'name',
        'content',
        'slug',
        'status',
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'name';

    public static function getModelName()
    {
        return __("Product Brand");
    }

    protected static function newFactory()
    {
        $active = ThemeManager::current();
        $class = "\Themes\\".ucfirst($active)."\\Database\\Factories\\ProductBrandFactory";
        if(class_exists($class)) {
            return new $class();
        }
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
    public function products(){
		return $this->hasMany(Product::class,'brand_id');
    }
}
