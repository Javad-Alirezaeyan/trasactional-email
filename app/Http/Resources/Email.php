<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use League\Flysystem\Config;

class Email extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $state = Config('constants.EmailState');

        return [
            'id' => $this->email_id,
            'subject'=> $this->email_subject,
            'to' =>$this->email_to,
            'from'=> $this->email_from,
            'stateInfo' => $state[$this->email_state],
            'state' => $this->email_state,
            'content'=> $this->email_contentValue,
            'contentType'=> $this->email_contentType,
            'date'=> $this->created_at
        ];
        //return parent::toArray($request);
    }
}
