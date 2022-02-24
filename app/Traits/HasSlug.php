<?php


namespace App\Traits;


use Illuminate\Support\Str;

trait HasSlug
{

    public static function bootHasSlug(){
        self::creating(function($model){
            $model->maybeGenerateSlug();
        });

        self::updating(function($model){
            $model->maybeGenerateSlug();
        });
    }

    public function maybeGenerateSlug(){
        if ($this->slugField && $this->slugFromField && (!$this->getAttribute($this->slugField) or $this->isDirty($this->slugField))) {
            $this->setAttribute($this->slugField,$this->generateSlug($this->getAttribute($this->slugField)));
        }
    }

    public function generateSlug($string = false, $count = 0)
    {
        $slugFromField = $this->slugFromField;
        if (empty($string))
            $string = $this->getAttribute($slugFromField);

        $slug = $newSlug = $this->strToSlug($string);
        $newSlug = $slug . ($count ? '-' . $count : '');
        $model = static::select('count(id)');
        if ($this->id) {
            $model->where('id', '<>', $this->id);
        }
        $check = $model->where($this->slugField, $newSlug)->count($this->primaryKey);
        if (!empty($check)) {
            return $this->generateSlug($slug, $count + 1);
        }
        return $newSlug;
    }

    // Add Support for non-ascii string
    // Example বাংলাদেশ   ব্যাংকের    রিজার্ভের  অর্থ  চুরির   ঘটনায়   ফিলিপাইনের
    protected function strToSlug($string) {
        $slug = Str::slug($string);
        if(empty($slug)){
            $slug = preg_replace('/\s+/u', '-', trim($string));
        }
        return $slug;
    }
}
