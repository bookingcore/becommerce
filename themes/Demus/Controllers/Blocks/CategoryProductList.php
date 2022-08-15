<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/15/2022
 * Time: 9:45 AM
 */

namespace Themes\Demus\Controllers\Blocks;


use Modules\Product\Models\Product;
use Modules\Template\Blocks\BaseBlock;
use Modules\Product\Models\ProductCategory;

class CategoryProductList extends BaseBlock
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
                [
                    'id'        => 'sub_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Sub Title')
                ],
                [
                    'id'          => 'list_items',
                    'type'        => 'listItem',
                    'label'       => __('List Items'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'      => 'category_id',
                            'type'    => 'select2',
                            'label'   => __('Select Category'),
                            'select2' => [
                                'ajax'  => [
                                    'url'      => route('product.admin.category.getForSelect2'),
                                    'dataType' => 'json'
                                ],
                                'width' => '100%',
                                'allowClear' => 'true',
                                'placeholder' => __('-- Select --')
                            ],
                            'pre_selected'=>route('product.admin.category.getForSelect2',['pre_selected'=>1])
                        ],
                        [
                            'id'    => 'image_id',
                            'type'  => 'uploader',
                            'label' => __('Icon Image')
                        ]
                    ]
                ],
            ],
            'category'=>__("Product")
        ]);
    }

    public function getName()
    {
        return __('Category Product');
    }

    public function content($model = [])
    {
        $list_product_cat = [];
        if(!empty($model['list_items'])){
            $ids = collect($model['list_items'])->pluck('category_id');
            $categories = ProductCategory::query()->whereIn("id",$ids)->get();
            $model['categories'] = $categories;
            foreach ($categories as $item){
                $model['cat_ids'] = [$item->id];
                $list_product_cat[$item->id] = Product::search($model)->get();
            }
        }

        $data = [
            'list_product_cat'      => $list_product_cat,
            'title'                 => $model['title'] ?? "",
            'sub_title'             => $model['sub_title'] ?? "",
            'categories'            => $categories ?? [],
            'list_items'            => $model['list_items'],
        ];
        return view("blocks.category-product.index", $data);
    }
}
