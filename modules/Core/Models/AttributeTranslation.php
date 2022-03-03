<?php
namespace Modules\Core\Models;

use App\BaseModel;

class AttributeTranslation extends BaseModel
{
    protected $table = 'core_attrs_translations';
    protected $fillable = [
        'name',
    ];
}
