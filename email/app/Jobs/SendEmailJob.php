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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected  $request ;
    public function __construct($req)
    {
        //
        $this->request = $req;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $request = $this->request;
        $objEmail = new \App\classes\EmailService();
        list($res, $msg) = $objEmail->sendEmail($request->email_subject, $request->email_contentValue,
        json_decode($request->email_to),$request->email_from, $request->email_contentType);

    }
}
