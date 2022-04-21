<?php

namespace Themes\Freshen\Controllers\Blocks;


use Modules\Product\Models\ProductCategory;
use Modules\Template\Blocks\BaseBlock;

class ListCategory extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'    => 'style',
                    'type'  => 'radios',
                    'label' => __('Style'),
                    'value' => 'style_1',
                    'values' => [
                        [
                            'value'   => 'style_1',
                            'name' => __("Style 1")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style 2")
                        ]
                    ],
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'btn_name',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Button Name'),
                    'conditions' => ['style' => 'style_2']
                ],
                [
                    'id'        => 'btn_url',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Button Url'),
                    'conditions' => ['style' => 'style_2']
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
                    ],
                    'conditions' => ['style' => 'style_1']
                ],
                [
                    'id'          => 'list_items_2',
                    'type'        => 'listItem',
                    'label'       => __('List Items'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Title')
                        ],
                        [
                            'id'    => 'image_id',
                            'type'  => 'uploader',
                            'label' => __('Icon Image')
                        ],
                        [
                            'id'      => 'category_ids',
                            'type'    => 'select2',
                            'label'   => __('Select Category'),
                            'select2' => [
                                'ajax'  => [
                                    'url'      => route('product.admin.category.getForSelect2'),
                                    'dataType' => 'json'
                                ],
                                'width' => '100%',
                                'allowClear' => 'true',
                                'multiple' => "true",
                                'placeholder' => __('-- Select --')
                            ],
                            'pre_selected'=>route('product.admin.category.getForSelect2',['pre_selected'=>1]),

                        ],
                        [
                            'id'        => 'btn_name',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Button Name')
                        ],
                        [
                            'id'        => 'btn_url',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Button Url')
                        ],
                    ],
                    'conditions' => ['style' => 'style_2']
                ]
            ],
            'category'=>__("Product")
        ]);
    }

    public function getName()
    {
        return __('List Category');
    }

    public function content($model = [])
    {
        if(!empty($model['list_items'])){
            $ids = collect($model['list_items'])->pluck('category_id');
            $categories = ProductCategory::query()->whereIn("id",$ids)->get();
            $model['categories'] = $categories;
        }
        if(!empty($model['list_items_2']))
        {
            $list_items_2 = [];
            foreach ($model['list_items_2'] as $item)
            {
                $item['categories'] = ProductCategory::query()->whereIn("id",$item['category_ids'])->get();
                $list_items_2[] = $item;
            }
            $model['list_items_2'] = $list_items_2;
        }

        $style = isset($model['style']) ? $model['style'] : 'index';
        return view("blocks.list-category.{$style}", $model);
    }
}
