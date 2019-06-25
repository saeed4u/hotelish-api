<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-25
 * Time: 10:37
 */

namespace App\Utils;


use Exception;
use Illuminate\Support\Facades\Log;

trait Logging
{

    function logQuery($message)
    {
        Log::channel('queries')->info($message);
    }

    function logAuth($message)
    {
        Log::channel('auth')->info($message);
    }

    function logException(Exception $exception)
    {
        Log::channel('error')->emergency('message = ' . $exception->getMessage(), [
            'line' => $exception->getLine(),
            'file' => $exception->getFile(),
            'trace' => $exception->getTraceAsString(),
            'code' => $exception->getCode(),
        ]);
    }
}