<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class ListOffices extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [      'id'        => 'title',
                       'type'      => 'input',
                       'inputType' => 'text',
                       'label'     => __('Title')
                ],
                [      'id'        => 'desc',
                       'type'      => 'textArea',
                       'label'     => __('Description')
                ],
                [
                    'id'          => 'list_offices',
                    'type'        => 'listItem',
                    'label'       => __('List Offices'),
                    'title_field' => 'name',
                    'settings'    => [
                        [
                            'id'    => 'name',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label' => __('Office Name')
                        ],
                        [
                            'id'    => 'address',
                            'type'      => 'textArea',
                            'label' => __('Address')
                        ],
                        [
                            'id'    => 'phone',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label' => __('Phone Number')
                        ],
                        [
                            'id'    => 'email',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label' => __('Email')
                        ],
                        [
                            'id'    => 'map_url',
                            'type'      => 'input',
                            'inputType' => 'text',
                            'label' => __('See Map Url')
                        ]
                    ]
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('List Offices');
    }

    public function content($model = [])
    {
        $data = [
            'title'      => $model['title'] ?? '',
            'desc'      => $model['desc'] ?? '',
            'list_offices' => $model['list_offices'] ?? '',
        ];
        return view("blocks.list-offices.index", $data);
    }
}
