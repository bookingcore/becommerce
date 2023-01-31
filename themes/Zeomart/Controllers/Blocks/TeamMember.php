<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class TeamMember extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id' => 'title',
                    'type' => 'input',
                    'inputType' => 'text',
                    'label' => __("Title")
                ],
                [
                    'id'          => 'list_members',
                    'type'        => 'listItem',
                    'label'       => __('List Members'),
                    'title_field' => 'name',
                    'settings'    => [
                        [
                            'id'    => 'avatar',
                            'type'  => 'uploader',
                            'label' => __('Avatar')
                        ],
                        [
                            'id'    => 'name',
                            'type'  => 'input',
                            'inputType' => 'text',
                            'label' => __('Name')
                        ],
                        [
                            'id'    => 'position',
                            'type'  => 'input',
                            'inputType' => 'text',
                            'label' => __('Position')
                        ],
                        [
                            'id'    => 'facebook',
                            'type'  => 'input',
                            'inputType' => 'text',
                            'label' => __('Facebook')
                        ],
                        [
                            'id'    => 'twitter',
                            'type'  => 'input',
                            'inputType' => 'text',
                            'label' => __('Twitter')
                        ],
                        [
                            'id'    => 'instagram',
                            'type'  => 'input',
                            'inputType' => 'text',
                            'label' => __('Instagram')
                        ],
                        [
                            'id'    => 'linkedin',
                            'type'  => 'input',
                            'inputType' => 'text',
                            'label' => __('Linkedin')
                        ]
                    ]
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Team Member');
    }

    public function content($model = [])
    {
        $data = [
            'title' => $model['title'] ?? '',
            'list_members'  =>  $model['list_members'] ?? []
        ];

        return view("blocks.team-member.index", $data);
    }
}
