<?php
namespace App;

use App\Traits\HasSEO;
use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Core\Models\SEO;
use Modules\Media\Helpers\FileHelper;
use Modules\User\Models\UserWishList;

class BaseModel extends Model
{
    use HasTranslations;
    use HasSEO;
    protected $dateFormat    = 'Y-m-d H:i:s';
    protected $slugField     = '';
    protected $slugFromField = '';
    protected $cleanFields = [];
    protected $seo_type;

    public $type = 'default';// For Translations

    public static function getModelName()
    {

    }

    public static function getAsMenuItem($id)
    {
        return false;
    }

    public static function searchForMenu($q = false)
    {
        return [];
    }

    public function save(array $options = [])
    {
        if ($this->create_user) {
            $this->update_user = Auth::id();
        } else {
            $this->create_user = Auth::id();
        }
        if ($this->slugField && $this->slugFromField) {
            $slugField = $this->slugField;
            $this->$slugField = $this->generateSlug($this->$slugField);
        }
        $this->cleanFields();
        return parent::save($options); // TODO: Change the autogenerated stub
    }

    /**
     * @todo HTMLPurifier
     * @param array $fields
     */
    protected function cleanFields($fields = [])
    {
        if (empty($fields))
            $fields = $this->cleanFields;
        if (!empty($fields)) {
            foreach ($fields as $field) {

                if ($this->$field !== NULL) {
                    $this->$field = clean($this->$field,'youtube');
                }
            }
        }
    }

    public function generateSlug($string = false, $count = 0)
    {
        $slugFromField = $this->slugFromField;
        if (empty($string))
            $string = $this->$slugFromField;
        $slug = $newSlug = $this->strToSlug($string);
        $newSlug = $slug . ($count ? '-' . $count : '');
        $model = static::select('count(id)');
        if ($this->id) {
            $model->where('id', '<>', $this->id);
        }
        $check = $model->where($this->slugField, $newSlug)->count();
        if (!empty($check)) {
            return $this->generateSlug($slug, $count + 1);
        }
        return $newSlug;
    }

    // Add Support for non-ascii string
    // Example বাংলাদেশ   ব্যাংকের    রিজার্ভের  অর্থ  চুরির   ঘটনায়   ফিলিপাইনের
    protected function strToSlug($string) {
        $slug = Str::slug($string);
        if(empty($slug)){
            $slug = preg_replace('/\s+/u', '-', trim($string));
        }
        return $slug;
    }

    public function getDetailUrl()
    {
        return '';
    }

    public function getEditUrl()
    {
        return '';
    }

    public function author()
    {
        return $this->belongsTo("App\User", "author_id", "id");
    }

    public function cacheKey(){
        return strtolower($this->table);
    }

    public function findById($id)
    {
        return Cache::rememberForever($this->cacheKey() . ':' . $id, function () use ($id) {
            return $this->find($id);
        });
    }

    public function currentUser()
    {
        return Auth::user();
    }

    public function origin(){
        return $this->hasOne(get_class($this),'id','origin_id');
    }

    public function getIsTranslationAttribute(){
        if($this->origin_id) return true;
        return false;
    }

    public function getIsPublishedAttribute(){

        if($this->is_translation){

            $origin = $this->origin;

            if(empty($origin)) return false;
            return $origin->status == 'publish';
        }else{
            return $this->status == 'publish';
        }
    }


    public function fillData($attributes)
    {
        parent::fill($attributes);
    }

    public function fillByAttr($attributes , $input)
    {
        if(!empty($attributes)){
            foreach ( $attributes as $item ){
                $this->$item = isset($input[$item]) ? ($input[$item]) : null;
            }
        }
    }

    public function check_enable_review_after_booking(){

    }


    public static function getTableName()
    {
        return with(new static)->table;
    }

    public function hasPermissionDetailView(){
        if($this->status == "publish"){
            return true;
        }
        if(Auth::id() and $this->create_user == Auth::id() and Auth::user()->hasPermissionTo('dashboard_vendor_access')){
            return true;
        }
        return false;
    }

    public function getImageUrlAttribute($size = "medium")
    {
        $url = FileHelper::url($this->image_id, $size);
        return $url ? $url : '';
    }

    public function wishlist(){
        return $this->hasOne(UserWishList::class,'object_id')->where('object_model',$this->type);
    }

    public function getStatusTextAttribute(){
        switch ($this->status){
            case "publish":
                return __("Publish");
                break;
            case "draft":
                return __("Draft");
                break;
            case "pending":
                return __("Pending");
                break;
            case "in-progress":
                return __("In Progress");
                break;
            default:
                return ucfirst($this->status ?? '');
                break;
        }
    }
    public function getStatusBadgeAttribute(){
        switch ($this->status){
            case "publish":
                return "success";
                break;
            case "pending":
                return "warning";
                break;
            case "draft":
            default:
                return "secondary";
                break;
        }
    }

    public function scopeIsActive($query){
        return $query->where($this->table.'.status','publish');
    }

    public function getForSitemap(){
        $all = parent::query()->where('status','publish')->get();
        $res = [];
        foreach ($all as $item){
            $res[] = [
                'loc'=>$item->getDetailUrl(),
                'lastmod'=>date('c',strtotime($item->updated_at ? $item->updated_at : $item->created_at)),
            ];
        }
        return $res;
    }
}
