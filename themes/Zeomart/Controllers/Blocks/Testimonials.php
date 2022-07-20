<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class Testimonials extends BaseBlock
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
                    'id'          => 'list_testimonials',
                    'type'        => 'listItem',
                    'label'       => __('List Testimonials'),
                    'title_field' => __('Testimonial'),
                    'settings'    => [
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
                            'id'    => 'review',
                            'type'  => 'textArea',
                            'label' => __('Review')
                        ],
                        [
                            'id'    => 'stars',
                            'type'  => 'select',
                            'label' => __('Stars'),
                            'values' => [
                                [
                                    'id' => 1,
                                    'name' => __("1 star")
                                ],
                                [
                                    'id' => 2,
                                    'name' => __("2 stars")
                                ],
                                [
                                    'id' => 3,
                                    'name' => __("3 stars")
                                ],
                                [
                                    'id' => 4,
                                    'name' => __("4 stars")
                                ],
                                [
                                    'id' => 5,
                                    'name' => __("5 stars")
                                ]
                            ],
                            'default' => 5
                        ]
                    ]
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Testimonials');
    }

    public function content($model = [])
    {
        $data = [
            'title' => $model['title'] ?? '',
            'list_members'  =>  $model['list_members'] ?? []
        ];

        return view("blocks.list-testimonials.index", $data);
    }
}
