<?php


namespace Modules\Product\Traits;


use Modules\Media\Models\MediaFile;
use Modules\Product\Models\Downloadable\DownloadFile;

Trait HasDownloadable
{
    public function download_files(){
        return $this->hasMany(DownloadFile::class,'product_id');
    }

    public function files(){
        return $this->belongsToMany(MediaFile::class,DownloadFile::getTableName(),'product_id','file_id');
    }
}
