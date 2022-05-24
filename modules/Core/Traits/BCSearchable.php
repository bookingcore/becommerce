<?php


namespace Modules\Core\Traits;


use Laravel\Scout\Builder;
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

    /**
     * Perform a search against the model's indexed data.
     *
     * @param  string  $query
     * @param  \Closure  $callback
     * @return \Laravel\Scout\Builder
     */
    public static function scountSearch($query = '', $callback = null)
    {
        return app(Builder::class, [
            'model' => new static,
            'query' => $query,
            'callback' => $callback,
            'softDelete'=> static::usesSoftDelete() && config('scout.soft_delete', false),
        ]);
    }
}
