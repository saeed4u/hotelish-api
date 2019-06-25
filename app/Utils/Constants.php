<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-25
 * Time: 11:08
 */

namespace App\Utils;


trait Constants
{

    protected static $BAD_REQUEST_CODE = 'err.request.badRequest';
    protected static $UNAUTHORISED_REQUEST_CODE = 'err.request.unauthorised';
    protected static $BAD_GATEWAY_REQUEST_CODE = 'err.request.badGateway';
    protected static $METHOD_NOT_ALLOWED_REQUEST_CODE = 'err.request.methodNotAllowed';
    protected static $NOT_FOUND_CODE = 'err.request.notFound';
    protected static $SUCCESS_STATUS_CODE = "success";
    protected static $FORBIDDEN_REQUEST_CODE = "err.request.forbidden";
    protected static $UNSUPPORTED_MEDIA_TYPE = "error.request.unsupportedMediaType";

    protected static $USER_ACCOUNT_BLOCKED_TOO_MANY_LOGIN_ATTEMPTS = 3;

}