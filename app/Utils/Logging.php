<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-25
 * Time: 10:37
 */

namespace App\Utils;


use Exception;
use Illuminate\Http\Request;
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
    function logDevice($message)
    {
        Log::channel('device')->info($message);
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

    function logRequest(Request $request)
    {
        $id = $request->req_id;
        $path = $request->path();
        $method = $request->method();
        $body = json_encode($request->json()->all());
        Log::channel('request_logs')->info("Request info: ID =  $id; Path = $path; Method = $method; Payload = $body");
    }


    function logResponse(Request $request, $response)
    {
        $id = $request->req_id;
        $status = $response->status();
        $response = $response->getContent();
        Log::channel('request_logs')->info("Response info: Request ID =  $id; Status=$status, Response: $response");
    }
}
