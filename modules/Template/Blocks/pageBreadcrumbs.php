<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class pageBreadcrumbs extends BaseBlock
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
                ]
            ]
        ]);
    }

    public function getName()
    {
        return __('Page Breadcurmbs');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.pageBreadcrumbs.index', $model);
    }
}
