<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientProject extends Model
{
    protected $fillable = [
        'client_id','project_id'
    ];
}
