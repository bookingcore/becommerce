<?php


namespace Modules\Product\Traits;


use Modules\Product\Scopes\HasObjectModelScope;

trait HasObjectModel
{
    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootHasObjectModel()
    {
        static::addGlobalScope(new HasObjectModelScope);
    }
}
