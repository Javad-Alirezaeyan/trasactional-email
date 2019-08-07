<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/7/19
 * Time: 10:51 AM
 */

namespace App\Components\ExternalEmail;


use App\Compenents\ExternalEmail\ExternalEmailInterface;

class Mailjet implements ExternalEmailInterface
{

    function send($title, $body, $receiver)
    {
        // TODO: Implement send() method.
    }

    function checkState($id)
    {
        // TODO: Implement checkState() method.
    }

    function isAvailable()
    {
        // TODO: Implement isAvailable() method.
    }
}