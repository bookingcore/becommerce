<?php


namespace App\Models;


use App\BaseModel;
use App\Traits\HasMeta;

class BaseMeta extends BaseModel
{
    use HasMeta;
    public $meta_parent_key = 'parent_id';

    protected $fillable = [
        'name',
        'val',
    ];
}
