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

        static::saving(function($model){
            if(!$model->object_model) $model->setAttribute('object_model',$model->type);
        });
    }
}
