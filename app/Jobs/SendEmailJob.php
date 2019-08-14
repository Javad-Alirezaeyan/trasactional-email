<?php

namespace App\Jobs;

use App\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Queue\Queue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 1;

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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::failing(function (JobFailed $event) {
            // $event->connectionName
            // $event->job
            // $event->exception
        });
        Queue::before(function (JobProcessing $event) {
            // $event->connectionName
            // $event->job
            // $event->job->payload()
        });

        Queue::after(function (JobProcessed $event) {
            // $event->connectionName
            // $event->job
            // $event->job->payload()
        });
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
        $state = EmailNotSent;
        if($objEmail){
            list($res, $msg) = $objEmail->sendEmail($sender->email_subject, $sender->email_contentValue,
                explode(',', $sender->email_to) ,$sender->email_from, $sender->email_contentType);
            if($res){
                $state = EmailSent;
            }
        }
        else{
            //all services are unavailable
        }

        $email = Email::find($sender->email_id);
        $email->email_state = $state;
        $email->save();


    }


}
