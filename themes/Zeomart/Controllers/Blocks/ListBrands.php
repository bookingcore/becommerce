<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class ListBrands extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [      'id'        => 'title',
                       'type'      => 'input',
                       'inputType' => 'text',
                       'label'     => __('Title')
                ],
                [
                    'id'          => 'list_items',
                    'type'        => 'listItem',
                    'label'       => __('List Items'),
                    'title_field' => 'List Item',
                    'settings'    => [
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('Logo Uploader')
                        ]
                    ]
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('List Brand(s)');
    }

    public function content($model = [])
    {
        $data = [
            'title'      => $model['title'] ?? '',
            'list_items' => $model['list_items'] ?? '',
        ];
        return view("blocks.list-brands.index", $data);
    }
}
