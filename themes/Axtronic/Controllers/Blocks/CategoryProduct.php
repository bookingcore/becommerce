<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/9/2022
 * Time: 8:42 AM
 */

namespace Themes\Axtronic\Controllers\Blocks;


use Modules\Template\Blocks\BaseBlock;

class CategoryProduct extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'title_name',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'          => 'categories_product',
                    'type'        => 'listItem',
                    'label'       => __('Slider Items'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title_category',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Title Category')
                        ],
                        [
                            'id'    => 'icon',
                            'type'  => 'input',
                            'inputType' => 'text',
                            'label' => __('Icon Category ')
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link For Item')
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function getName()
    {
        return __('Category Product');
    }

    public function content($model = [])
    {

        return view('blocks.list-product.category', $model);
    }
}
