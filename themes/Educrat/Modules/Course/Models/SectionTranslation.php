<?php
namespace Themes\Educrat\Modules\Course\Models;

use App\BaseModel;

class SectionTranslation extends BaseModel
{
    protected $table = 'course_section_translations';
    protected $fillable = [
        'name',
    ];
}
