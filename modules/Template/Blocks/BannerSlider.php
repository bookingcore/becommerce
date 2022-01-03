<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class BannerSlider extends BaseBlock
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
                            'id'    => 'image',
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
                        ],[
                            'id'        => 'link_shop_now',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link For Button')
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function getName()
    {
        return __('Banner Slider');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.BannerSlider.index', $model);
    }
}