<?php
namespace Modules\Product\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategoryRelation;

class RecentlyViewedProducts extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('Product: Recently Viewed Products');
    }

    public function content($model = [])
    {
        $recently = session('product_recently');
        $products = '';
        if (!empty($recently)){
            $products = Product::select('title','slug','image_id')->whereIn('id',$recently)->limit(20)->get();
        }
        $data = [
            'rows'       => $products,
            'title'      => $model['title'],
            'blocks'     => 'recently_viewed_products'
        ];
        return view('Product::frontend.blocks.recently-viewed-products.index', $data);
    }
}
