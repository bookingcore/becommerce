<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class CallToAction extends BaseBlock
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
                [      'id'        => 'desc',
                       'type'      => 'input',
                       'inputType' => 'text',
                       'label'     => __('Desc')
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
                ],
                [
                    'id'    => 'image',
                    'type'  => 'uploader',
                    'label' => __('Image Uploader')
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Call To Action');
    }

    public function content($model = [])
    {
        $data = [
            'title'         => $model['title'] ?? '',
            'desc'          => $model['desc'] ?? '',
            'btn_shop_now'  => $model['btn_shop_now'] ?? '',
            'link_shop_now' => $model['link_shop_now'] ?? '',
            'image' => $model['image'] ?? '',
        ];
        return view("blocks.call-to-action.index", $data);
    }
}
