<?php
namespace Modules\Page\Models;

use App\BaseModel;
use App\Traits\HasMeta;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Template\Models\Template;

class Page extends BaseModel
{
    use SoftDeletes, HasMeta;

    protected $meta_parent_key = 'parent_id';
    protected $metaClass = PageMeta::class;

    protected $table = 'core_pages';
    protected $fillable = [
        'title',
        'content',
        'status',
        'short_desc',
        'image_id',
        'slug',
        'template_id',
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'title';
    protected $cleanFields = [
        'content',
    ];

    protected $casts = [
        'c_background'=>'array'
    ];

    public $translatedAttributes = [
        'title',
        'content',
        'short_desc',
    ];

    protected $seo_type = 'page';

    public function getDetailUrl($locale = false)
    {
        $locale = $locale ? $locale : app()->getLocale();

        return url(( $locale ? $locale.'/' : ''). config('page.page_route_prefix')."/".$this->slug);
    }

    public static function getModelName()
    {
        return __("Page");
    }

    public static function getAsMenuItem($id)
    {
        return parent::select('id', 'title as name')->find($id);
    }

    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'title as name');
        if (strlen($q)) {

            $query->where('title', 'like', "%" . $q . "%");
        }
        $a = $query->limit(10)->get();
        return $a;
    }

    protected function editUrl():Attribute {
        return Attribute::make(
            get:function($val,$attrs){
                return url('admin/module/page/edit/' . $attrs['id']);
            }
        );
    }

    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    public function getProcessedContent()
    {
        $template = $this->template;
        if(!empty($template)){
            $translation = $template->translate(app()->getLocale());
            return $translation->getProcessedContent();
        }
    }

}
