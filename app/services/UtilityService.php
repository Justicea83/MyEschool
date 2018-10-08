<?php
/**
 * Created by PhpStorm.
 * User: Arthur
 * Date: 31/08/2018
 * Time: 10:54
 */

namespace App\services;


class UtilityService
{
    public static function generateRandomString($length = 15)
    {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }


}