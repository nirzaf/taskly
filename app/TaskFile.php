<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskFile extends Model
{
    protected $fillable = [
        'file','name','extension','file_size','created_by','task_id','user_type'
    ];
    public function user(){
        return $this->hasOne('App\User','id','created_by');
    }
    public function client(){
        return $this->hasOne('App\Client','id','created_by');
    }
}
