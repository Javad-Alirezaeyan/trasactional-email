<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/10/19
 * Time: 2:32 PM
 */

namespace App\Http\Controllers\API;


class ResponseObject
{
    const status_ok = "OK";
    const status_failed = "FAIL";
    const code_ok = 200;
    const code_failed = 400;
    const code_unauthorized = 403;
    const code_not_found = 404;
    const code_error = 500;
    public $status = "";

    public $code = "";

    public $message ="";
    public $errors = [];
    public $result = "";

}