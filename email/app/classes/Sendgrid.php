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

    function send($subject, $contentValue, $contentType, $to, $from)
    {
        // TODO: Implement send() method.

        //convert receiver format
        $to2 =[];
        foreach ($to as $email){
            $to2[]['email'] = $email;
        }
            $params =array (
                'personalizations' =>
                    array (
                        0 =>
                            array (
                                'to' => $to2,
                            ),
                    ),
                'from' =>
                    array (
                        'email' => $from,
                    ),
                'subject' => $subject,
                'content' =>
                    array (
                        0 =>
                            array (
                                'type' => $contentType,
                                'value' => $contentValue,
                            ),
                    ),
            );

        $res = $this->postToAPI(json_encode($params),  "https://api.sendgrid.com/v3/mail/send");
        if($res === false){
            // there was an error on API
            return [false, 'There was an error on API'];
        }
        else{
            return [true, 'sent'];
        }
    }

    private function postToAPI($params, $url)
    {
        $curl = curl_init();
        $count = strlen($params);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
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
                "Content-Length: $count",
                "Content-Type: application/json"
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

    function checkState($id)
    {
        // TODO: Implement checkState() method.
    }

    function isAvailable()
    {
        return true;
        // TODO: Implement isAvailable() method.
    }


}