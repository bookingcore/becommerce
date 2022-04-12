<?php
namespace Themes\Freshen\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class ListPartner extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [      'id'        => 'sub_title',
                       'type'      => 'input',
                       'inputType' => 'text',
                       'label'     => __('Sub Title')
                ],
                [      'id'        => 'title',
                       'type'      => 'input',
                       'inputType' => 'text',
                       'label'     => __('Title')
                ],
                [      'id'        => 'desc',
                       'type'      => 'input',
                       'inputType' => 'text',
                       'label'     => __('Desc')
                ],
                [      'id'        => 'link_shop',
                       'type'      => 'input',
                       'inputType' => 'text',
                       'label'     => __('Link Shop')
                ],
                [      'id'        => 'bg_image',
                       'type'  => 'uploader',
                       'label'     => __('Background Image')
                ],
                [
                    'id'          => 'list_items',
                    'type'        => 'listItem',
                    'label'       => __('List Logo(s)'),
                    'title_field' => 'List Item',
                    'settings'    => [
                        [
                            'id'    => 'image_id',
                            'type'  => 'uploader',
                            'label' => __('Image Uploader')
                        ]
                    ]
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('List Partner');
    }

    public function content($model = [])
    {
        $data = [
            'title'      => $model['title'] ?? '',
            'sub_title'  => $model['sub_title'] ?? '',
            'desc'       => $model['desc'] ?? '',
            'link_shop'  => $model['link_shop'] ?? '',
            'bg_image_url' => $model['bg_image'] ? get_file_url($model['bg_image'], 'full') : '',
            'list_items' => $model['list_items'] ?? '',
        ];
        return view('blocks.list-partner.index', $data);
    }
}
