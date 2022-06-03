<?php


namespace Modules\Product\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class HasObjectModelScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->where($model->qualifyColumn('object_model'),$model->type);
    }
}
