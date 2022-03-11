<?php


namespace App\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class BaseJsonResource extends JsonResource
{
    public static $needs = [];


    /**
     * Retrieve a value based on a given condition.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    protected function whenNeed($key, $value, $default = null)
    {
        if (in_array($key,static::$needs)) {
            return value($value);
        }

        return func_num_args() === 3 ? value($default) : new MissingValue;
    }

}
