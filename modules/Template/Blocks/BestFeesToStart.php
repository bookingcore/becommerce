<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class BestFeesToStart extends BaseBlock
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
                    'id'        => 'sub_content',
                    'type'      => 'textArea',
                    'inputType' => 'textArea',
                    'label'     => __('Sub Content')
                ],
                [
                    'id'          => 'listPercent',
                    'type'        => 'listItem',
                    'label'       => __('List Percent'),
                    'title_field' => 'List Percent',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'number',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Number Fee')
                        ],
                    ]
                ],
                [
                    'id'        => 'title_list',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title List')
                ],
                [
                    'id'        => 'title_list_content',
                    'type'      => 'editor',
                    'label'     => __('Title List Content')
                ],
                [
                    'id'        => 'payment_content',
                    'type'      => 'textArea',
                    'inputType' => 'textArea',
                    'label'     => __('Payment Content')
                ],
                [
                    'id'        => 'payment_image',
                    'type'      => 'uploader',
                    'label'     => __('Upload payment image')
                ],
                [
                    'id'        => 'title_footer',
                    'type'      => 'textArea',
                    'inputType' => 'textArea',
                    'label'     => __('Title Footer')
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('Best Fees To Start');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.BestFeesToStart.index', $model);
    }
}
