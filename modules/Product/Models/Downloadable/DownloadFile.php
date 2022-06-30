<?php


namespace Modules\Product\Models\Downloadable;


use App\BaseModel;
use Modules\Media\Models\MediaFile;

class DownloadFile extends BaseModel
{

    protected $table = 'product_downloadable';

    protected $fillable = [
        'product_id',
        'file_id'
    ];

    public function file(){
        return $this->belongsTo(MediaFile::class,'file_id');
    }
}
