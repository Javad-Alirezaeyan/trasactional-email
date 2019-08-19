<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Email extends Model
{
    //
    protected $primaryKey = 'email_id';
    protected $fillable = ['email_subject', 'email_contentValue',  'email_contentType', 'email_to', 'email_from',  'email_state', 'email_service', 'created_at'];
    protected $hidden = [  'email_service', 'updated_at', 'deleted_at', 'email_deleted'];

    public function getTagNameAttribute()
    {
        return $this->attributes['name'];
    }



    public static function selectData($where=[], $offset = 0, $count = DefaultRowCount){
       return  DB::table('emails')
            ->where($where)->offset($offset)->limit($count)->orderBy('created_at', 'desc')
            ->get();
    }

    public static function countAll($where=[]){
         return DB::table('emails')
            ->where($where)->count();
    }

    public static function updateData($id,$data){
        DB::table('emails')
            ->where('email_id', $id)
            ->update($data);
    }

    public static function updateBulk($idList,$data){
        DB::table('emails')
            ->whereIn('email_id', $idList)
            ->update($data);
    }


    public static function deleteData($id){
        DB::table('emails')->where('email_id', '=', $id)->delete();
    }
}
