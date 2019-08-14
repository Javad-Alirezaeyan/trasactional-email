<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/7/19
 * Time: 10:51 AM
 */

namespace App\classes;



class Mailjet implements ExternalEmailInterface
{
    public $apiKey = "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";
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

        $params = array (
            'Messages' =>
                [
                    0 =>
                        [
                            'From' =>
                                [
                                    'Email' => $from,
                                ],
                            'To' =>$to,
                            'Subject' => $subject,
                            'TextPart' => '',
                            'HTMLPart' => $contentValue
                        ],
                ],
        );
        $res = $this->sendToAPi(json_encode($params));
        if($res === false){
            // there was an error on API
            return [false, 'There was an error on API'];
        }
        else{
            return [true, 'sent'];
        }
    }

    function checkState($id)
    {
        // TODO: Implement checkState() method.
    }

    function isAvailable()
    {
        // TODO: Implement isAvailable() method.
        return true;
    }

    private function sendToAPi($params){

        $length = strlen($params);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.mailjet.com/v3.1/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json,*/*",
                "Accept-Encoding: gzip, deflate",
                "Authorization: test,Basic ".$this->apiKey,
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Length: $length",
                "Content-Type: application/json",
                "Host: api.mailjet.com"
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