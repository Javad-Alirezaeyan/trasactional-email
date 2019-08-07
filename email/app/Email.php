<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    //
    protected $fillable = ['email_title', 'email_body', 'email_receiver', 'email_state', 'email_service'];
}
