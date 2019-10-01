<?php
/**
 * Created by PhpStorm.
 * User: h2 gaming
 * Date: 10/1/2019
 * Time: 11:34 PM
 */
namespace Modules\Product\Models;

class VariableProduct extends Product
{
    public static function getTypeName()
    {
        return __("Variable Product");
    }
}