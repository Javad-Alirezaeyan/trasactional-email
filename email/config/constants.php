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
      EmailQueued => ['Title'=>'Queued', 'ColorClass'=>'label-warning'],
      EmailSent => ['Title'=>'Sent', 'ColorClass'=>'label-info'],
      EmailDelivered => ['Title'=>'Delivered', 'ColorClass'=>'label-success'],
      EmailNotDelivered => ['Title'=>'NotDelivered', 'ColorClass'=>'label-danger'],
      EmailBounced => ['Title'=>'Bounced', 'ColorClass'=>'label-inverse'],
  ]

];