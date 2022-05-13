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
                    'id'        => 'right_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title form contact')
                ],
                [
                    'id'        => 'sub_right_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Sub title form contact')
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
                [
                    'id'        => 'iframe_map',
                    'type'      => 'textArea',
                    'inputType' => 'textArea',
                    'label'     => __('Url Iframe')
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
        return view('blocks.contact.index', $model);
    }
}
