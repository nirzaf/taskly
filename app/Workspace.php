<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    protected $fillable = [
        'name','slug','created_by','lang'
    ];

    public static function create($data)
    {
        $obj = new Utility();
        $table = with(new Workspace)->getTable();
        $data['slug'] = $obj->createSlug($table,$data['name']);
        return static::query()->create($data);
    }
    public function creater(){
        return $this->hasOne('App\User','id','created_by');
    }
    public function users($created_by = false){
        if($created_by) {
            return $this->belongsToMany('App\User', 'user_workspaces', 'workspace_id', 'user_id')->where('users.id', "!=", $created_by)->get();
        }
        else{
            return $this->belongsToMany('App\User', 'user_workspaces', 'workspace_id', 'user_id');
        }
    }
    public function clients(){
        return $this->belongsToMany('App\Client', 'client_workspaces', 'workspace_id', 'client_id');
    }

    public function projects(){
        return $this->hasMany('App\Project','workspace','id');
    }

    public function languages(){
        $dir    = base_path().'/resources/lang/'.$this->id."/";
        if(!is_dir($dir)) {
            $dir = base_path() . '/resources/lang/';
        }
        $glob =  glob($dir."*",GLOB_ONLYDIR);
        $arrLang =  array_map(function($value) use($dir) { return str_replace($dir, '', $value); }, $glob);
        $arrLang =  array_map(function($value) use($dir) { return preg_replace('/[0-9]+/', '', $value); }, $arrLang);
        $arrLang = array_filter($arrLang);
        return $arrLang;
    }
}
