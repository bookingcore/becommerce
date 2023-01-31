<?php

    namespace Modules\Location\Models;

    use App\BaseModel;
    use Illuminate\Http\Request;
    use Kalnoy\Nestedset\NodeTrait;
    use Modules\Media\Helpers\FileHelper;

    class Location extends BaseModel
    {
        use NodeTrait;
        protected $table         = 'locations';
        protected $fillable      = [
            'name',
            'sub_title',
            'image_id',
            'map_lat',
            'map_lng',
            'map_zoom',
            'status',
            'parent_id',
            'zipcode'
        ];
        protected $slugField     = 'slug';
        protected $slugFromField = 'name';
        protected $seo_type      = 'location';

        protected $translation_class = LocationTranslation::class;
        public $table_translation = 'location_translations';

        protected static $_cached = [];

        public static function getModelName()
        {
            return __("Location");
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

        public function getImageUrl($size = "medium")
        {
            $url = FileHelper::url($this->image_id, $size);
            return $url ? $url : '';
        }

        public static function getActive(){
            if(isset(static::$_cached['all'])) return static::$_cached['all'];

            return static::$_cached['all'] = parent::query()->where('status','publish')->get();
        }
    }
