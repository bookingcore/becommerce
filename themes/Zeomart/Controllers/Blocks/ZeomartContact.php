<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class ZeomartContact extends BaseBlock
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
                    'id'        => 'desc',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Description')
                ],
                [
                    'id'        => 'open_hours',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Open Hours')
                ],
                [
                    'id'        => 'phone',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Phone')
                ],
                [
                    'id'        => 'email_title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Email Title')
                ],
                [
                    'id'        => 'email',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Email')
                ],
                [
                    'id'          => 'socials',
                    'type'        => 'listItem',
                    'label'       => __('Socials'),
                    'title_field' => __('Social'),
                    'settings'    => [
                        [
                            'id'    => 'social',
                            'type'  => 'select',
                            'label' => __('Social'),
                            'values' => [
                                [
                                    'id' => 'facebook',
                                    'name' => __("Facebook")
                                ],
                                [
                                    'id' => 'twitter',
                                    'name' => __("Twitter")
                                ],
                                [
                                    'id' => 'instagram',
                                    'name' => __("Instagram")
                                ],
                                [
                                    'id' => 'linkedin',
                                    'name' => __("Linkedin")
                                ]
                            ],
                            'default' => 'facebook'
                        ],
                        [
                            'id'        => 'url',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label'     => __('Url')
                        ],
                    ]
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
