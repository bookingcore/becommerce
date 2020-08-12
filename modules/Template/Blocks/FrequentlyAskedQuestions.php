<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class FrequentlyAskedQuestions extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'sub_title',
                    'type'      => 'textArea',
                    'inputType' => 'textArea',
                    'label'     => __('Sub Title')
                ],
                [
                    'id'          => 'itemListLeft',
                    'type'        => 'listItem',
                    'label'       => __('Content Items Left'),
                    'title_field' => 'Content Items Left',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'content',
                            'type'      => 'editor',
                            'label'     => __('Sub Title')
                        ]
                    ]
                ],
                [
                    'id'          => 'itemListRight',
                    'type'        => 'listItem',
                    'label'       => __('Content Items Right'),
                    'title_field' => 'Content Items Right',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'content',
                            'type'      => 'editor',
                            'label'     => __('Sub Title')
                        ]
                    ]
                ],
                [
                    'id'        => 'contact_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Contact Title')
                ],
                [
                    'id'        => 'contact_link',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Contact Link')
                ],
                [
                    'id'        => 'contact_link_button',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Contact Link text button')
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('Frequently Asked Questions');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.FrequentlyAskedQuestions.index', $model);
    }
}
