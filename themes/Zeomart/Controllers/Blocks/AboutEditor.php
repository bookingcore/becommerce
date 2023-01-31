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
                [
                    'id'          => 'our_mission',
                    'type'        => 'editor',
                    'label'       => __('Our Mission')
                ],
                [
                    'id'          => 'our_vision',
                    'type'        => 'editor',
                    'label'       => __('Our Vision')
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
            'our_mission'  =>  $model['our_mission'] ?? '',
            'our_vision'  =>  $model['our_vision'] ?? '',
            'title'  =>  $model['title'] ?? ''
        ];

        return view("blocks.about-editor.index", $data);
    }
}
