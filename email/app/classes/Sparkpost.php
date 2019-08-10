<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 8/10/19
 * Time: 3:15 PM
 */

namespace App\classes;


class Sparkpost implements ExternalEmailInterface
{

    function send($subject, $contentValue, $contentType, $to, $from)
    {
        // TODO: Implement send() method.
        //convert receiver format
        $to2 =[];
        foreach ($to as $email){
            $to2[]['address'] = $email;
        }
        $params =array (
            'options' =>
                array (
                    'sandbox' => true,
                ),
            'content' =>
                array (
                    'from' => $from,
                    'subject' => $subject,
                    'text' => $contentValue,
                ),
            'recipients' => $to2,
        );

        $res = $this->sendToApi(json_encode($params));
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

    private function sendToApi(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sparkpost.com/api/v1/transmissions",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n    \"options\": {\n      \"sandbox\": true\n    },\n    \"content\": {\n      \"from\": \"sandbox@sparkpostbox.com\",\n      \"subject\": \"Thundercats are GO!!!\",\n      \"text\": \"Sword of Omens, give me sight BEYOND sight\"\n    },\n    \"recipients\": [{ \"address\": \"alirezaeyan.javad@gmail.com\" }]\n}",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Authorization: 89e2ebbc7b81a34962e7621d5e7e5a38949f7473",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Length: 281",
                "Content-Type: application/json",
                "Host: api.sparkpost.com",
                "Postman-Token: 6eca2123-dbcf-4435-b032-09f83b01eef2,8ca5643c-27bb-4abe-ba86-4a1388450f5b",
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
