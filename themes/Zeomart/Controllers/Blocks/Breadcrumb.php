<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class Breadcrumb extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'          => 'list_items',
                    'type'        => 'listItem',
                    'label'       => __('List Items'),
                    'title_field' => 'List Item',
                    'settings'    => [
                        [      'id'        => 'name',
                               'type'      => 'input',
                               'inputType' => 'text',
                               'label'     => __('Title')
                        ],
                        [
                            'id'        => 'url',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link')
                        ]
                    ]
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Breadcrumb');
    }

    public function content($model = [])
    {
        $data = [
            'breadcrumbs' =>  $model['list_items'] ?? [],
            'is_block' => 1,
        ];
        return view("global.breadcrumb", $data);
    }
}
