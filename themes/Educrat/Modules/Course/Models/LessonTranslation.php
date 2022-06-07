<?php
namespace Themes\Educrat\Modules\Course\Models;

use App\BaseModel;

class LessonTranslation extends BaseModel
{
    protected $table = 'terms_translations';
    protected $fillable = [
        'name',
        'content',
    ];
    protected $cleanFields = [
        'content'
    ];
}
