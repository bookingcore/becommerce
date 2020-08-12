<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class Slider extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'          => 'sliders',
                    'type'        => 'listItem',
                    'label'       => __('Slider Items'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'sub_title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Sub Title')
                        ],
                        [
                            'id'    => 'icon_image',
                            'type'  => 'uploader',
                            'label' => __('Image Uploader')
                        ],
                        [
                            'id'        => 'sub_text',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Sub Text')
                        ],
                        [
                            'id'        => 'btn_shop_now',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Text For Button')
                        ]
                    ]
                ],
                [
                    'id'    => 'background_image_first',
                    'type'  => 'uploader',
                    'label' => __('Image Sale 1')
                ],
                [
                    'id'    => 'background_image_second',
                    'type'  => 'uploader',
                    'label' => __('Image Sale 2')
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('Slider');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.slider.index', $model);
    }
}