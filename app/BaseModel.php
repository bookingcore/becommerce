<?php
namespace App;

use App\Traits\HasSEO;
use App\Traits\HasSlug;
use App\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Modules\Media\Helpers\FileHelper;
use Modules\User\Models\UserWishList;

class BaseModel extends Model
{
    use HasTranslations;
    use HasSEO;
    use HasSlug;

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
        return $this->belongsTo("App\User", "author_id");
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
        return status_to_text($this->status);
    }
    public function getStatusBadgeAttribute(){
        switch ($this->status){
            case "publish":
            case "paid":
            case "completed":
                return "success";
                break;
            case "pending":
                return "warning";
                break;
            case "rejected":
                return "danger";
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

    public function isReviewRequirePurchase(){
        return true;
    }
    public function isBought(){
        return true;
    }

}
