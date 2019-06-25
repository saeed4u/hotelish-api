<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-25
 * Time: 10:37
 */

namespace App\Utils;


use Illuminate\Support\Facades\Log;

trait Logging
{

    function logQuery($message)
    {
        Log::channel('queries')->info($message);
    }
}