<?php


namespace Modules\Product\Models\Downloadable;


use App\BaseModel;

class DownloadLog extends BaseModel
{

    protected $table = 'product_download_logs';

    protected $fillable = [
        'download_id',
        'user_id',
        'ip_address'
    ];
}
