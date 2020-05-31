<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWorkspace extends Model
{
    protected $fillable = [
        'user_id','workspace_id','permission'
    ];
}
