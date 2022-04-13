<?php
namespace Modules\Product\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTagRelation extends BaseModel
{
    protected $table = 'product_tag_relation';
    protected $fillable = [
        'target_id',
        'tag_id'
    ];

    public static function searchForMenu($q = false)
    {

    }

    public function tag()
    {
        return $this->belongsTo(ProductTag::class);
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
                    $a->target_id = $news_id;
                    $a->tag_id = $tag_id;
                    $a->save();
                }
            }
        }
    }

    public static function getTags(){

        $query = ProductTag::query()->with('translations');

        $query->select(['product_tags.*']);

        return $query
            ->join('product_tag_relation as nt','nt.tag_id','=','product_tags.id')
            ->groupBy('product_tags.id')
            ->get(10);

    }
}
