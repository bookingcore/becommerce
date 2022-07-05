<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class AboutEditor extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'          => 'title',
                    'type'        => 'input',
                    'inputType'   => 'text',
                    'label'       => __('Title')
                ],
                [
                    'id'          => 'content',
                    'type'        => 'editor',
                    'label'       => __('Content Editor')
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('About Editor');
    }

    public function content($model = [])
    {
        $data = [
            'content'  =>  $model['content'] ?? '',
            'title'  =>  $model['title'] ?? ''
        ];

        return view("blocks.about-editor.index", $data);
    }
}
