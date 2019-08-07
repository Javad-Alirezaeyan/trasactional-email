<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/7/19
 * Time: 10:53 AM
 */

namespace App\classes;


class Sendgrid implements ExternalEmailInterface
{
    public function __construct()
    {
        
    }

    function send($subject, $contentValue, $contentType, $receiver, $from)
    {
        // TODO: Implement send() method.

        $to = [];
        foreach($receiver as $email){
            $to[] =['email'=> $email];
        }
        $params = [
            'personalizations' =>
                [
                    [
                        'to' => $to
                    ],
                ],
            'from' =>
                [
                    'email' => $from,
                ],
           /* 'reply_to' =>
                [
                    'email' => 'alirezaeyan.javad@gmail.com',
                ],*/
            'subject' => $subject,
            'content' =>
                [
                    [
                        'type' => $contentType,
                        'value' => $contentValue,
                    ],
                ],
        ];

        $res = $this->postToAPI($params,  "https://api.sendgrid.com/v3/mail/send");

    }

    function checkState($id)
    {
        // TODO: Implement checkState() method.
    }

    function isAvailable()
    {
        return true;
        // TODO: Implement isAvailable() method.
    }


    private function postToAPI($params, $url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Accept-Encoding: gzip, deflate",
                "Authorization: Bearer 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",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Length: 296",
                "Content-Type: application/json",
                "Host: api.sendgrid.com",
                "Postman-Token: 3cf806fd-04c4-42d2-b058-c9785cc88d00,00edc7ce-4b97-4299-bdae-1a7cac18f0ad",
                "User-Agent: PostmanRuntime/7.15.2",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //save a log
            return false;
        } else {
            return $response;
        }
    }


}