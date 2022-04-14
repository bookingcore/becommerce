<?php
namespace Modules\Page\Models;

use App\BaseModel;
use App\Models\BaseMeta;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageMeta extends BaseMeta
{
    protected $table = 'core_page_meta';
}
