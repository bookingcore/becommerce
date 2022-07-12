<?php


namespace Modules\Vendor\Models;


use App\User;

class Vendor extends User
{

    const MODE_NEW_ONLY = 'only_new';
    const MODE_NEW_EXIST = 'only_exist';
}
