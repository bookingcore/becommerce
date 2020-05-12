<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class SellerStories extends BaseBlock
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
                    'id'          => 'sliders',
                    'type'        => 'listItem',
                    'label'       => __('Sliders Items'),
                    'title_field' => 'Sliders Item',
                    'settings'    => [
                        [
                            'id'    => 'avatar',
                            'type'  => 'uploader',
                            'label' => __('Image Avatar')
                        ],
                        [
                            'id'        => 'name',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Name')
                        ],
                        [
                            'id'        => 'job',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Job')
                        ],
                        [
                            'id'        => 'content',
                            'type'      => 'textArea',
                            'inputType' => 'textArea',
                            'label'     => __('content')
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link')
                        ],
                        [
                            'id'        => 'link_title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('link Title')
                        ],
                    ]
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('Seller Stories');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.SellerStories.index', $model);
    }
}
