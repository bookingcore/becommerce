<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class ListFAQs extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id' => 'title',
                    'type' => 'input',
                    'inputType' => 'text',
                    'label' => __("Title")
                ],
                [
                    'id'          => 'list_faqs',
                    'type'        => 'listItem',
                    'label'       => __('List FAQs'),
                    'title_field' => 'question',
                    'settings'    => [
                        [
                            'id'    => 'question',
                            'type'  => 'input',
                            'inputType' => 'text',
                            'label' => __('Question')
                        ],
                        [
                            'id'    => 'answer',
                            'type'  => 'textArea',
                            'label' => __('Answer')
                        ]
                    ]
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('List FAQs');
    }

    public function content($model = [])
    {
        $data = [
            'title' => $model['title'] ?? '',
            'list_faqs'  =>  $model['list_faqs'] ?? []
        ];

        return view("blocks.list-faqs.index", $data);
    }
}
