<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class CallAction extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'textArea',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'title_button',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title Button')
                ],
                [
                    'id'        => 'link_button',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Link Button')
                ],
                [
                    'id'    => 'bg',
                    'type'  => 'uploader',
                    'label' => __('Image Uploader')
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('Call A Action');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.CallAction.index', $model);
    }
}