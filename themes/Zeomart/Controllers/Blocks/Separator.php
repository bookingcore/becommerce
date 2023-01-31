<?php
namespace Themes\Zeomart\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;

class Separator extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'      => 'size',
                    'type'    => 'select',
                    'label'   => __('Social'),
                    'values'  => [
                        [
                            'id'   => 'small',
                            'name' => __("Small")
                        ],
                        [
                            'id'   => 'medium',
                            'name' => __("Medium")
                        ]
                    ],
                    'default' => 'small'
                ],
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Separator');
    }

    public function content($model = [])
    {
        $data = [
            'size' => $model['size'] ?? 'small'
        ];
        return view("global.separator", $data);
    }
}
