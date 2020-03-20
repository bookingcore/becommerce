<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class WhySellOnMartfury extends BaseBlock
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
                    'id'        => 'content',
                    'type'      => 'input',
                    'inputType' => 'textArea',
                    'label'     => __('Title Button')
                ],
                [
                    'id'          => 'item',
                    'type'        => 'listItem',
                    'label'       => __('col Items'),
                    'title_field' => 'col Item',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'sub_title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Sub Title')
                        ],
                        [
                            'id'        => 'sub_link',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link learn more')
                        ],
                        [
                            'id'        => 'link_title',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('link Title')
                        ],
                        [
                            'id'    => 'icon_image',
                            'type'  => 'uploader',
                            'label' => __('Image Uploader')
                        ],
                    ]
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('Why Sell On Martfury');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.WhySellOnMartfury.index', $model);
    }
}
