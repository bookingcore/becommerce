<?php
namespace Themes\Freshen\Controllers\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class Deliver extends BaseBlock
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
                [      'id'        => 'phone',
                       'type'      => 'input',
                       'inputType' => 'text',
                       'label'     => __('Phone')
                ],
                [
                    'id'    => 'image_id',
                    'type'  => 'uploader',
                    'label' => __('Icon Image')
                ]
            ],
            'category'=>__("Other")
        ]);
    }

    public function getName()
    {
        return __('Deliver Divider');
    }

    public function content($model = [])
    {
        $data = [
            'title'     => $model['title'] ?? '',
            'phone'     => $model['phone'] ?? '',
            'image_url' => $model['image_id'] ? get_file_url($model['image_id'], 'full') : '',
        ];
        return view('blocks.deliver.index', $data);
    }
}
