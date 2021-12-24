<?php
/**
 * Created by PhpStorm.
 * User: dunglinh
 * Date: 6/8/19
 * Time: 22:06
 */

namespace App\Traits;

use App\BaseTranslation;

trait HasTranslations
{

    /**
     * Table name of translation table
     * @var string
     */
    public $table_translation = '';

    /**
     * Array of translate-able field
     * @var array
     */
    public $translatable = [];

    /**
     * Class name for translation, default is current class
     * @var
     */
    protected $translation_class;

    /**
     * @todo Save Origin and Translation
     *
     * @param bool $locale
     * @return bool
     */
    public function saveWithTranslation($locale = false): bool
    {
        if(!$locale) $locale = get_main_lang();

        if(is_default_lang($locale)){
            // Main lang, we need to save origin table also
            $this->save();
        }

        $res = $this->saveTranslation($locale);

        return $res;
    }

    /**
     * @param false $locale
     * @return boolean
     */
    public function saveTranslation($locale = false){
        if(is_enable_multi_lang() and !empty($this->translatable)){

            $translation = $this->translate($locale);
            if(!empty($this->translatable)){

                foreach ($this->translatable as $key){
                    $translation->setAttribute($key,request()->input($key));
                }

            }else{
                // allow fillable
                $translation->fill(request()->input());
            }
            return $translation->save();
        }
        return true;
    }

    /**
     * Get Translated Model
     *
     * @param false $locale
     */
    public function translate($locale = false){
        if(empty($locale)) $locale = app()->getLocale();

        $class = $this->getTranslationModelNameDefault();

        $inst = new $class;
        if($this->table_translation){
            $inst->setTable($this->table_translation);
        }

        $find =  $inst->where([
            'origin_id'=>$this->id,
            'locale'=>$locale,
        ])->first();

        if(!$find){
            $find = new $class;
            if($this->table_translation){
                $find->setTable($this->table_translation);
            }
            $find->locale = $locale;
            $find->origin_id = $this->id;
            foreach ($this->translatable as $key){
                $find->setAttribute($key,$this->getAttribute($key));
            }
        }
        if(!$find->type) $find->type = $this->type;

        return $find;
    }


    /**
     * @internal will change to private
     */
    public function getTranslationModelNameDefault(): string
    {
        $class = $this->translation_class;

        if(!$class and class_exists(get_class($this).'Translation')){
            $class = get_class($this).'Translation';
        }
        if(!$class){
            $class = BaseTranslation::class;
        }

        return $class;
    }

    public function translation(){
        return $this->belongsTo($this->getTranslationModelNameDefault(),'translation_id');
    }

}
