<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','currant_workspace','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function workspace(){
        return $this->belongsToMany('App\Workspace','user_workspaces', 'user_id', 'workspace_id')->withPivot('permission');
    }
    public function currantWorkspace(){
        return $this->hasOne('App\Workspace','id','currant_workspace');
    }
    public function countProject($workspace_id){
        return UserProject::join('projects','projects.id','=','user_projects.project_id')->where('user_projects.user_id','=',$this->id)->where('projects.workspace','=',$workspace_id)->count();
    }
    public function countTask($workspace_id){
        return Task::join('projects','tasks.project_id','=','projects.id')->where('projects.workspace','=',$workspace_id)->where('tasks.assign_to','=',$this->id)->count();
    }

}