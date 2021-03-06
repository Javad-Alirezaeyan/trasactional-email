<?php

namespace App\Http\Controllers;


use App\classes\EmailService;
use App\Http\Controllers\API\ResponseObject;
use App\Http\Requests\SendEmailValidator;
use App\Jobs\SendEmailJob;
use App\Library\Parsemarkdown;
use Illuminate\Support\Facades\Artisan;
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
    public function index(Request $request)
    {
        $response = new ResponseObject();
        $state = $request->input('state', -1);
        $delete = $request->input('deleted', 0);
        $page = $request->input('page', 1);
        $count = $request->input('count', DefaultRowCount);


        $validator = Validator::make($request->all(), [
            'page' => 'integer',
            'deleted' => 'integer',
            'state' => 'integer|min:-1|max:5',
            'count' => 'integer',
        ]);
        //validation input
        if($validator->fails()){
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            foreach ($validator->errors()->getMessages() as $item) {
                array_push($response->errors, $item);
            }
            return Response::json($response);
        }

        //find offset based on page and count
        $offset = ($page-1) * $count;

        $where['email_deleted'] =$delete;
        if($state != -1){
            $where['email_state'] = $state;
        }

        $response->status = $response::status_ok;
        $response->code = $response::code_ok;
       // $response->result = Email::all()
        $response->result = [
            'page' => $page,
            'count' => $count,
            'all' => Email::countAll($where),
            'emails' =>new EmailCollection(Email::selectData($where, $offset, $count))
        ];
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
        if (Email::where('email_id', '=', $id)->exists()) {
            // email found
            $response->status = $response::status_ok;
            $response->code = $response::code_ok;
            $response->result =  new EmailResource(Email::find($id));
        }
        else{
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
        }
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

        //Artisan::call('queue:work');
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

           /* $state = EmailNotSent;
            $indexEmailService = 0;
            $res = false;
            do{
                $objEmail = new \App\classes\EmailService($indexEmailService);
                $srvAvailable = $objEmail->serviceIsAvailable();
                if($srvAvailable){
                    list($res, $msg) = $objEmail->sendEmail($obj->email_subject, $obj->email_contentValue,
                        explode(',', $obj->email_to) ,$obj->email_from, $obj->email_contentType);
                    if($res){
                        $state = EmailSent;
                    }
                }
                $indexEmailService++;
            }while($srvAvailable && !$res);*/

            $response->status = $response::status_ok;
            $response->code = $response::code_ok;
            $response->message = "Queued";
        }
        return Response::json($response);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * this function deletes one or more emails, idList can be a list of id
     */
    public function bulkdelete(Request $request)
    {
        $response = new ResponseObject();
        $bulkIdList = $request->input('idList', []);

        if(is_array($bulkIdList)){
            // soft delete
            Email::updateBulk($bulkIdList, ['email_deleted'=> 1]);
            $response->status = 204;
            $response->code = $response::code_ok;
        }
        else{
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            $response->message = "'Id' is not valid";
        }

        return Response::json($response);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * this function deletes one  email,
     */
    public function delete($id)
    {
        $response = new ResponseObject();

        if(is_numeric($id)){
            // soft delete
            Email::updateData($id, ['email_deleted'=> 1]);
            $response->status = 204;
            $response->code = $response::code_ok;
        }
        else{
            $response->status = $response::status_failed;
            $response->code = $response::code_failed;
            $response->message = "'Id' is not valid";
        }

        return Response::json($response);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * this method shows all emails in a table
     *
     */
    public function showall(Request $request){

        return view("/email/emailframe");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * this function shows a form to send an email
     */
 /*   public function compose(){

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
    }*/


}
