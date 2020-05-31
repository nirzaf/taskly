<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'text','done','workspace','color','created_by'
    ];
    public function user(){
        return $this->hasOne('App\User','id','created_by');
    }
}
