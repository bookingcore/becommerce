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
        if(!$locale) $locale = request()->get('lang',get_main_lang());

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
        if(is_enable_multi_lang()){

            $translation = $this->translate($locale);
            $translation->fill(request()->input());
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
        if($locale == app()->getLocale()){
            $find = $this->translation;
        }else {
            $find = $inst->where([
                'origin_id' => $this->getKey(),
                'locale' => $locale,
            ])->first();
        }

        if(!$find){
            $find = new $class;
            if($this->table_translation){
                $find->setTable($this->table_translation);
            }
            $find->locale = $locale;
            $find->origin_id = $this->getKey();
            $find->fill($this->getAttributes());
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
        return $this->hasOne($this->getTranslationModelNameDefault(),'origin_id')->where('locale',app()->getLocale());
    }

}
