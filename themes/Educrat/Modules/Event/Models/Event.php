<?php


namespace Themes\Educrat\Modules\Event\Models;


use Modules\Product\Models\Product;
use Themes\Educrat\Database\Factories\EventFactory;

class Event extends Product
{

    public $type = 'event';

    protected static function newFactory()
    {
        return EventFactory::new(); // TODO: Change the autogenerated stub
    }
}
