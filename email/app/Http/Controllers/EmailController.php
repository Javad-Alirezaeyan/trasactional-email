<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Email;

class EmailController extends Controller
{

    protected $layout = 'layouts.master';

    /**
     * @return Email[]|\Illuminate\Database\Eloquent\Collection
     * this function returns all email records
     */
    public function index()
    {
        return Email::all();
    }

    /**
     * @param $id  id of the email record
     * this method finds a email and returns related data
     * @return mixed
     */
    public function show($id)
    {
        return Email::find($id);
    }


    /**
     * @param Request $request
     * this function receive the information for email and send an Email to receivers
     * There some external email services that we select one of them  sending email, if first service isn't available,
     * it'll select another service;
     * @return mixed
     */
    public function send(Request $request)
    {
        // save record to db
        $obj = new Email();
        $obj->email_subject =  $request->subject;
        $obj->email_to =  $request->to;
        $obj->email_from =  $request->from;
        $obj->email_contentType =  $request->contentType;
        $obj->email_contentValue =  $request->contentValue;
        $obj->email_state =  0;
        $obj->save();
        //send Email

        $objEmail = new \App\classes\EmailService();
        if($objEmail){
            // create an email job and assign to dispatch
             // SendEmailJob::dispatch($obj)->delay(now()->addSecond(2));

            list($res, $msg) = $objEmail->sendEmail($obj->email_subject, $obj->email_contentValue,
                json_decode($obj->email_to),$obj->email_from, $obj->email_contentType);
            if($res){
                return response()->json(['msg' => 'sent'], 200);
            }
            else{
                return response()->json(['msg' => 'fail'], 300);
            }

        }
        else{
            //all services are unavailable
            return response()->json(['msg' => 'all services are unavailable'], 300);
        }
       // return Email::create($request->all());
    }

    public function delete(Request $request, $id)
    {
        $email = Email::findOrFail($id);
        $email->delete();
        return 204;
    }


    public function showall(){

        return view("/email/table");
    }

    public function compose(){

        return view("/email/compose");
    }
}
