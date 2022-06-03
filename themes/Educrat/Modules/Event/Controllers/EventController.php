<?php


namespace Themes\Educrat\Modules\Event\Controllers;


use Modules\Product\Models\Product;
use Themes\Base\Controllers\ProductController;
use Themes\Educrat\Modules\Event\Models\Event;

class EventController extends ProductController
{
    public function __construct(Event $event)
    {
        parent::__construct($event);
    }
}
