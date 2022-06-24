<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/21/2022
 * Time: 9:59 PM
 */

namespace Themes\Axtronic\Controllers\Blocks;


use Modules\Template\Blocks\BaseBlock;

class BannerText extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'            => 'style',
                    'type'          => 'radios',
                    'label'         => __('Style'),
                    'values'        => [
                        [
                            'value'   => '',
                            'name' => __("Style 1 ")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style with Image ")
                        ],
                    ]
                ],
                [
                    'id'            => 'banner_width',
                    'type'          => 'radios',
                    'label'         => __('Banner width'),
                    'values'        => [
                        [
                            'value'     => 'container',
                            'name'      => __("Container")
                        ],
                        [
                            'value'     => 'banner_fluid',
                            'name'      => __("Fluid Width")
                        ],
                    ]
                ],
                [
                    'id'        => 'content',
                    'type'      => 'textArea',
                    'inputType' => 'textArea',
                    'label'     => __('Content 1')
                ],
                [
                    'id'        => 'content2',
                    'type'      => 'textArea',
                    'inputType' => 'textArea',
                    'label'     => __('Content 2')
                ],
                [
                    'id'    => 'image',
                    'type'  => 'uploader',
                    'label' => __('Images')
                ],
                [
                    'id'    => 'bg_content',
                    'type'  => 'uploader',
                    'label' => __('Background Images')
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Banner Text');
    }

    public function content($model = [])
    {
        if (empty($model['style'])) {
            $model['style'] = 'index';
        }
        if (empty($model['banner_width'])) {
            $model['banner_width'] = 'container';
        }
        return view('blocks.banner-text.'.$model['style'], $model);
    }
}
