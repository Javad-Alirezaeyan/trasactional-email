<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    //
    protected $primaryKey = 'email_id';
    protected $fillable = ['email_subject', 'email_contentValue', 'email_contentType', 'email_to', 'email_from',  'email_state', 'email_service'];
    protected $hidden = [  'email_service', 'updated_at', 'deleted_at'];

    public function getTagNameAttribute()
    {
        return $this->attributes['name'];
    }
}
