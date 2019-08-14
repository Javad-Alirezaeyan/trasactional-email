<?php

namespace Tests\Feature;

use App\Email;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailApiTest extends TestCase
{


    public function testSendEmail()
    {
        for($i=0; $i<10; $i++){
            $email = factory(Email::class)->create();
            $payload = [
                'subject' => $email->email_subject ,
                'to' => $email->email_to,
                'from' => $email->email_from,
                'contentValue' => $email->email_contentValue,
            ];

            $this->json('POST', 'api/email', $payload)
                ->assertStatus(200)->assertJson([
                    'status' => 'OK',
                    'code' => 200,
                    'message' => 'Queued',
                    'errors' =>[]
                ]);
        }
    }

    public function testWrongMethod()
    {

        $payload = [
            'subject' => 'Hello',
            'to' => 'test@example.com',
            'from' => 'javad@example.com',
            'contentValue' => "Hello takeaway",
        ];

        $this->json('Get2', 'api/email', $payload)
            ->assertStatus(404)->assertJson(['data' => 'Resource not found']);
        $this->json('Post1', 'api/all')
            ->assertStatus(404)->assertJson(['data' => 'Resource not found']);
        $this->json('Get1', 'api/test')
            ->assertStatus(404)->assertJson(['data' => 'Resource not found']);

    }

    public function testAllEmail()
    {
        $email1 = factory(Email::class)->create();
        $email2 = factory(Email::class)->create();

         $this->json('get', 'api/email')
            ->assertJsonFragment([
                [
                    'id'=> $email1->email_id,
                    'subject' => $email1->email_subject,
                    'to' => $email1->email_to,
                    'from' => $email1->email_from,
                    "stateInfo"=>[
                        "Title" => 'Queued',
                        'ColorClass'=> 'label-warning'
                    ],
                    "state" =>$email2->email_state,
                    'content' => $email1->email_contenetValue,
                    'contentType' => $email1->email_contentType,
                    "date"=> $email1->created_at
                ],
                [
                    'id'=> $email2->email_id,
                    'subject' => $email2->email_subject,
                    'to' => $email2->email_to,
                    'from' => $email2->email_from,
                    "stateInfo"=>[
                        "Title" => 'Queued',
                        'ColorClass'=> 'label-warning'
                    ],
                    "state" =>$email2->email_state,
                    'content' => $email1->email_contenValue,
                    'contentType' => $email2->email_contentType,
                    "date"=> $email2->created_at
                ]
            ]);
    }


    /**
     *
     */
    public function testDetailMethod()
    {

        $email = factory(Email::class)->create();

        $this->json('Get', 'api/email/'.$email->email_id)
            ->assertStatus(200)->assertJsonFragment([
                'status' => 'OK',
                'code' => 200,
                'message' => '',
                'errors' =>[],
                'result' =>
                    [
                        'id' => $email->email_id,
                        'subject' => $email->email_subject,
                        'to' => $email->email_to,
                        'from' => $email->email_from,
                        'stateInfo' =>
                            array (
                                'Title' => 'Queued',
                                'ColorClass' => 'label-warning',
                            ),
                        'state' => 0,
                        'content' => $email->email_contentValue,
                        'contentType' => 'text/html',
                        'date' => $email->created_at,
                    ],
            ]);

    }

    public function testDeleteMethod()
    {
        $email = factory(Email::class)->create();

        $this->json('Delete', 'api/email/'.$email->email_id)
            ->assertStatus(200)->assertJson(array (
                'status' => 204,
                'code' => 200,
                'message' => '',
                'errors' =>
                    array (
                    ),
                'result' => '',
            ));
    }


}
