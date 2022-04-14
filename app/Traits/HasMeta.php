<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Model;

Trait HasMeta
{
    public function getMeta($key, $default = '')
    {
        $val = $this->metaClass::query()->where([
            $this->meta_parent_key => $this->id,
            'name'       => $key
        ])->first();
        if (!empty($val)) {
            return $val->val;
        }
        return $default;
    }

    public function getJsonMeta($key, $default = [])
    {
        $meta = $this->getMeta($key, $default);
        if(empty($meta)) return false;
        return json_decode($meta, true);
    }

    public function addMeta($key, $val, $multiple = false)
    {
        if (is_object($val) or is_array($val))
            $val = json_encode($val);
        if ($multiple) {
            $meta = new $this->metaClass([
                'name'       => $key,
                'val'        => $val,
            ]);
            $meta->setAttribute($this->meta_parent_key,$this->id);
            return $meta->save();
        } else {
            $find = $this->metaClass::firstOrNew([
                $this->meta_parent_key => $this->id,
                'name'       => $key
            ]);
            $find->val = $val;
            return $find->save();
        }
    }
}
