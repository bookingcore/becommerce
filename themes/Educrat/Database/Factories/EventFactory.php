<?php


namespace Themes\Educrat\Database\Factories;



use Themes\Base\Database\Factories\ProductFactory;
use Themes\Educrat\Modules\Event\Models\Event;

class EventFactory extends ProductFactory
{
    protected $model = Event::class;

    public function configure()
    {

    }
}
