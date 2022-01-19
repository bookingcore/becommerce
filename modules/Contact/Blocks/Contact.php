<?php
namespace Modules\Contact\Blocks;

use Modules\Template\Blocks\BaseBlock;

class Contact extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'class',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Class Block')
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'sub_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Sub Title')
                ],
                [
                    'id'        => 'address',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Address')
                ],
                [
                    'id'        => 'phone',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Phone')
                ],
                [
                    'id'        => 'email',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Email')
                ],
                [
                    'id'        => 'website',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Website')
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('Contact Block');
    }

    public function content($model = [])
    {
//        return view('Contact::frontend.blocks.contact.index', $model);
        return view('blocks.contact.index', $model);
    }
}
