<?php
namespace Modules\Product\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTag extends BaseModel
{
    protected $table = 'product_tag';
    protected $fillable = [
        'target_id',
        'tag_id'
    ];

    public static function getModelName()
    {
        return __("Product Tag");
    }

    public static function searchForMenu($q = false)
    {

    }

    public function tag()
    {
        return $this->belongsTo('Modules\Product\Models\ProductTag');
    }

    public static function getAll()
    {
        return self::with('tag')->get();
    }

    public static function addTag($tags_ids, $news_id)
    {
        if (!empty($tags_ids)) {
            foreach ($tags_ids as $tag_id) {
                $find = parent::where('target_id', $news_id)->where('tag_id', $tag_id)->first();
                if (empty($find)) {

                    $a = new self();
                    $a->news_id = $news_id;
                    $a->tag_id = $tag_id;
                    $a->save();
                }
            }
        }
    }

    public static function getTags(){

        $query = Tag::query()->with('translations');

        $query->select(['core_tags.*']);

        return $query
            ->join('product_tag as nt','nt.tag_id','=','core_tags.id')->orderByRaw('RAND()')
            ->groupBy('core_tags.id')
            ->get(10);

    }
}
