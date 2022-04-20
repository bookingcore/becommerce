<?php
namespace Themes\Freshen\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class WhatsApp extends BaseBlock
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
                        ]
                    ],
                ],
                [   'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'    => 'icon',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label' => __('Class Icon')
                ],
                [   'id'        => 'title2',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title 2')
                ],

            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Whats App');
    }

    public function content($model = [])
    {
        $data = [
            'title'  =>  $model['title'] ?? '',
            'title2'  =>  $model['title2'] ?? '',
            'icon'  =>  $model['icon'] ?? '',
        ];
        $style = $model['style'] ? $model['style'] : 'style_1';
        return view("blocks.whats-app.{$style}", $data);
    }
}
