<?php


namespace Modules\Plugin\Abstracts;


use Illuminate\Support\ServiceProvider;

class AbstractPluginProvider extends ServiceProvider
{

    public static $name;

    public static $desc;

    public static $author;

    public static $version = '1.0';
}
