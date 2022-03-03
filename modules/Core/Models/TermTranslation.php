<?php
namespace Modules\Core\Models;

use App\BaseModel;

class TermTranslation extends BaseModel
{
    protected $table = 'core_terms_translations';
    protected $fillable = [
        'name',
        'content',
    ];
    protected $cleanFields = [
        'content'
    ];
}
