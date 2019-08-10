<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected  $sender ;
    public function __construct($req)
    {
        //
        $this->sender = $req;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sender = $this->sender;
        $objEmail = new \App\classes\EmailService();
        if($objEmail){
            list($res, $msg) = $objEmail->sendEmail($sender->email_subject, $sender->email_contentValue,
                explode(',', $sender->email_to) ,$sender->email_from, $sender->email_contentType);
        }
        else{
            //all services are unavailable

        }


    }
}
