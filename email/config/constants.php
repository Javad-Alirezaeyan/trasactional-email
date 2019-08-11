<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/11/19
 * Time: 10:58 PM
 */


define("EmailQueued", 0);
define("EmailSent", 1);
define("EmailDelivered", 2);
define("EmailNotDelivered", 3);
define("EmailBounced", 4);
return [
  'EmailState'=>[
      EmailQueued => ['Title'=>'Queued', 'ColorClass'=>'text-warning'],
      EmailSent => ['Title'=>'Sent', 'ColorClass'=>'text-info'],
      EmailDelivered => ['Title'=>'Delivered', 'ColorClass'=>'text-success'],
      EmailNotDelivered => ['Title'=>'NotDelivered', 'ColorClass'=>'text-danger'],
      EmailBounced => ['Title'=>'Bounced', 'ColorClass'=>'text-inverse'],
  ]

];