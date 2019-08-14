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

            $this->json('POST', 'api/sendEmail', $payload)
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

        $this->json('Get', 'api/sendEmail', $payload)
            ->assertStatus(404)->assertJson(['data' => 'Resource not found']);
        $this->json('Post', 'api/all')
            ->assertStatus(404)->assertJson(['data' => 'Resource not found']);
        $this->json('Get', 'api/test')
            ->assertStatus(404)->assertJson(['data' => 'Resource not found']);

    }

    public function testAllEmail()
    {
        $email1 = factory(Email::class)->create([
            'email_subject' => 'Test 1',
            'email_to' => 'reza@test.com, ali@example.com',
            'email_from' => 'javad@example.com',
            'email_contentValue' => "Hello world <b> test 1</b>",
        ]);

        $email2 = factory(Email::class)->create([
            'email_subject' => 'Test 2',
            'email_to' => 'rezaaaaaaa@test.com, aaaaaaaaaali@example.com',
            'email_from' => 'javaddddddd@example.com',
            'email_contentValue' => "Hello world <b> test 2</b>",
        ]);

         $this->json('get', 'api/all')
            ->assertJsonFragment([
                [
                    'id'=> $email1->email_id,
                    'subject' => 'Test 1',
                    'to' => 'reza@test.com, ali@example.com',
                    'from' => 'javad@example.com',
                    "state" =>$email1->email_state,
                    'content' => "Hello world <b> test 1</b>",
                    'contentType' => $email1->email_contentType,
                   // "date"=> $email1.created_at
                ],
                [
                    'id'=> $email2->email_id,
                    'subject' => 'Test 2',
                    'to' => 'rezaaaaaaa@test.com, aaaaaaaaaali@example.com',
                    'from' => 'javaddddddd@example.com',
                    "state" =>$email2->email_state,
                    'content' => "Hello world <b> test 2</b>",
                    'contentType' => $email2->email_contentType,
                    //"date"=> $email2.created_at
                ]
            ]);
    }




}
