<?php
use Illuminate\Support\Facades\Route;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

Route::get('test1/{to}',function($to){
   $html = (new \Modules\Order\Emails\OrderEmail(\Modules\Order\Emails\OrderEmail::NEW_ORDER, \Modules\Order\Models\Order::find(1),$to))->render();
   $c = new CssToInlineStyles();
   return $c->convert($html, file_get_contents(public_path('/themes/Base/module/email/css/style.css')));
});
