<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    protected $fillable = [
        'name','due_date','task_id','user_type','created_by','status'
    ];
    public function user(){
        return $this->hasOne('App\User','id','created_by');
    }
    public function client(){
        return $this->hasOne('App\Client','id','created_by');
    }

}
