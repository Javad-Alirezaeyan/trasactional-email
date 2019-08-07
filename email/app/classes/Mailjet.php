<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/7/19
 * Time: 10:51 AM
 */

namespace App\classes;



class Mailjet implements ExternalEmailInterface
{
    public function __construct()
    {
        
    }
    function send($subject, $contentValue, $contentType, $receiver, $from)
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