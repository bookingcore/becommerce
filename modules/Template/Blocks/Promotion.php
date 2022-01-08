<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class Promotion extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'            => 'col',
                    'type'          => 'radios',
                    'label'         => __('Item Per Rows ( default 3 item in row)'),
                    'values'        => [
                        [
                            'value'   => '6',
                            'name' => __("2 Item")
                        ],
                        [
                            'value'   => '4',
                            'name' => __("3 Item")
                        ],
                        [
                            'value'   => '3',
                            'name' => __("4 Item")
                        ]
                    ]
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
                            'label' => __('Image Uploader')
                        ],
                    ]
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('Promotion');
    }

    public function content($model = [])
    {
        $data = [
            'list_items'  =>  $model['list_items'] ?? '',
            'col' => $model['col'] ?? 4
        ];
        return view('blocks.promotion.index', $data);
    }
}
