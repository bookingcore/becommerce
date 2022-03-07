<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/6/2022
 * Time: 9:44 PM
 */

namespace Modules\Template\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Media\Helpers\FileHelper;

class RecentNews extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([

        ]);
    }

    public function getName()
    {
        return __('Recent News');
    }

    public function content($model = [])
    {
        return view('blocks.recent-news.index', $model);
    }
}
