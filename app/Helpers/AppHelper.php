<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Modules\Core\Models\Settings;
use App\Currency;
use Carbon\Carbon;
use Modules\Product\Models\ProductVariation;
use Modules\User\Models\UserWishList;

define( 'MINUTE_IN_SECONDS', 60 );
define( 'HOUR_IN_SECONDS', 60 * MINUTE_IN_SECONDS );
define( 'DAY_IN_SECONDS', 24 * HOUR_IN_SECONDS );
define( 'WEEK_IN_SECONDS', 7 * DAY_IN_SECONDS );
define( 'MONTH_IN_SECONDS', 30 * DAY_IN_SECONDS );
define( 'YEAR_IN_SECONDS', 365 * DAY_IN_SECONDS );

function setting_item($item,$default = '',$isArray = false){

    $res = Settings::item($item,$default);

    if($isArray and !is_array($res)){
        $res = (array) json_decode($res,true);
    }

    return $res;

}
function setting_item_array($item,$default = ''){

    return setting_item($item,$default,true);

}
function setting_item_with_lang($item,$locale = '',$default = ''){

    if(empty($locale)) $locale = app()->getLocale();
    if( empty(setting_item('site_locale'))
        OR empty(setting_item('site_enable_multi_lang'))
        OR  $locale == setting_item('site_locale')
    ){
        $locale = '';
    }

    return Settings::item($item.($locale ? '_'.$locale : ''),setting_item($item,$default));

}
function setting_update_item($item,$val){

    $s = Settings::where('name',$item)->first();
    if(empty($s)){
        $s = new Settings();
        $s->name = $item;
    }

    $s->val = $val;

    $s->save();
    Cache::forget('setting_' . $item);
    return $s;

}

function app_get_locale($locale = false , $before = false , $after = false){
//    if(setting_item('site_enable_multi_lang')){
//        return $locale ? $before.$locale.$after : $before.app()->getLocale().$after;
//    }
    return '';
}

function format_money($price){

   return Currency::format($price);

}

function currency_symbol(){

    $currency_main = setting_item('currency_main');

    $currency = Currency::getCurrency($currency_main);

    return $currency['symbol'] ?? '';
}

function generate_menu($location = '',$options = [])
{
    $options['walker'] = $options['walker'] ?? '\\Modules\\Core\\Walkers\\MenuWalker';

    $setting = json_decode(setting_item('menu_locations'),true);

    if(!empty($setting))
    {
        foreach($setting as $l=>$menuId){
            if($l == $location and $menuId){
                $menu = (new \Modules\Core\Models\Menu())->findById($menuId);
                if(!empty($menu)) {
                    $translation = $menu->translateOrOrigin(app()->getLocale());

                    if (!empty($translation)) {
                        $walker = new $options['walker']($translation);

                        if (!empty($translation)) {
                            $walker->generate();
                        }
                    }
                }
            }
        }
    }
}

function set_active_menu($item){
    \Modules\Core\Walkers\MenuWalker::setCurrentMenuItem($item);
}

 function get_exceprt($string,$length=200){
        $string=strip_tags($string);
        if(str_word_count($string)>0) {
            $arr=explode(' ',$string);
            $excerpt='';
            if(count($arr)>0) {
                $count=0;
                if($arr) foreach($arr as $str) {
                    $count+=strlen($str);
                    if($count>$length) {
                        $excerpt.='[...]';
                        break;
                    }
                    $excerpt.=' '.$str;
                }
                }return $excerpt;
            }
}

function getDatefomat($value) {
    return \Carbon\Carbon::parse($value)->format('j F, Y');

}

function get_file_url($file_id,$size="thumb"){
    if(empty($file_id)) return false;
    return \Modules\Media\Helpers\FileHelper::url($file_id,$size);
}

function get_image_tag($image_id,$size = 'thumb',$options = []){
    $options = array_merge([
       'lazy'=>true
    ],$options);

    $url = get_file_url($image_id,$size);

    if($url){
        $style = $options['style'] ?? '';
        $alt = $options['alt'] ?? '';
        $attr = '';
        $class= $options['class'] ?? '';
        if(!empty($options['lazy'])){
            $class.=' lazy';
            $attr.=" data-src=".e($url)." ";
        }else{
            $attr.=" src=".e($url);
        }
        return sprintf("<img class='%s' %s alt='%s' style='%s'>",e($class),e($attr),e($alt),e($style));
    }
}
function get_date_format(){
    return setting_item('date_format','m/d/Y');
}
function get_moment_date_format(){
    return php_to_moment_format(get_date_format());
}
function php_to_moment_format($format){

    $replacements = [
        'd' => 'DD',
        'D' => 'ddd',
        'j' => 'D',
        'l' => 'dddd',
        'N' => 'E',
        'S' => 'o',
        'w' => 'e',
        'z' => 'DDD',
        'W' => 'W',
        'F' => 'MMMM',
        'm' => 'MM',
        'M' => 'MMM',
        'n' => 'M',
        't' => '', // no equivalent
        'L' => '', // no equivalent
        'o' => 'YYYY',
        'Y' => 'YYYY',
        'y' => 'YY',
        'a' => 'a',
        'A' => 'A',
        'B' => '', // no equivalent
        'g' => 'h',
        'G' => 'H',
        'h' => 'hh',
        'H' => 'HH',
        'i' => 'mm',
        's' => 'ss',
        'u' => 'SSS',
        'e' => 'zz', // deprecated since version 1.6.0 of moment.js
        'I' => '', // no equivalent
        'O' => '', // no equivalent
        'P' => '', // no equivalent
        'T' => '', // no equivalent
        'Z' => '', // no equivalent
        'c' => '', // no equivalent
        'r' => '', // no equivalent
        'U' => 'X',
    ];
    $momentFormat = strtr($format, $replacements);
    return $momentFormat;
}

function display_date($time){

    if($time){
        if(is_string($time)){
            $time = strtotime($time);
        }

        if(is_object($time)){
            return $time->format(get_date_format());
        }
    }else{
       $time=strtotime(today());
    }

    return date(get_date_format(),$time);
}

function display_datetime($time){

    if(is_string($time)){
        $time = strtotime($time);
    }

    if(is_object($time)){
        return $time->format(get_date_format().' H:i');
    }

    return date(get_date_format().' H:i',$time);
}

function human_time_diff($from,$to = false){

    if(is_string($from)) $from = strtotime($from);
    if(is_string($to)) $to = strtotime($to);

    if ( empty( $to ) ) {
        $to = time();
    }

    $diff = (int) abs( $to - $from );

    if ( $diff < HOUR_IN_SECONDS ) {
        $mins = round( $diff / MINUTE_IN_SECONDS );
        if ( $mins <= 1 ) {
            $mins = 1;
        }
        /* translators: Time difference between two dates, in minutes (min=minute). %s: Number of minutes */
        if($mins){
            $since =__(':num mins',['num'=>$mins]);
        }else{
            $since =__(':num min',['num'=>$mins]);
        }

    } elseif ( $diff < DAY_IN_SECONDS && $diff >= HOUR_IN_SECONDS ) {
        $hours = round( $diff / HOUR_IN_SECONDS );
        if ( $hours <= 1 ) {
            $hours = 1;
        }
        /* translators: Time difference between two dates, in hours. %s: Number of hours */
        if($hours){
            $since =__(':num hours',['num'=>$hours]);
        }else{
            $since =__(':num hour',['num'=>$hours]);
        }

    } elseif ( $diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS ) {
        $days = round( $diff / DAY_IN_SECONDS );
        if ( $days <= 1 ) {
            $days = 1;
        }
        /* translators: Time difference between two dates, in days. %s: Number of days */
        if($days){
            $since =__(':num days',['num'=>$days]);
        }else{
            $since =__(':num day',['num'=>$days]);
        }

    } elseif ( $diff < MONTH_IN_SECONDS && $diff >= WEEK_IN_SECONDS ) {
        $weeks = round( $diff / WEEK_IN_SECONDS );
        if ( $weeks <= 1 ) {
            $weeks = 1;
        }
        /* translators: Time difference between two dates, in weeks. %s: Number of weeks */
        if($weeks){
            $since =__(':num weeks',['num'=>$weeks]);
        }else{
            $since =__(':num week',['num'=>$weeks]);
        }

    } elseif ( $diff < YEAR_IN_SECONDS && $diff >= MONTH_IN_SECONDS ) {
        $months = round( $diff / MONTH_IN_SECONDS );
        if ( $months <= 1 ) {
            $months = 1;
        }
        /* translators: Time difference between two dates, in months. %s: Number of months */

        if($months){
            $since =__(':num months',['num'=>$months]);
        }else{
            $since =__(':num month',['num'=>$months]);
        }

    } elseif ( $diff >= YEAR_IN_SECONDS ) {
        $years = round( $diff / YEAR_IN_SECONDS );
        if ( $years <= 1 ) {
            $years = 1;
        }
        /* translators: Time difference between two dates, in years. %s: Number of years */
        if($years){
            $since =__(':num years',['num'=>$years]);
        }else{
            $since =__(':num year',['num'=>$years]);
        }
    }

    return $since;
}

function human_time_diff_short($from,$to = false){
    if(!$to) $to = time();
    $today = strtotime(date('Y-m-d 00:00:00',$to));

    $diff = $from - $to;

    if($from > $today){
        return date('h:i A',$from);
    }

    if($diff < 5* DAY_IN_SECONDS){
        return date('D',$from);
    }

    return date('M d',$from);
}

function _n($l,$m,$count){
    if($count){
        return $m;
    }
    return $l;
}
function get_country_lists(){
    $countries = array
    (
        'AF' => 'Afghanistan',
        'AX' => 'Aland Islands',
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AS' => 'American Samoa',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AQ' => 'Antarctica',
        'AG' => 'Antigua And Barbuda',
        'AR' => 'Argentina',
        'AM' => 'Armenia',
        'AW' => 'Aruba',
        'AU' => 'Australia',
        'AT' => 'Austria',
        'AZ' => 'Azerbaijan',
        'BS' => 'Bahamas',
        'BH' => 'Bahrain',
        'BD' => 'Bangladesh',
        'BB' => 'Barbados',
        'BY' => 'Belarus',
        'BE' => 'Belgium',
        'BZ' => 'Belize',
        'BJ' => 'Benin',
        'BM' => 'Bermuda',
        'BT' => 'Bhutan',
        'BO' => 'Bolivia',
        'BA' => 'Bosnia And Herzegovina',
        'BW' => 'Botswana',
        'BV' => 'Bouvet Island',
        'BR' => 'Brazil',
        'IO' => 'British Indian Ocean Territory',
        'BN' => 'Brunei Darussalam',
        'BG' => 'Bulgaria',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'KH' => 'Cambodia',
        'CM' => 'Cameroon',
        'CA' => 'Canada',
        'CV' => 'Cape Verde',
        'KY' => 'Cayman Islands',
        'CF' => 'Central African Republic',
        'TD' => 'Chad',
        'CL' => 'Chile',
        'CN' => 'China',
        'CX' => 'Christmas Island',
        'CC' => 'Cocos (Keeling) Islands',
        'CO' => 'Colombia',
        'KM' => 'Comoros',
        'CG' => 'Congo',
        'CD' => 'Congo, Democratic Republic',
        'CK' => 'Cook Islands',
        'CR' => 'Costa Rica',
        'CI' => 'Cote D\'Ivoire',
        'HR' => 'Croatia',
        'CU' => 'Cuba',
        'CY' => 'Cyprus',
        'CZ' => 'Czech Republic',
        'DK' => 'Denmark',
        'DJ' => 'Djibouti',
        'DM' => 'Dominica',
        'DO' => 'Dominican Republic',
        'EC' => 'Ecuador',
        'EG' => 'Egypt',
        'SV' => 'El Salvador',
        'GQ' => 'Equatorial Guinea',
        'ER' => 'Eritrea',
        'EE' => 'Estonia',
        'ET' => 'Ethiopia',
        'FK' => 'Falkland Islands (Malvinas)',
        'FO' => 'Faroe Islands',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'FR' => 'France',
        'GF' => 'French Guiana',
        'PF' => 'French Polynesia',
        'TF' => 'French Southern Territories',
        'GA' => 'Gabon',
        'GM' => 'Gambia',
        'GE' => 'Georgia',
        'DE' => 'Germany',
        'GH' => 'Ghana',
        'GI' => 'Gibraltar',
        'GR' => 'Greece',
        'GL' => 'Greenland',
        'GD' => 'Grenada',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GT' => 'Guatemala',
        'GG' => 'Guernsey',
        'GN' => 'Guinea',
        'GW' => 'Guinea-Bissau',
        'GY' => 'Guyana',
        'HT' => 'Haiti',
        'HM' => 'Heard Island & Mcdonald Islands',
        'VA' => 'Holy See (Vatican City State)',
        'HN' => 'Honduras',
        'HK' => 'Hong Kong',
        'HU' => 'Hungary',
        'IS' => 'Iceland',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'IR' => 'Iran, Islamic Republic Of',
        'IQ' => 'Iraq',
        'IE' => 'Ireland',
        'IM' => 'Isle Of Man',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'JM' => 'Jamaica',
        'JP' => 'Japan',
        'JE' => 'Jersey',
        'JO' => 'Jordan',
        'KZ' => 'Kazakhstan',
        'KE' => 'Kenya',
        'KI' => 'Kiribati',
        'KR' => 'Korea',
        'KW' => 'Kuwait',
        'KG' => 'Kyrgyzstan',
        'LA' => 'Lao People\'s Democratic Republic',
        'LV' => 'Latvia',
        'LB' => 'Lebanon',
        'LS' => 'Lesotho',
        'LR' => 'Liberia',
        'LY' => 'Libyan Arab Jamahiriya',
        'LI' => 'Liechtenstein',
        'LT' => 'Lithuania',
        'LU' => 'Luxembourg',
        'MO' => 'Macao',
        'MK' => 'Macedonia',
        'MG' => 'Madagascar',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'MV' => 'Maldives',
        'ML' => 'Mali',
        'MT' => 'Malta',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'MR' => 'Mauritania',
        'MU' => 'Mauritius',
        'YT' => 'Mayotte',
        'MX' => 'Mexico',
        'FM' => 'Micronesia, Federated States Of',
        'MD' => 'Moldova',
        'MC' => 'Monaco',
        'MN' => 'Mongolia',
        'ME' => 'Montenegro',
        'MS' => 'Montserrat',
        'MA' => 'Morocco',
        'MZ' => 'Mozambique',
        'MM' => 'Myanmar',
        'NA' => 'Namibia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NL' => 'Netherlands',
        'AN' => 'Netherlands Antilles',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NF' => 'Norfolk Island',
        'MP' => 'Northern Mariana Islands',
        'NO' => 'Norway',
        'OM' => 'Oman',
        'PK' => 'Pakistan',
        'PW' => 'Palau',
        'PS' => 'Palestinian Territory, Occupied',
        'PA' => 'Panama',
        'PG' => 'Papua New Guinea',
        'PY' => 'Paraguay',
        'PE' => 'Peru',
        'PH' => 'Philippines',
        'PN' => 'Pitcairn',
        'PL' => 'Poland',
        'PT' => 'Portugal',
        'PR' => 'Puerto Rico',
        'QA' => 'Qatar',
        'RE' => 'Reunion',
        'RO' => 'Romania',
        'RU' => 'Russian Federation',
        'RW' => 'Rwanda',
        'BL' => 'Saint Barthelemy',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts And Nevis',
        'LC' => 'Saint Lucia',
        'MF' => 'Saint Martin',
        'PM' => 'Saint Pierre And Miquelon',
        'VC' => 'Saint Vincent And Grenadines',
        'WS' => 'Samoa',
        'SM' => 'San Marino',
        'ST' => 'Sao Tome And Principe',
        'SA' => 'Saudi Arabia',
        'SN' => 'Senegal',
        'RS' => 'Serbia',
        'SC' => 'Seychelles',
        'SL' => 'Sierra Leone',
        'SG' => 'Singapore',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'ZA' => 'South Africa',
        'GS' => 'South Georgia And Sandwich Isl.',
        'ES' => 'Spain',
        'LK' => 'Sri Lanka',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SJ' => 'Svalbard And Jan Mayen',
        'SZ' => 'Swaziland',
        'SE' => 'Sweden',
        'CH' => 'Switzerland',
        'SY' => 'Syrian Arab Republic',
        'TW' => 'Taiwan',
        'TJ' => 'Tajikistan',
        'TZ' => 'Tanzania',
        'TH' => 'Thailand',
        'TL' => 'Timor-Leste',
        'TG' => 'Togo',
        'TK' => 'Tokelau',
        'TO' => 'Tonga',
        'TT' => 'Trinidad And Tobago',
        'TN' => 'Tunisia',
        'TR' => 'Turkey',
        'TM' => 'Turkmenistan',
        'TC' => 'Turks And Caicos Islands',
        'TV' => 'Tuvalu',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'AE' => 'United Arab Emirates',
        'GB' => 'United Kingdom',
        'US' => 'United States',
        'UM' => 'United States Outlying Islands',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'VU' => 'Vanuatu',
        'VE' => 'Venezuela',
        'VN' => 'Viet Nam',
        'VG' => 'Virgin Islands, British',
        'VI' => 'Virgin Islands, U.S.',
        'WF' => 'Wallis And Futuna',
        'EH' => 'Western Sahara',
        'YE' => 'Yemen',
        'ZM' => 'Zambia',
        'ZW' => 'Zimbabwe',
    );
    return $countries;
}

function get_country_name($name){
    $all = get_country_lists();

    return $all[$name] ?? $name;
}

function get_page_url($page_id)
{
    $page = \Modules\Page\Models\Page::find($page_id);

    if($page){
        return $page->getDetailUrl();
    }
    return false;
}

function get_payment_gateway_obj($payment_gateway){

    $gateways = config('booking.payment_gateways');

    if(empty($gateways[$payment_gateway]) or !class_exists($gateways[$payment_gateway]))
    {
        return false;
    }

    $gatewayObj = new $gateways[$payment_gateway]($payment_gateway);

    return $gatewayObj;

}

function recaptcha_field($action){
    return \App\Helpers\ReCaptchaEngine::captcha($action);
}

function add_query_arg($args,$uri = false) {

    if(empty($uri)) $uri = request()->url();

    $query = request()->query();

    if(!empty($args)){
        foreach ($args as $k=>$arg){
            $query[$k] = $arg;
        }
    }

    return $uri.'?'.http_build_query($query);
}

function is_default_lang($lang = '')
{
    if(!$lang) $lang = request()->query('lang');
    if(!$lang) $lang = request()->route('lang');

    if(empty($lang) or $lang == setting_item('site_locale')) return true;

    return false;
}

function get_lang_switcher_url($locale = false){

    $request =  request();

    $segments = $request->segments();

    if(empty($segments[0])){
        // Set the default language code as the first segment
        $segments = \Illuminate\Support\Arr::prepend($segments, $locale);
    }
    if(!empty($segments[0])){

        $lang = \Modules\Language\Models\Language::findByLocale($segments[0]);
        if(!empty($lang))
        {
            $segments[0] = $locale;
        }else{
            $segments = \Illuminate\Support\Arr::prepend($segments, $locale);
        }
    }

    $url = implode('/', $segments);

    if(!empty($request->query())){
        $url.='?'.http_build_query($request->query());
    }
    return url($url);
}

function translate_or_origin($key,$settings = [],$locale = '')
{
    if(empty($locale)) $locale = request()->query('lang');

    if($locale and $locale == setting_item('site_locale')) $locale = false;

    if(empty($locale)) return $settings[$key] ?? '';
    else{
        return $settings[$key.'_'.$locale] ?? '';
    }
}

function get_bookable_services(){

    $all = [];
    // Modules
    $custom_modules = \Modules\ServiceProvider::getModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $module){
            $moduleClass = "\\Modules\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $services = call_user_func([$moduleClass,'getBookableServices']);
                $all = array_merge($all,$services);
            }

        }
    }

// Custom Menu
    $custom_modules = \Custom\ServiceProvider::getModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $module){
            $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $services = call_user_func([$moduleClass,'getBookableServices']);
                $all = array_merge($all,$services);
            }
        }
    }

    return $all;
}


function get_product_types(){
    $all = [];
    // Modules
    $custom_modules = \Modules\ServiceProvider::getModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $module){
            $moduleClass = "\\Modules\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $services = call_user_func([$moduleClass,'getProductTypes']);
                $all = array_merge($all,$services);
            }

        }
    }
    $custom_modules = \Custom\ServiceProvider::getModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $module){
            $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $services = call_user_func([$moduleClass,'getProductTypes']);
                $all = array_merge($all,$services);
            }
        }
    }

    return $all;
}

function get_admin_product_tabs(){
    $all = [];
    // Modules
    $custom_modules = \Modules\ServiceProvider::getModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $module){
            $moduleClass = "\\Modules\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $services = call_user_func([$moduleClass,'getAdminProductTabs']);
                $all = array_merge($all,$services);
            }

        }
    }
    $custom_modules = \Custom\ServiceProvider::getModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $module){
            $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $services = call_user_func([$moduleClass,'getAdminProductTabs']);
                $all = array_merge($all,$services);
            }
        }
    }

    //@todo Sort Menu by Position
    $all = \Illuminate\Support\Arr::sort($all, function ($value) {
        return $value['position'] ?? 10;
    });

    return $all;
}



function file_get_contents_curl($url,$isPost = false,$data = []) {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    if($isPost){
        curl_setopt($ch, CURLOPT_POST, count($data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function size_unit_format($number=''){
    switch (setting_item('size_unit')){
        case "m2":
            return $number." m<sup>2</sup>";
            break;
        default:
            return $number." ".__('sqft');
            break;
    }
}

function get_payment_gateways(){
    //getBlocks
    $gateways = config('booking.payment_gateways');
    // Modules
    $custom_modules = \Modules\ServiceProvider::getModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $module){
            $moduleClass = "\\Modules\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass) and is_callable([$moduleClass,'getPaymentGateway']))
            {
                $gateway = call_user_func([$moduleClass,'getPaymentGateway']);
                if(!empty($gateway)){
                    $gateways = array_merge($gateways,$gateway);
                }
            }
        }
    }
    //Plugin
    $plugin_modules = \Plugins\ServiceProvider::getModules();
    if(!empty($plugin_modules)){
        foreach($plugin_modules as $module){
            $moduleClass = "\\Plugins\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass))
            {
                $gateway = call_user_func([$moduleClass,'getPaymentGateway']);
                if(!empty($gateway)){
                    $gateways = array_merge($gateways,$gateway);
                }
            }
        }
    }

    //Custom
    $custom_modules = \Custom\ServiceProvider::getModules();
    if(!empty($custom_modules)){
        foreach($custom_modules as $module){
            $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
            if(class_exists($moduleClass) and is_callable([$moduleClass,'getPaymentGateway']))
            {
                $gateway = call_user_func([$moduleClass,'getPaymentGateway']);
                if(!empty($gateway)){
                    $gateways = array_merge($gateways,$gateway);
                }
            }
        }
    }

    return $gateways;
}

function get_current_currency($need,$default = '')
{
    return Currency::getCurrent($need,$default);
}

function booking_status_to_text($status)
{
    switch ($status){
        case "draft":
            return __('Draft');
            break;
        case "unpaid":
            return __('Unpaid');
            break;
        case "paid":
            return __('Paid');
            break;
        case "processing":
            return __('Processing');
            break;
        case "completed":
            return __('Completed');
            break;
        case "confirmed":
            return __('Confirmed');
            break;
        case "cancelled":
            return __('Cancelled');
        case "partial_payment":
            return __('Partial Payment');
            break;
        default:
            return ucfirst($status ?? '');
            break;
    }
}
function verify_type_to($type,$need = 'name')
{
    switch ($type){
        case "phone":
            return __("Phone");
            break;
        case "number":
            return __("Number");
            break;
        case "email":
            return __("Email");
            break;
        case "file":
            return __("Attachment");
            break;
        case "multi_files":
            return __("Multi Attachments");
            break;
        case "text":
        default:
            return __("Text");
            break;
    }
}

function get_all_verify_fields(){
    return setting_item_array('role_verify_fields');
}
/*Hook Functions*/
function add_action($hook, $callback, $priority = 20, $arguments = 1){
    $args = func_get_args();
    $m = \Modules\Core\Helpers\HookManager::inst();
    $m->addAction($hook, $callback, $priority, $arguments);
}
function add_filter($hook, $callback, $priority = 20, $arguments = 1){
    $args = func_get_args();
    $m = \Modules\Core\Helpers\HookManager::inst();
    $m->addFilter($hook, $callback, $priority, $arguments);
}
function do_action(){
    $args = func_get_args();
    $m = \Modules\Core\Helpers\HookManager::inst();
    return call_user_func_array([$m,'action'],$args);
}
function apply_filters(){
    $args = func_get_args();
    $m = \Modules\Core\Helpers\HookManager::inst();
    return call_user_func_array([$m,'filter'],$args);
}
function is_installed(){
    return file_exists(storage_path('installed'));
}
function is_enable_multi_lang(){
    return (bool) setting_item('site_enable_multi_lang');
}
function is_enable_language_route(){
    return (is_installed() and is_enable_multi_lang() and app()->getLocale() != setting_item('site_locale'));
}
function get_cart_fragments(){
    return [
        '.widget_shopping_cart_content, .user-mini-cart .cart-content'=>view('Booking::frontend.cart.mini-cart')->render(),
        '.ps-table--shopping-cart tbody'=>view('Booking::frontend.cart.list-cart')->render(),
        '.user-cart-count'=>Cart::count()
    ];
}

/**
 * @return Gloudemans\Shoppingcart\Facades\Cart
 */
function cart(){
    return resolve('Cart');
}

function wishlist(){
    $auth = \Illuminate\Support\Facades\Auth::id();
    $wishlist = [];
    if (!empty($auth)){
        $l_wishlist = UserWishList::select('object_id')->where('create_user', $auth)->get();
        $wishlist = [];
        if (!empty($l_wishlist)){
            foreach ($l_wishlist as $list){
                array_push($wishlist, $list->object_id);
            }
        }
    }
    return array_unique($wishlist);
}

function getMinMaxPriceProductVariations($row){
    if($row->product_type=='variable'){
        $array = $row->hasMany(ProductVariation::class)->pluck('price')->toArray();
        $array= array_values(Arr::sort($array));
        return ['min'=>head($array),'max'=>last($array)];
    }
}

function list_compare_id(){
    $compare = (!empty(session('compare'))) ? session('compare') : '';
    $l_compare = [];
    if (!empty($compare)){
        foreach ($compare as $list){
            array_push($l_compare, $list['id']);
        }
    }
    return $l_compare;
}

function list_homepage_style(){
    return [
        '0'     =>  '-- Homepage Default --',
        '1'=> 'Style 1'
    ];
}

function position_attributes(){
    $attrs = \Modules\Core\Models\Attributes::all();
    $test = [];
    if (!empty($attrs)){
        foreach ($attrs as $position){
            array_push($test, $position->positon);
        }
    }
    return $test;
}
function is_admin(){
    // Check is Admin
    return (auth()->check() and auth()->user()->hasPermissionTo('dashboard_access'));
}
function is_vendor(){
    // Check is vendor
    return (auth()->check() and auth()->user()->hasPermissionTo('dashboard_vendor_access'));
}
