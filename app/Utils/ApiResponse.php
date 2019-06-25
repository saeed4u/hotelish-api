<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-25
 * Time: 11:06
 */

namespace App\Utils;


trait ApiResponse
{
    use Constants;

    function success($message = 'success', $data = null)
    {
        if (is_null($data)) {
            return response()->json(array('status_code' => static::$SUCCESS_STATUS_CODE, 'message' => $message));
        }

        return response()->json(array_merge(array('status_code' => static::$SUCCESS_STATUS_CODE, 'message' => $message),
            $data));
    }

    function badRequest($message = 'Bad Request')
    {
        return response(array('status_code' => static::$BAD_REQUEST_CODE, 'message' => $message), 400);
    }

    function validationError($message = 'Unprocessable Entity', $data = null)
    {
        if (is_null($data)) {
            return response()->json(array('status_code' => static::$BAD_REQUEST_CODE, 'message' => $message), 422);
        }
        return response(array_merge(array('status_code' => static::$BAD_REQUEST_CODE, 'message' => $message), $data),
            422);
    }

    function notFound($message = 'Not Found', $path = '')
    {
        return response()->json(array('status_code' => static::$NOT_FOUND_CODE, 'message' => $message, 'path' => $path),
            404);
    }

    function unauthorised($message = 'Unauthorised')
    {
        return response()->json(array('status_code' => static::$UNAUTHORISED_REQUEST_CODE, 'message' => $message), 401);
    }

    function methodNotAllowed($message = 'Method not allowed')
    {
        return response()->json(array('status_code' => static::$METHOD_NOT_ALLOWED_REQUEST_CODE, 'message' => $message),
            405);
    }

    function unsupportedMediaTyp($message = 'Unsupported Media Type')
    {
        return response()->json(array('status_code' => static::$UNSUPPORTED_MEDIA_TYPE, 'message' => $message), 415);
    }

    function forbidden($message = 'forbidden')
    {
        return response()->json(array('status_code' => static::$FORBIDDEN_REQUEST_CODE, 'message' => $message), 403);
    }


    function badGateway($message = 'Bad Gateway')
    {
        return response()->json(array('status_code' => static::$BAD_GATEWAY_REQUEST_CODE, 'message' => $message), 502);
    }
}