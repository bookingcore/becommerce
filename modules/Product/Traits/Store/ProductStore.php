<?php


namespace Modules\Product\Traits\Store;


use Illuminate\Http\Request;
use Modules\Media\Models\MediaFile;
use Modules\Product\Models\Downloadable\DownloadFile;
use Modules\Product\Models\Location\LocationStock;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductTag;

trait ProductStore
{


    public function saveTags($row, $tags_name, $tag_ids)
    {
        if (empty($tag_ids))
            $tag_ids = [];
        $tag_ids = array_merge(ProductTag::saveTagByName($tags_name), $tag_ids);
        $tag_ids = array_filter(array_unique($tag_ids));
        // Delete unused
        $this->product_tag_relation::whereNotIn('tag_id', $tag_ids)->where('target_id', $row->id)->delete();
        //Add
        $this->product_tag_relation::addTag($tag_ids, $row->id);

    }

    public function saveCategory($row, $request){
        if (empty($request->input('category_ids'))) {
            $this->product_cat_relation::query()->where('target_id',$row->id)->delete();
        } else {
            $term_ids = $request->input('category_ids');
            foreach ($term_ids as $term_id) {
                $this->product_cat_relation::firstOrCreate([
                    'cat_id' => $term_id,
                    'target_id' => $row->id
                ]);
            }
            $this->product_cat_relation::where('target_id', $row->id)->whereNotIn('cat_id', $term_ids)->delete();
        }
    }

    public function saveTerms($row, $request)
    {
        if (empty($request->input('terms'))) {
            $this->product_term::where('target_id', $row->id)->delete();
        } else {
            $term_ids = $request->input('terms');
            foreach ($term_ids as $term_id) {
                $this->product_term::firstOrCreate([
                    'term_id' => $term_id,
                    'target_id' => $row->id
                ]);
            }
            $this->product_term::where('target_id', $row->id)->whereNotIn('term_id', $term_ids)->delete();
        }
    }

    public function saveGroupedProducts($row, $request)
    {
        foreach ([$this->product_grouped::TYPE_GROUPED,$this->product_grouped::TYPE_UP_SELL,$this->product_grouped::TYPE_CROSS_SELL] as $group_type){
            switch ($group_type){
                case $this->product_grouped::TYPE_GROUPED:
                    $children = $request->input('children',[]);
                    break;
                case $this->product_grouped::TYPE_UP_SELL:
                    $children = $request->input('up_sell',[]);
                    break;
                case $this->product_grouped::TYPE_CROSS_SELL:
                    $children = $request->input('cross_sell',[]);
                    break;
            }
            $children = array_unique(array_values($children));

            if (empty($children)) {
                $this->product_grouped::where('parent_id', $row->id)->where('group_type', $group_type)->delete();
            } else {
                foreach ($children as $product_id) {
                    if($product_id == $row->id) continue;
                    $this->product_grouped::firstOrCreate([
                        'children_id' => $product_id,
                        'parent_id' => $row->id,
                        'group_type'=>$group_type
                    ]);
                }
                $this->product_grouped::where('parent_id', $row->id)->where('group_type', $group_type)->whereNotIn('children_id', $children)->delete();
            }
        }

    }

    public function saveDownloadable(Product $row,Request $request){

        $download_files = $request->input('download_files',[]);
        $file_ids = [];

        if(!empty($download_files)) {
            foreach ($download_files as $download_file) {
                if (empty($download_file['file_id'])) continue;

                $file = MediaFile::find($download_file['file_id']);

                if(!$file) continue;

                $file_ids[] = $file->id;

                $find = DownloadFile::firstOrNew([
                    'product_id' => $row->id,
                    'file_id' => $download_file['file_id']
                ]);
                $find->file_name = $download_file['file_name'] ?? $file->file_name;
                $find->save();
            }
        }

        if(!empty($file_ids)){
            DownloadFile::query()->where('product_id',$row->id)->whereNotIn('file_id',$file_ids)->delete();
        }else{
            DownloadFile::query()->where('product_id',$row->id)->delete();
        }

    }
    public function saveLocationStocks(Product $row,Request $request){

        $location_stocks = $request->input('location_stocks',[]);

        if(!empty($location_stocks)) {
            foreach ($location_stocks as $location_id=>$data) {
                $stock = LocationStock::firstOrNew([
                    'location_id'=>$location_id,
                    'product_id'=>$row->id
                ]);
                $stock->quantity = $data['quantity'] ?? 0;
                $stock->save();
            }
        }

    }
}
