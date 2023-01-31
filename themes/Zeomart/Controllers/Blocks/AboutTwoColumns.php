<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class AboutTwoColumns extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'          => 'title',
                    'type'        => 'input',
                    'inputType'   => 'text',
                    'label'       => __('Title Left')
                ],
                [
                    'id'          => 'content',
                    'type'        => 'editor',
                    'label'       => __('Content Right')
                ],
                [
                    'id'          => 'button_name',
                    'type'        => 'input',
                    'inputType'   => 'text',
                    'label'       => __('Button Name')
                ],
                [
                    'id'          => 'button_url',
                    'type'        => 'input',
                    'inputType'   => 'text',
                    'label'       => __('Button Url')
                ]
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('About Two Columns');
    }

    public function content($model = [])
    {
        $data = [
            'title'  =>  $model['title'] ?? '',
            'content'  =>  $model['content'] ?? '',
            'button_name'  =>  $model['button_name'] ?? '',
            'button_url'  =>  $model['button_url'] ?? ''
        ];

        return view("blocks.about-two-columns.index", $data);
    }
}
