<?php
namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class SearchTrending extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'    => 'title',
                    'type'  => 'input',
                    'inputType' => 'text',
                    'label' => __('Title')
                ],
                [
                    'id'    => 'update_at',
                    'type'  => 'input',
                    'inputType' => 'text',
                    'label' => __('Update at')
                ],
                [
                    'id'          => 'tab_trending',
                    'type'        => 'listItem',
                    'label'       => __('Trending Tabs'),
                    'title_field' => 'title',
                    'settings'    => [
                        [
                            'id'        => 'title',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Title')
                        ],
                        [
                            'id'        => 'icon',
                            'type'      => 'input',
                            'inputType' => 'textArea',
                            'label'     => __('Icon')
                        ],
                        [
                            'id'      => 'category_id',
                            'type'    => 'select2',
                            'label'   => __('Filter by Category'),
                            'select2' => [
                                'ajax'  => [
                                    'url'      => route("product.admin.category.getForSelect2"),
                                    'dataType' => 'json'
                                ],
                                'width' => '100%',
                                'allowClear' => 'true',
                                'multiple' => '1',
                                'placeholder' => __('-- Select --')
                            ],
                            'pre_selected'=>route("product.admin.category.getForSelect2",['pre_selected'=>"1"])
                        ],
                        [
                            'id'        => 'number',
                            'type'      => 'input',
                            'inputType' => 'number',
                            'label'     => __('Number Item')
                        ],
                        [
                            'id'            => 'order',
                            'type'          => 'select',
                            'label'         => __('Order'),
                            'values'        => [
                                [
                                    'id'   => 'id',
                                    'name' => __("Date Create")
                                ],
                                [
                                    'id'   => 'title',
                                    'name' => __("Title")
                                ],
                            ],
                            "selectOptions"=> [
                                'hideNoneSelectedText' => "true"
                            ]
                        ],
                        [
                            'id'            => 'order_by',
                            'type'          => 'select',
                            'label'         => __('Order By'),
                            'values'        => [
                                [
                                    'id'   => 'asc',
                                    'name' => __("ASC")
                                ],
                                [
                                    'id'   => 'desc',
                                    'name' => __("DESC")
                                ],
                            ],
                            "selectOptions"=> [
                                'hideNoneSelectedText' => "true"
                            ]
                        ],
                    ]
                ],
            ]
        ]);
    }

    public function getName()
    {
        return __('Search Trending');
    }

    public function content($model = [])
    {
        return view('Template::frontend.blocks.SearchTrending.index', $model);
    }
}
