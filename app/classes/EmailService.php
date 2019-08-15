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
    public function __construct($index=0)
    {
        $this->emailServices = [  0=> new Sendgrid(), 1 => new Mailjet(), 2=> new Sparkpost()];
        //find first the email service that is available is selected from the above list
        for($i=$index; $i < count($this->emailServices); $i++){
            $es = $this->emailServices[$i];
            if($es->isAvailable()){
                $this->slctEmailService = $es;
                break;
            }
        }
        
        // if all the email services are unavailable, we return null
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


    public function serviceIsAvailable()
    {
        return   $this->slctEmailService == null ? false : true;
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