<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/11/19
 * Time: 10:58 PM
 */




if (!defined('EmailQueued')) define("EmailQueued", 0);
if (!defined('EmailNotSent')) define("EmailNotSent", 1);
if (!defined('EmailSent')) define("EmailSent", 2);
if (!defined('EmailNotDelivered'))define("EmailNotDelivered", 4);
if (!defined('EmailDelivered'))define("EmailDelivered", 3);
if (!defined('EmailBounced')) define("EmailBounced", 5);

return [
  'EmailState'=>[
      EmailQueued => ['Title'=>'Queued', 'ColorClass'=>'label-warning'],
      EmailNotSent => ['Title'=>'NotSent', 'ColorClass'=>'label-danger'],
      EmailSent => ['Title'=>'Sent', 'ColorClass'=>'label-info'],
      EmailDelivered => ['Title'=>'Delivered', 'ColorClass'=>'label-success'],
      EmailNotDelivered => ['Title'=>'NotDelivered', 'ColorClass'=>'label-danger'],
      EmailBounced => ['Title'=>'Bounced', 'ColorClass'=>'label-inverse'],
  ]

];