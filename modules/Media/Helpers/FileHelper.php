<?php
namespace Modules\Media\Helpers;

use Illuminate\Support\Facades\Storage;
use Modules\Media\Models\MediaFile;
use Intervention\Image\ImageManagerStatic as Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class FileHelper
{
    public static $defaultSize = [
        'thumb' => [
            150,
            150
        ],
        'medium' => [
            600,
            600
        ],
        'large' => [
            1024,
            1024
        ],
    ];

    public static function url($fileId, $size = 'medium',$resize = true)
    {
        if ($fileId instanceof MediaFile) {
            $file = $fileId;
        } else {
            $file = (new MediaFile())->findById($fileId);
        }
        if (empty($file)) {
            return false;
        }
        if (static::isImage($file) and Storage::disk('uploads')->exists($file->file_path)) {
            if(env('CF_ENABLE_IMAGE_RESIZE') and !in_array(strtolower($file->file_extension),['svg']))
            {
                $width = static::$defaultSize[$size][0] ?? $size;
                if($width == 'full') $width = '';
                return '/cdn-cgi/image/'.($width ? 'width='.$width : '').',quality=70,f=auto/uploads/'.$file->file_path;
            }else{
                $url = static::maybeResize($file, $size,$resize);
                return $url;
            }
        }
        return asset('uploads/' . $file->file_path);
    }

    public static function image($fileId, $size = 'medium')
    {
        if ($fileId instanceof MediaFile) {
            $file = $fileId;
        } else {
            $file = (new MediaFile())->findById($fileId);
        }
        return sprintf("<img src='%' align='%s'>", static::url($file, $size), $file->file_name);
    }

    protected static function maybeResize($fileObj, $size = '',$resize = true)
    {

        if ($size == 'full' or in_array(strtolower($fileObj->file_extension),['svg','bmp']))
            return asset('uploads/' . $fileObj->file_path);
        if (!isset($size, static::$defaultSize))
            $size = 'medium';
        $sizeData = static::$defaultSize[$size];
        if ($sizeData[0] >= $fileObj->file_width) {
            return asset('uploads/' . $fileObj->file_path);
        }
        $resizeFile = substr($fileObj->file_path, 0, strrpos($fileObj->file_path, '.')) . '-' . $sizeData[0] . '.' . $fileObj->file_extension;

        if (Storage::disk('uploads')->exists($resizeFile)) {
            return asset('uploads/' . $resizeFile);
        }elseif(!$resize){
            return asset('uploads/' . $fileObj->file_path);
        } else {

            $image_path = public_path('uploads/' . $fileObj->file_path);

            $mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $image_path);
            if(in_array($mime,['image/x-ms-bmp'])){
                return asset('uploads/' . $fileObj->file_path);
            }

            if(env('APP_RESIZE_SIMPLE'))
            {
                return static::resizeSimple($fileObj,$size);
            }

            // Start Resize
            $img = Image::make($image_path)->resize($sizeData[0], null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $resizeFile));

            return asset('uploads/' . $resizeFile);
        }
    }

    protected static function resizeSimple($fileObj,$size = ''){

        $resize = new ResizeImage(public_path('uploads/'.$fileObj->file_path));

        $sizeData = static::$defaultSize[$size];
        $resizeFile = substr($fileObj->file_path, 0, strrpos($fileObj->file_path, '.')) . '-' . $sizeData[0] . '.' . $fileObj->file_extension;

        $resize->resizeTo($sizeData[0], $sizeData[0], 'maxWidth');

        $resize->saveImage(public_path('uploads/'.$resizeFile), "100");

        return asset('uploads/' . $resizeFile);
    }

    public static function isImage($fileObj)
    {
        if (false !== mb_strpos($fileObj->file_type, "image") and in_array($fileObj->file_type,['image/jpg','image/jpeg','image/png','image/gif'])) {

            return true;
        } else {

            return false;
        }
    }

    public static function checkMimeIsImage($mime)
    {

        if (false !== mb_strpos($mime, "image") and $mime != "image/webp") {

            return true;
        } else {

            return false;
        }
    }

    public static function fieldUpload($inputId = '', $oldValue = '',$nameAttr='name')
    {

        if(!empty($oldValue))
        $file = (new MediaFile())->findById($oldValue);
        ob_start();
        ?>
        <div class="bc-upload-box bc-upload-box-normal <?php if (!empty($file)) echo 'active' ?>" data-val="<?php echo $oldValue ?>">
            <div class="upload-box" v-show="!value">
                <input type="hidden" <?php echo $nameAttr;?>="<?php echo $inputId ?>" v-model="value" value="<?php echo $oldValue ?>">
                <div class="text-center">
                    <img src="/module/media/img.svg" alt="">
                </div>
                <div class="text-center">
                    <span class="btn btn-default btn-field-upload" @click="openUploader"><?php echo __("Upload image") ?></span>
                </div>
            </div>
            <div class="attach-demo" title="Change file">
                <?php if (!empty($file)) {
                    printf('<img src="%s" class="image-responsive">', FileHelper::url($oldValue, 'thumb'));
                } ?>
            </div>
            <div class="upload-actions justify-content-between" v-show="value">
                <span></span>
                <a class="delete btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public static function fieldGalleryUpload($inputId = '', $oldValue = '')
    {

        $oldIds = $oldValue ? explode(',', $oldValue) : [];
        ob_start();
        ?>
        <div class="bc-upload-multiple <?php if (!empty($file))
            echo 'active' ?>" data-val="<?php echo $oldValue ?>">
            <div class="attach-demo d-flex">
                <?php
                foreach ($oldIds as $id) {
                    $file = (new MediaFile())->findById($id);
                    if (!empty($file)) {
                        printf('<div class="image-item"><div class="inner"><span class="delete btn btn-sm btn-danger"><i class="fa fa-trash"></i></span><img src="%s" class="image-responsive"></div></div>', FileHelper::url($file, 'thumb'));
                    }
                }
                ?>
            </div>
            <div class="upload-box" v-show="!value">
                <input type="hidden" name="<?php echo e($inputId) ?>" v-model="value" value="<?php echo htmlspecialchars($oldValue) ?>">
                <div class="text-left">
                    <span class="btn btn-info btn-sm btn-field-upload" @click="openUploader"><i class="fa fa-plus-circle"></i> <?php echo __("Select images") ?></span>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public static function fieldFileUpload($inputId = '', $oldValue = '', $type = '')
    {
        ob_start();
        ?>

        <div class="g-items lists_<?php echo e($type) ?>">
            <?php if(!empty($oldValue)): ?>
            <?php foreach($oldValue as $item): ?>
                <div class="item">
                    <div class="row">
                        <div class="col-md-2">
                            <input type="radio" <?php echo e($item->is_default == 1 ? 'checked' : '') ?> class="form-control" name="csv_default"  value="<?php echo e($item->file_id) ?>" />
                        </div>
                        <div class="col-md-8">
                            <input type="hidden" name="<?php echo e($inputId) ?>[]" value="<?php echo e($item->file_id) ?>" >
                            <i class="fa <?php echo e($item->media->file_extension == 'doc' || $item->media->file_extension == 'docx' ? 'fa-file-word-o' : 'fa-file-pdf-o') ?>"></i>
                            <?php echo e($item->media->file_name) ?>.<?php echo e($item->media->file_extension) ?>
                        </div>
                        <div class="col-md-2">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="bc-upload-multiple">
            <div class="upload-box" v-show="!value">
                <div class="text-left">
                    <span class="btn btn-info btn-sm btn-field-upload" data-type="<?php echo e($type) ?>" @click="openUploader(<?php echo e($type) ?>)"><i class="fa fa-plus-circle"></i> <?php echo __("Select files") ?></span>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}
