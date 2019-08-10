<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/8/19
 * Time: 12:14 PM
 */

namespace App\classes;


class Mailtrap implements ExternalEmailInterface
{


    function send($subject, $contentValue, $contetnType, $receiver, $from)
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