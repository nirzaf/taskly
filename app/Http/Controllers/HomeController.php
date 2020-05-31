<?php

namespace App\Http\Controllers;

use App\ClientWorkspace;
use App\User;
use App\Utility;
use App\UserProject;
use App\Task;
use App\Todo;
use App\UserWorkspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($slug = '')
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        if($currantWorkspace) {
            $userObj = Auth::user();
            $totalProject = UserProject::join("projects","projects.id","=","user_projects.project_id")->where("user_id","=",$userObj->id)->where('projects.workspace','=',$currantWorkspace->id)->count();
            $totalClients = ClientWorkspace::where("workspace_id","=",$currantWorkspace->id)->count();
            if($currantWorkspace->permission == 'Owner') {
                $totalTask = UserProject::join("tasks", "tasks.project_id", "=", "user_projects.project_id")->join("projects", "projects.id", "=", "user_projects.project_id")->where("user_id", "=", $userObj->id)->where('projects.workspace', '=', $currantWorkspace->id)->count();
                $completeTask = UserProject::join("tasks", "tasks.project_id", "=", "user_projects.project_id")->join("projects", "projects.id", "=", "user_projects.project_id")->where("user_id", "=", $userObj->id)->where('projects.workspace', '=', $currantWorkspace->id)->where('tasks.status', '=', 'done')->count();
                $tasks = Task::select('tasks.*')->join("user_projects", "tasks.project_id", "=", "user_projects.project_id")->join("projects", "projects.id", "=", "user_projects.project_id")->where("user_id", "=", $userObj->id)->where('projects.workspace', '=', $currantWorkspace->id)->orderBy('tasks.id','desc')->limit(4)->get();
            }
            else{
                $totalTask = UserProject::join("tasks", "tasks.project_id", "=", "user_projects.project_id")->join("projects", "projects.id", "=", "user_projects.project_id")->where("user_id", "=", $userObj->id)->where('projects.workspace', '=', $currantWorkspace->id)->where('tasks.assign_to', '=', $userObj->id)->count();
                $completeTask = UserProject::join("tasks", "tasks.project_id", "=", "user_projects.project_id")->join("projects", "projects.id", "=", "user_projects.project_id")->where("user_id", "=", $userObj->id)->where('projects.workspace', '=', $currantWorkspace->id)->where('tasks.assign_to', '=', $userObj->id)->where('tasks.status', '=', 'done')->count();
                $tasks = Task::select('tasks.*')->join("user_projects", "tasks.project_id", "=", "user_projects.project_id")->join("projects", "projects.id", "=", "user_projects.project_id")->where("user_id", "=", $userObj->id)->where('projects.workspace', '=', $currantWorkspace->id)->where('tasks.assign_to', '=', $userObj->id)->orderBy('tasks.id','desc')->limit(4)->get();
            }


            $totalMembers = UserWorkspace::where('workspace_id','=',$currantWorkspace->id)->count();

            $projectProcess = UserProject::join("projects","projects.id","=","user_projects.project_id")->where("user_id","=",$userObj->id)->where('projects.workspace','=',$currantWorkspace->id)->groupBy('projects.status')->selectRaw('count(projects.id) as count, projects.status')->pluck('count','projects.status');
            $arrProcessLable= [];
            $arrProcessPer=[];
            $arrProcessLable = [];
            foreach ($projectProcess as $lable => $process){
                $arrProcessLable[]=$lable;
                $arrProcessPer[] = round(($process*100)/$totalProject,2);
            }
            $arrProcessClass = ['text-success','text-primary','text-danger'];

            $todos = Todo::where("created_by", "=", $userObj->id)->where('workspace','=',$currantWorkspace->id)->orderBy('id','desc')->limit(5)->get();


            $startDate = date('Y-m-d 00:00:00');
            $endDate = date('Y-m-d H:i:s',strtotime($startDate."+1 day"));


            $chartData = app('App\Http\Controllers\ProjectController')->getProjectChart(['workspace_id'=>$currantWorkspace->id,'duration'=>'week']);

            return view('home', compact('currantWorkspace','totalProject','totalClients','totalTask','totalMembers','arrProcessLable','arrProcessPer','arrProcessClass','completeTask','tasks','todos','chartData'));
        }
        else{
            return view('home', compact('currantWorkspace'));
        }
    }
}
