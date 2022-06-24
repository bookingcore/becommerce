<?php
namespace Themes\Freshen\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class AboutText extends BaseBlock
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
                    ]
                ],
                [      'id'        => 'youtube',
                       'type'      => 'input',
                       'inputType' => 'text',
                       'label'     => __('Youtube url')
                ],
                [
                    'id'    => 'image_1',
                    'type'  => 'uploader',
                    'label' => __('Thumb Image 1')
                ],
                [
                    'id'    => 'image_2',
                    'type'  => 'uploader',
                    'label' => __('Thumb Image 2')
                ]
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('About Text');
    }

    public function content($model = [])
    {
        $data = [
            'title'  =>  $model['title'] ?? '',
            'list_items'  =>  $model['list_items'] ?? '',
            'image_1'  =>  $model['image_1'] ? get_file_url($model['image_1'],'full') : '',
            'image_2'  =>  $model['image_2'] ? get_file_url($model['image_2'],'full') : '',
            'youtube'  =>  $model['youtube'] ?? '',
        ];

        return view("blocks.about-text.index", $data);
    }
}
