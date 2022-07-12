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


        public function getDetailUrl($locale = false)
        {

        }

        public static function search(Request $request)
        {
            $query = parent::query()->select("bc_locations.*");
            if(!empty( $service_name = $request->query("service_name") )){
                if( setting_item('site_enable_multi_lang') && setting_item('site_locale') != app()->getLocale() ){
                    $query->leftJoin('bc_location_translations', function ($join) {
                        $join->on('bc_locations.id', '=', 'bc_location_translations.origin_id');
                    });
                    $query->where('bc_location_translations.name', 'LIKE', '%' . $service_name . '%');

                }else{
                    $query->where('bc_locations.name', 'LIKE', '%' . $service_name . '%');
                }
            }
            $query->orderBy("id", "desc");
            $query->groupBy("bc_locations.id");
            $limit = min(20,$request->query('limit',9));
            return $query->with(['translations']);
        }


    }
