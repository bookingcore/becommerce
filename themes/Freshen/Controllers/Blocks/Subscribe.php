<?php
namespace Themes\Freshen\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class Subscribe extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'    => 'style',
                    'type'  => 'radios',
                    'label' => __('Style'),
                    'std' => 'style_1',
                    'values' => [
                        [
                            'value'   => 'style_1',
                            'name' => __("Style 1")
                        ],
                    ],
                ],
                [   'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [   'id'        => 'sub_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Sub Title')
                ],
                [   'id'        => 'btn_name',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Text For Button')
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Subscribe');
    }

    public function content($model = [])
    {
        $data = [
            'title'  =>  $model['title'] ?? '',
            'sub_title'  =>  $model['sub_title'] ?? '',
            'btn_name'  =>  $model['btn_name'] ?? '',
        ];
        $style = $model['style'] ?? 'style_1';

        return view("blocks.subscribe.{$style}", $data);
    }
}
