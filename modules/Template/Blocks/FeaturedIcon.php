<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class FeaturedIcon extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'          => 'list_items',
                    'type'        => 'listItem',
                    'label'       => __('Fee List Items'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'sub_title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Sub Title')
                        ],
                        [
                            'id'    => 'icon',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label' => __('Class Icon')
                        ],
                    ]
                ]
            ]
        ]);
    }

    public function getName()
    {
        return __('Featured Icon');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.FeaturedIcon.index', $model);
    }
}
