<?php


namespace Themes\Base\Controllers\User;


use Illuminate\Http\Request;
use Modules\Order\Models\OrderItem;
use Modules\Product\Models\Downloadable\DownloadFile;
use Modules\Product\Models\Downloadable\DownloadLog;
use Themes\Base\Controllers\FrontendController;

class DownloadController extends FrontendController
{

    public function index(){

        $downloadItems = OrderItem::searchDownloadable([
            'customer_id'=>auth()->id()
        ])->addSelect([
            'product_downloadable.file_id',
            'product_downloadable.id as download_id',
            'product_downloadable.file_name',
        ]);

        $data = [
            'rows'=>$downloadItems->with(['product'])->paginate(20),
            'page_title'=>__("My downloads")
        ];

        return view('user.download',$data);
    }

    public function download(Request $request,$id,$file_id){
        $order_item = OrderItem::find($id);
        if(!$order_item or !$order_item->order or $order_item->order->customer_id != auth()->id() or !$order_item->isValid()) {
            return back()->with('error',__("You can not download this file"));
        }

        $file = DownloadFile::find($file_id);
        if(!$file or $file->product_id != $order_item->object_id or !$file->file){
            return back()->with('error',__("File not found"));
        }

        // Create Log
        DownloadLog::create([
            'download_id'=>$file_id,
            'user_id'=>auth()->id(),
            'ip_address'=>$request->ip()
        ]);

        return $file->file->download($file->file_name.'.'.$file->file->file_extension);
    }
}
