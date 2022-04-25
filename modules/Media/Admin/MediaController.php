<?php
namespace Modules\Media\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Modules\AdminController;
use Modules\Media\Helpers\FileHelper;
use Modules\Media\Models\MediaFile;
use Intervention\Image\ImageManagerStatic as Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class MediaController extends Controller
{
    public function index(Response $request){
        $this->setActiveMenu(route('media.admin.index'));
        $data = [
            'page_title'=>__("Media Management"),
            'breadcrumbs'        => [
                [
                    'name' => __('Media Management'),
                    'url'  => route('media.admin.index')
                ],
            ]
        ];
        return view('Media::admin.index', $data);
    }

    public function sendError($message, $data = [])
    {
        $data['uploaded'] = 0;
        $data['error'] = [
            "message"=>$message
        ];

        return parent::sendError($message,$data);
    }

    public function sendSuccess($data = [], $message = '')
    {
        $data['uploaded'] = 1;

        if(!empty($data['data']->file_name))
        {
            $data['fileName'] = $data['data']->file_name;
            $data['url'] = FileHelper::url($data['data']->id,'full');
        }
        return parent::sendSuccess($data, $message); // TODO: Change the autogenerated stub
    }

    public function compressAllImages(){
        $files = MediaFile::get();

        if(!empty($files))
        {
            foreach ($files as $file)
            {
                if(FileHelper::isImage($file))
                {
                    if(Storage::disk('uploads')->exists('public/'.$file->file_path))
                    {
                        if(function_exists('proc_open')){
                            try{
                                   // ImageOptimizer::optimize(public_path('app/public/'.$file->file_path));
                                }catch (\Exception $exception){

                            }
                        }

                    }

                }
            }
        }

        echo "Processed: ".count($files);
    }

    public function store(Request $request)
    {
        if(!$user_id = Auth::id()){
            return $this->sendError(__("Please log in"));
        }

        $ckEditor = $request->query('ckeditor');

        if (!$this->hasPermissionMedia()) {
            return $this->sendError('There is no permission upload');
        }
        $fileName = 'file';
        if($ckEditor) $fileName = 'upload';

        $file = $request->file($fileName);
        $file_type = $request->input('type');
        if (empty($file)) {
            return $this->sendError(__("Please select file"));
        }
        try {
            static::validateFile($file, $file_type);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
        $folder = '';
        $id = Auth::id();
        $driver = config('filesystems.default','uploads');
        if ($id) {
            $folder .= sprintf('%04d', (int)$id / 1000) . '/' . $id . '/';
        }
        $folder = $folder . date('Y/m/d');
        $newFileName = Str::slug(substr($file->getClientOriginalName(), 0, strrpos($file->getClientOriginalName(), '.')));
        if(empty($newFileName)) $newFileName = md5($file->getClientOriginalName());

        $i = 0;

            do {
                $newFileName2 = $newFileName . ($i ? $i : '');
                $testPath = $folder . '/' . $newFileName2 . '.' . $file->getClientOriginalExtension();
                $i++;
            } while (Storage::disk($driver)->exists($testPath));

            $check = $file->storeAs( $folder, $newFileName2 . '.' . $file->getClientOriginalExtension(),$driver);
        $width = $height = 0;
        if (FileHelper::checkMimeIsImage($file->getMimeType())) {
            [$width, $height, $type, $attr] = getimagesize($file);
        }
        // Try to compress Images
        if(function_exists('proc_open') and function_exists('escapeshellarg')){
            try{
               // ImageOptimizer::optimize(public_path("uploads/".$check));
            }catch (\Exception $exception){

            }
        }
        if ($check) {
            try {
                $fileObj = new MediaFile();
                $fileObj->file_name = $newFileName2;
                $fileObj->file_path = $check;
                $fileObj->file_size = $file->getSize();
                $fileObj->file_type = $file->getMimeType();
                $fileObj->file_extension = $file->getClientOriginalExtension();
                $fileObj->file_width = $width;
                $fileObj->file_height = $height;
                $fileObj->driver = $driver;

                $fileObj->save();
                // Sizes use for uploaderAdapter:
                // https://ckeditor.com/docs/ckeditor5/latest/framework/guides/deep-dive/upload-adapter.html#the-anatomy-of-the-adapter
                $fileObj->sizes = [
                    'default' => $fileObj->view_url,
                    '150'     => url('media/preview/'.$fileObj->id .'/thumb'),
                    '600'     => url('media/preview/'.$fileObj->id .'/medium'),
                    '1024'    => url('media/preview/'.$fileObj->id .'/large'),
                ];
                return $this->sendSuccess(['data' => $fileObj]);
            } catch (\Exception $exception) {
                Storage::disk($driver)->delete($check);
                return $this->sendError($exception->getMessage());
            }
        }
        return $this->sendError(__("Can not store the file"));
    }

    /**
     * @param $file UploadedFile
     * @param $group string
     *
     * @return bool
     *
     * @throws \Exception
     */
    public static function validateFile($file, $group = "default",$fileName = 'file')
    {
        $allowedExtsImage = [
            'jpg',
            'jpeg',
            'bmp',
            'png',
            'gif',
            'svg'
        ];

        $uploadConfigs = config('bc.media.groups');
        $config = isset($uploadConfigs[$group]) ? $uploadConfigs[$group] : $uploadConfigs['default'];

        $rule = ['file'];
        if(!empty($config['ext'])){
            $rule[] = 'mimes:'.implode(',',$config['ext']);
        }
        if(!empty($config['mime'])){
            $rule[] = 'mimetypes:'.implode(',',$config['mime']);
        }
        if(!empty($config['max_size'])){
            $rule[] = 'max:'.round($config['max_size']/1024);
        }

        $validator = Validator::make(\request()->all(),[
            'file'=>$rule
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            throw new \Exception($errors->first('file'));
        }

        if(in_array($file_extension = strtolower($file->getClientOriginalExtension()), $allowedExtsImage)) {
            if (!empty($config['max_width']) or !empty($config['max_width'])) {
                $imagedata = getimagesize($file->getPathname());
                if (empty($imagedata)) {
                    throw new \Exception(__("Can not get image dimensions"));
                }
                if (!empty($config['max_width']) and $imagedata[0] > $config['max_width']) {
                    throw new \Exception(__("Maximum width allowed is: :number", ['number' => $config['max_width']]));
                }
                if (!empty($config['max_height']) and $imagedata[1] > $config['max_height']) {
                    throw new \Exception(__("Maximum height allowed is: :number", ['number' => $config['max_height']]));
                }
            }
        }

        return true;
    }

    /**
     *
     * @param UploadedFile $file
     * @return bool
     */
    public static function validateSVG($file){

        // validate Script
        if(strpos(strtolower($file->getContent()),'script') !== false){
            throw new \Exception(__("This file is not an allowed file"));
        }
        return true;
    }

    public function getLists(Request $request)
    {
        if (!$this->hasPermissionMedia()) {
            return $this->sendError('There is no permission upload');
        }
        $file_type = $request->input('file_type', 'image');
        $page = $request->input('page', 1);
        $s = $request->input('s');
        $offset = ($page - 1) * 32;
        $driver = config('filesystems.default','uploads');
        $model = MediaFile::query();
        $model2 = MediaFile::query();
        if (!Auth::user()->hasPermission("media_manage_others")) {
             $model->where('create_user', Auth::id());
             $model2->where('create_user', Auth::id());
        }
        switch ($file_type) {
            case "image":
                $model->whereIn('file_extension', [
                    'png',
                    'jpg',
                    'jpeg',
                    'gif',
                    'bmp',
                    'svg'
                ]);
                $model2->whereIn('file_extension', [
                    'png',
                    'jpg',
                    'jpeg',
                    'gif',
                    'bmp'
                ]);
                break;
            case "cvs":
                $ext = [
                    'ppt','pptx','pdf','docx','doc'
                ];
                $model->whereIn('file_extension', $ext);
                $model2->whereIn('file_extension',$ext);
                break;
        }
        if ($s) {
            $model->where('file_name', 'like', '%' . ($s) . '%');
            $model2->where('file_name', 'like', '%' . ($s) . '%');
        }
        $files = $model->limit(32)->offset($offset)->orderBy('id', 'desc')->get();
        // Count
        $total = $model2->count();
        $totalPage = ceil($total / 32);
        if (!empty($files)) {
            foreach ($files as $file) {
                switch ($file->driver){
                    case 's3':
                    case 'gcs':
                        $file->thumb_size = get_file_url($file,'thumb');
                        $file->full_size = get_file_url($file,'full',false);
                        $file->medium_size = get_file_url($file,'medium',false);
                    break;
                    default:
                        if(env('APP_PREVIEW_MEDIA_LINK')){
                            $file->thumb_size = url('media/preview/'.$file->id.'/thumb');
                            $file->full_size = url('media/preview/'.$file->id.'/full');
                            $file->medium_size = url('media/preview/'.$file->id.'/medium');
                        }else{
                            $file->thumb_size = get_file_url($file,'thumb');
                            $file->full_size = get_file_url($file,'full',false);
                            $file->medium_size = get_file_url($file,'medium',false);
                        }
                }

            }
        }
        return $this->sendSuccess([
            'data'      => $files,
            'total'     => $total,
            'totalPage' => $totalPage,
            'accept' =>$this->getMimeFromType($file_type)
        ]);
    }

    protected function getMimeFromType($file_type){
        switch ($file_type){
            case 'video':
                return "video/*";
                break;
            case 'cvs':
                return implode(',',[
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                    'application/vnd.ms-powerpoint',
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ]);
                break;
            case 'scorm':
                return implode(',',[
                    'application/x-gzip',
                    'application/zip',
                    'application/x-rar-compressed'
                ]);
                break;
            default:
                return "";
                break;
        }
    }

    /**
     * Check Permission Media
     *
     * @return bool
     */
    private function hasPermissionMedia()
    {
        if(Auth::id()){
            return true;
        }
        if (Auth::user()->hasPermission("media_upload")) {
            return true;
        }
        if (Auth::user()->hasPermission("media_manage_others")) {
            return true;
        }
        return false;
    }

    public function ckeditorBrowser(){
        return view('Media::ckeditor');
    }

    public function removeFiles(Request $request){
        $file_ids = $request->input('file_ids');
        $driver = config('filesystems.default','uploads');
        if(empty($file_ids)){
            return $this->sendError(__("Please select file"));
        }
        if (!$this->hasPermissionMedia()) {
            return $this->sendError(__("You don't have permission delete the file!"));
        }
        $model = MediaFile::query()->whereIn("id",$file_ids);
        if (!Auth::user()->hasPermission("media_manage_others")) {
            $model->where('create_user', Auth::id());
        }
        $files = $model->get();
        $storage = Storage::disk($driver);
        if(!empty($files->count())){
            foreach ($files as $file){
                if($storage->exists($file->file_path)){
                    $storage->delete($file->file_path);
                }
                if($driver!='s3'){
                    $size_mores = FileHelper::$defaultSize;
                    if(!empty($size_mores)){
                        foreach ($size_mores as $size){
                            $file_size = substr($file->file_path, 0, strrpos($file->file_path, '.')) . '-' . $size[0] . '.' . $file->file_extension;
                            if($storage->exists($file_size)){
                                $storage->delete($file_size);
                            }
                        }
                    }
                    $file->forceDelete();
                }


            }
            return $this->sendSuccess([],__("Delete the file success!"));
        }
        return $this->sendError(__("File not found!"));
    }
}
