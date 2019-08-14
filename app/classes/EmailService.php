<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/7/19
 * Time: 10:54 AM
 */

namespace App\classes;

class EmailService
{
    private $emailServices = [];
    private $slctEmailService = null;
    public function __construct()
    {
        $this->emailServices = [  0=> new Sendgrid(), 1=> new Mailjet()];

        //find first the email service that is available from the above list
        foreach($this->emailServices as $es){
            if($es->isAvailable()){
                $this->slctEmailService = $es;
                break;
            }
        }
        
        // if all the email services are unavailable, we return null
        return  $this->slctEmailService ? $this : null;
    }

    /**
     * @param $index
     * this method changes type of the email service
     */
    public function setService($index)
    {
        return $this->slctEmailService = $this->emailServices[$index];
    }


    /**
     * @param string $subject
     * @param string $contentValue
     * @param array $receivers
     * @param string $from
     * @param string $contentType
     */
    public function sendEmail(string $subject, string $contentValue, array $receivers, string $from, string $contentType = "text/plain")
    {
        return  $this->slctEmailService->send($subject, $contentValue, $contentType, $receivers, $from);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getState($id)
    {
        return $this->slctEmailService->checkState($id);
        
    }
}