<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id' => $this->email_id,
            'subject'=> $this->email_subject,
            'to' =>$this->to,
            'from'=> $this->from,
            'state' => $this->state,
            'content'=> $this->contentValue,
            'contentType'=> $this->contentType
        ];
        //return parent::toArray($request);
    }
}
