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
      EmailQueued => ['Title'=>'Queued'],
      EmailSent => ['Title'=>'Sent'],
      EmailDelivered => ['Title'=>'Delivered'],
      EmailNotDelivered => ['Title'=>'NotDelivered'],
      EmailBounced => ['Title'=>'Bounced'],
  ]

];