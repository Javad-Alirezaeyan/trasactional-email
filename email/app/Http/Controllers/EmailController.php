<?php

namespace App\Http\Controllers;


use App\Http\Controllers\API\ResponseObject;
use App\Http\Requests\SendEmailValidator;
use App\Jobs\SendEmailJob;
use App\Library\Parsemarkdown;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Email;
use App\Http\Resources\Email as EmailResource;
use App\Http\Resources\EmailCollection ;


class EmailController extends Controller
{

    protected $layout = 'layouts.master';

    /**
     * @return Email[]|\Illuminate\Database\Eloquent\Collection
     * this function returns all email records
     */
    public function index()
    {
        $response = new ResponseObject();

        $response->status = $response::status_ok;
        $response->code = $response::code_ok;
       // $response->result = Email::all();
        $response->result = new EmailCollection(Email::selectData(['email_deleted'=> 0]));
        return Response::json($response);
    }

    /**
     * @param $id  id of the email record
     * this method finds an email and returns related data
     * @return mixed
     */
    public function show($id)
    {
        $response = new ResponseObject();
        $response->status = $response::status_ok;
        $response->code = $response::code_ok;
        $response->result =  new EmailResource(Email::find($id));
        return Response::json($response);
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
        $response = new ResponseObject();

        $validator = Validator::make($request->all(), [
            'to' => 'required|min:6',
            'subject' => 'required',
            'from' => 'required|email',
            'contentValue' => 'required',
        ]);
        //validation input
        if($validator->fails()){
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->errors, $item);
            }
        }
        else{
            // parse content, for example: MARKDOWN converts to HTML
            $objParse  = new Parsemarkdown();
            $content =  $objParse->text($request->contentValue);
            // save record to db
            $obj = new Email();
            $obj->email_subject =  $request->subject;
            $obj->email_to =  $request->to;
            $obj->email_from =  $request->from;
            $obj->email_contentType =  $request->input('contentType', 'text/html');
            $obj->email_contentValue =  $content;
            $obj->email_orginalContent =  $request->contentValue;
            $obj->email_state = EmailQueued;
            $obj->save();

            // create an email job and assign to dispatch
            SendEmailJob::dispatch($obj)->delay(now()->addSecond(5));// the job will be access to process after 5 seconds
            $response->status = $response::status_ok;
            $response->code = $response::code_ok;
            $response->message = "Queued";
        }
        return Response::json($response);
    }

    public function delete(Request $request, $id)
    {
        $bulkIdList = $request->input('idList', "[$id]");
//        var_dump($bulkIdList); exit;
        if(is_array($bulkIdList)){
            Email::updateBulk($bulkIdList, ['email_deleted'=> 1]);
        }
        $response = new ResponseObject();
        $response->status = 204;
        $response->code = $response::code_ok;
        $response->message = "Queued";
        return Response::json($response);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * this method shows all emails in a table
     *
     */
    public function showall(){

        return view("/email/emailframe",
            [
                'partialview'=> 'table',
                'params'=> []
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * this function shows a form to send an email
     */
    public function compose(){

        return view("/email/emailframe",
            [
                'partialview'=> 'compose',
                'params'=> []
            ]
        );
    }

    public function detail(Request $request, $id){
        return view("/email/emailframe",
            [
                'partialview'=> 'detail',
                'params'=> ['id'=>$id]
            ]
        );
    }


}
