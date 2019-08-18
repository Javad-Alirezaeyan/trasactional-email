<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/11/19
 * Time: 10:58 PM
 */




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