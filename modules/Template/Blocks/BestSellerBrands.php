<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class bestSellerBrands extends BaseBlock
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
                    'id'          => 'item',
                    'type'        => 'listItem',
                    'label'       => __('List Brands'),
                    'title_field' => 'List Brands',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'link',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Link promotion')
                        ],
                        [
                            'id'    => 'image',
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
        return __('Best Seller Brands');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.BestSellerBrands.index', $model);
    }
}
