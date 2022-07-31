<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class AboutGallery extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'          => 'list_items',
                    'type'        => 'listItem',
                    'label'       => __('List Images'),
                    'settings'    => [
                        [
                            'id'    => 'image',
                            'type'  => 'uploader',
                            'label' => __('Upload Image')
                        ]
                    ]
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('About Gallery');
    }

    public function content($model = [])
    {
        $data = [
            'list_items'  =>  $model['list_items'] ?? []
        ];

        return view("blocks.about-gallery.index", $data);
    }
}
