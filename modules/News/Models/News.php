<?php
namespace Modules\News\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Modules\Core\Models\SEO;
use Modules\Review\Models\Review;

class News extends BaseModel
{
    use SoftDeletes;
    protected $table = 'core_news';
    protected $fillable = [
        'title',
        'content',
        'status',
        'cat_id',
        'image_id',
        'author_id'
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'title';
    protected $seo_type = 'news';
    public $type  = 'news';

    protected $reviewClass;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->reviewClass = Review::class;
    }


    public $review_type = 'comment';

    public function getDetailUrlAttribute()
    {
        return url('news-' . $this->slug);
    }

    public function geCategorylink()
    {
        return route('news.category.index',['slug'=>$this->slug]);
    }

    public function cat()
    {
        return $this->belongsTo('Modules\News\Models\NewsCategory');
    }

    public static function getAll()
    {
        return self::with('cat')->get();
    }

    public function getDetailUrl($locale = false)
    {
        return url(app_get_locale(false,false,'/'). config('news.news_route_prefix')."/".$this->slug);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,NewsTag::getTableName(),'news_id','tag_id');
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

    public function saveTag($tags_name, $tag_ids)
    {

        if (empty($tag_ids))
            $tag_ids = [];
        $tag_ids = array_merge(Tag::saveTagByName($tags_name), $tag_ids);
        $tag_ids = array_filter(array_unique($tag_ids));
        // Delete unused
        NewsTag::whereNotIn('tag_id', $tag_ids)->where('news_id', $this->id)->delete();
        //Add
        NewsTag::addTag($tag_ids, $this->id);
    }

    static public function getSeoMetaForPageList()
    {
        $seo_title_array = array_values(array_filter([
            setting_item_with_lang('news_page_list_seo_title'),
            setting_item_with_lang('news_page_list_title'),
            __('News'),
        ]));

        $meta['seo_title'] = $seo_title_array[0];
        $meta['seo_desc'] = setting_item_with_lang("news_page_list_seo_desc");
        $meta['seo_image'] = setting_item("news_page_list_seo_image");
        $meta['seo_share'] = setting_item_with_lang("news_page_list_seo_share");
        $meta['full_url'] = url()->current();

        return $meta;
    }

    public function getEditUrl()
    {
        $lang = $this->lang ?? setting_item("site_locale");
        return route('news.admin.edit',['id'=>$this->id , "lang"=> $lang]);
    }

    public function dataForApi($forSingle = false){
        $translation = $this->translate(app()->getLocale());
        $data = [
            'id'=>$this->id,
            'slug'=>$this->slug,
            'title'=>$translation->title,
            'content'=>$translation->content,
            'image_id'=>$this->image_id,
            'image_url'=>get_file_url($this->image_id,'full'),
            'category'=>NewsCategory::selectRaw("id,name,slug")->find($this->cat_id) ?? null,
            'created_at'=>display_date($this->created_at),
            'author'=>[
                'display_name'=>$this->author->display_name,
                'avatar_url'=>$this->author->getAvatarUrl()
            ],
            'url'=>$this->getDetailUrl()
        ];
        return $data;
    }

    public function near_post(){
        $near_post = [$this->id - 1, $this->id + 1];
        return $this->query()->whereIn('id', $near_post)->get();
    }

    public static function search($filters = []){
        $query = parent::query()->select(['core_news.*']);
        if(!empty($filters['category_id'])){
            $query->where('cat_id',$filters['category_id']);
        }
        if (!empty($filters['s'])){
            $query->where('title','like',"%{$filters['s']}%")->orWhere('slug','like',"%{$filters['s']}%");
        }
        if(!empty($filters['tag_id']))
        {
            $query->join('core_news_tag',function($join) use ($filters) {
                $join->on('core_news_tag.news_id','=','core_news.id');
                $join->where('core_news_tag.tag_id',$filters['tag_id']);
                $join->whereNull('core_news_tag.deleted_at');
            });
        }
        $query->with(['translation','tags']);
        return $query->isActive();
    }

    public function getReviewEnable()
    {
        return setting_item("news_enable_comment", 0);
    }

    public function count_remain_review(){
        return true;
    }

    public function getReviewApproved()
    {
        return setting_item("news_comment_approved", 0);
    }

    public function updateServiceRate()
    {
        return true;
    }

    public function getReviewNumberPerPage()
    {
        return setting_item("news_review_number_per_page", 5);
    }

    public function isReviewRequirePurchase(){
        return false;
    }
    public function isBought()
    {
        return true;
    }

    public function review_list(){
        return $this->hasMany(Review::class,'object_id')
            ->where('object_model', $this->type)
            ->where("status", "approved");
    }

    public static function getReviewStats()
    {
        return [];
    }

    public static function getModelName()
    {
        return __("News");
    }

    public function getScoreReview()
    {
        $list_score = Cache::rememberForever('review_'.$this->type.'_' . $this->id, function ()  {
            $dataReview = $this->reviewClass::selectRaw(" AVG(rate_number) as score_total , COUNT(id) as total_review ")->where('object_id', $this->id)->where('object_model', $this->type)->where("status", "approved")->first();
            $score_total = !empty($dataReview->score_total) ? number_format($dataReview->score_total, 1) : 0;
            return [
                'score_total'  => $score_total,
                'total_review' => !empty($dataReview->total_review) ? $dataReview->total_review : 0,
                'review_text'   => $score_total ? Review::getDisplayTextScoreByLever( round( $score_total )) : __("Not rate"),
            ];
        });

        return $list_score;
    }

    public function getReviewDataAttribute()
    {
        $list_score = [
            'score_total'  => 0,
            'score_text'   => __("Not Rate"),
            'total_review' => 0,
            'rate_score'   => [],
        ];
        $dataTotalReview = $this->reviewClass::selectRaw(" AVG(rate_number) as score_total , COUNT(id) as total_review ")->where('object_id', $this->id)->where('object_model', $this->type)->where("status", "approved")->first();
        if (!empty($dataTotalReview->score_total)) {
            $list_score['score_total'] = number_format($dataTotalReview->score_total, 1);
            $list_score['score_text'] = Review::getDisplayTextScoreByLever(round($list_score['score_total']));
        }
        if (!empty($dataTotalReview->total_review)) {
            $list_score['total_review'] = $dataTotalReview->total_review;
        }
        for ($rate = 5; $rate >= 1; $rate--) {
            $number = $this->reviewClass::where('rate_number', $rate)->where('object_id', $this->id)->where('object_model', $this->type)->where("status", "approved")->count();
            if (!empty($list_score['total_review'])) {
                $percent = ($number / $list_score['total_review']) * 100;
            } else {
                $percent = 0;
            }
            $list_score['rate_score'][$rate] = [
                'title'   => $this->reviewClass::getDisplayTextScoreByLever($rate),
                'total'   => $number,
                'percent' => round($percent),
            ];
        }
        return $list_score;
    }


    public function reviewsCount($with_text = false){
        $count = Review::query()->where('object_id', $this->id)
            ->where('object_model', 'news')
            ->where("status", "approved")
            ->orderBy("id", "desc")->count();
        if($with_text){
            return $count .' ' . ($count == 1 ? __("review") : __("reviews"));
        }else{
            return $count;
        }
    }

    public function related(){
        return $this->hasMany(News::class,'cat_id','cat_id')->where('status','publish')->where('id','!=',$this->id)->with(['translation']);
    }


    public function comments(){
        return $this->hasMany(Review::class,'object_id')->where('object_model','news');
    }
    public function category(){
        return $this->belongsTo(NewsCategory::class,'cat_id');
    }
}
