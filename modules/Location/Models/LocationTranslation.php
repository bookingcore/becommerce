<?php
namespace Modules\Location\Models;

use App\BaseModel;

class LocationTranslation extends BaseModel
{
    protected $table = 'location_translations';

    protected $fillable = ['name','content'];

    protected $seo_type = 'location_translation';
}
