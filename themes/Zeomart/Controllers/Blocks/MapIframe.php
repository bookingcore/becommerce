<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class MapIframe extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'          => 'iframe_content',
                    'type'        => 'textArea',
                    'label'       => __('Iframe Content')
                ]
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Map Iframe');
    }

    public function content($model = [])
    {
        $data = [
            'iframe_content'  =>  $model['iframe_content'] ?? '',
        ];

        return view("blocks.map-iframe.index", $data);
    }
}
