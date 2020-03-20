<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class HowItWorks extends BaseBlock
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
                    'type'      => 'input',
                    'inputType' => 'input',
                    'label'     => __('Sub Title')
                ],
                [
                    'id'          => 'list',
                    'type'        => 'listItem',
                    'label'       => __('List Item'),
                    'title_field' => 'List Item',
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
                            'label'     => __('Content')
                        ],
                        [
                            'id'        => 'image',
                            'type'      => 'uploader',
                            'inputType' => 'text',
                            'label'     => __('Images')
                        ],
                    ]
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('How It Works');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.HowItWorks.index', $model);
    }
}
