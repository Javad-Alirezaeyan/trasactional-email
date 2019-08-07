<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/7/19
 * Time: 10:36 AM
 */

namespace App\Compenents\ExternalEmail;


interface ExternalEmailInterface
{
    function send($title , $body, $receiver);
    function checkState($id);
    function isAvailable();
}