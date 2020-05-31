<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    protected $fillable = [
        'project_id','file_name','file_path'
    ];

}
