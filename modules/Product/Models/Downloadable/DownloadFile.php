<?php


namespace Modules\Product\Models\Downloadable;


use App\BaseModel;

class DownloadFile extends BaseModel
{

    protected $table = 'product_downloadable';

    protected $fillable = [
        'product_id',
        'file_id'
    ];
}
