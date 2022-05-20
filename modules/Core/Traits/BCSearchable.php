<?php


namespace Modules\Core\Traits;


use Laravel\Scout\ModelObserver;
use Laravel\Scout\Searchable;
use Laravel\Scout\SearchableScope;

trait BCSearchable
{
    use Searchable;

    public static function bootSearchable()
    {
        if(get_search_engine()) {
            static::addGlobalScope(new SearchableScope);

            static::observe(new ModelObserver);

            (new static)->registerSearchableMacros();
        }
    }
}
