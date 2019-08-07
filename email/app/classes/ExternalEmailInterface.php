<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/7/19
 * Time: 10:36 AM
 */

namespace App\classes;

interface ExternalEmailInterface
{
    function send($subject , $contentValue, $contetnType, $receiver, $from);
    function checkState($id);
    function isAvailable();
}