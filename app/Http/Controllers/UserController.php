<?php

namespace App\Http\Controllers;

use App\Mail\SendLoginDetail;
use App\User;
use App\UserProject;
use App\UserWorkspace;
use App\Utility;
use App\Mail\SendWorkspaceInvication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Config;

class UserController extends Controller
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
    public function index($slug)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $users = User::select('users.*','user_workspaces.permission')->join('user_workspaces','user_workspaces.user_id','=','users.id')->where('user_workspaces.workspace_id','=',$currantWorkspace->id)->get();
        return view('users.index',compact('currantWorkspace','users'));
    }

    public function account()
    {
        $user = Auth::user();
        $currantWorkspace = Utility::getWorkspaceBySlug('');
        return view('users.account',compact('currantWorkspace','user'));
    }
    public function deleteAvatar(){
        $objUser = Auth::user();
        $objUser->avatar = '';
        $objUser->save();
        return redirect()->route('users.my.account')
            ->with('success','Avatar deleted successfully');
    }

    public function update($slug = null,$id = null,Request $request)
    {
        if($id){
            $objUser = User::find($id);
        }else{
            $objUser = Auth::user();
        }

        $validation = [];
        $validation['name']='required';
        if($request->avatar){
            $validation['avatar']='required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $request->validate($validation);

        $post = $request->all();
        if($request->avatar){
            $avatarName = $objUser->id.'_avatar'.time().'.'.$request->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatars',$avatarName);
            $post['avatar'] = $avatarName;
        }

        $objUser->update($post);

        return redirect()->back()
            ->with('success',__('User Updated Successfully!'));
    }

    public function updatePassword(Request $request)
    {
        if(Auth::Check()) {
            $request->validate([
                'old_password' => 'required',
                'password' => 'required|same:password',
                'password_confirmation' => 'required|same:password',
            ]);
            $objUser = Auth::user();
            $request_data = $request->All();
            $current_password = $objUser->password;

            if(Hash::check($request_data['old_password'], $current_password))
            {
                $user_id = Auth::User()->id;
                $obj_user = User::find($user_id);
                $obj_user->password = Hash::make($request_data['password']);;
                $obj_user->save();
                return redirect()->route('users.my.account')
                    ->with('success', __('Password Updated Successfully!'));
            }else{
                return redirect()->route('users.my.account')
                    ->with('error', __('Please Enter Correct Current Password!'));
            }
        }
        else{
            return redirect()->route('users.my.account')
                ->with('error', __('Some Thing Is Wrong!'));
        }
    }


    public function getUserJson()
    {
        $return = [];
        $objdata = User::select('email')->where('id', '!=', auth()->id())->get();
        foreach ($objdata as $data){
            $return[] = $data->email;
        }
        return response()->json($return);
    }
    public function getProjectUserJson($projectID)
    {
        return User::select('users.*')->join('user_projects','user_projects.user_id','=','users.id')->where('project_id','=',$projectID)->where('users.id', '!=', auth()->id())->get()->toJSON();
    }

    public function invite($slug)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        return view('users.invite',compact('currantWorkspace'));
    }
    public function inviteUser($slug,Request $request)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $post = $request->all();
        $userList = explode(',',$post['users_list']);
        $userList = array_filter($userList);
        foreach ($userList as $email){
            $registerUsers =  User::where('email',$email)->first();
            if(!$registerUsers){
                $arrUser = [];
                $arrUser['name'] = __('No Name');
                $arrUser['email'] = $email;
                $password = Str::random(8);
                $arrUser['password'] = Hash::make($password);
                $arrUser['currant_workspace'] = $currantWorkspace->id;
                $registerUsers = User::create($arrUser);
                $registerUsers->password = $password;

                try {
                    Mail::to($email)->send(new SendLoginDetail($registerUsers));
                }catch (\Exception $e){
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

            }
            // assign workspace first
            $is_assigned = false;
            foreach ($registerUsers->workspace as $workspace){
                if($workspace->id == $currantWorkspace->id){
                    $is_assigned = true;
                }
            }

            if(!$is_assigned){
                UserWorkspace::create(['user_id'=>$registerUsers->id,'workspace_id'=>$currantWorkspace->id,'permission'=>'Member']);

                try {
                    Mail::to($registerUsers->email)->send(new SendWorkspaceInvication($registerUsers, $currantWorkspace));
                }catch (\Exception $e){
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

            }
        }
        return redirect()->route('users.index',$currantWorkspace->slug)
            ->with('success', __('Users Invited Successfully!').((isset($smtp_error))?' <br> <span class="text-danger">'.$smtp_error.'</span>':''));
    }
    public function edit($slug,$id)
    {
        $user = User::find($id);
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        return view('users.edit',compact('currantWorkspace','user'));
    }
    public function removeUser($slug,$id){
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $userWorkspace = UserWorkspace::where('user_id','=',$id)->where('workspace_id','=',$currantWorkspace->id)->first();
        if($userWorkspace) {
            foreach ($currantWorkspace->projects as $project){
                $userProject = UserProject::where('user_id','=',$id)->where('project_id','=',$project->id)->first();
                if($userProject) {
                    $userProject->delete();
                }
            }
            $userWorkspace->delete();
            return redirect()->route('users.index',$currantWorkspace->slug)->with('success',  __('User Removed Successfully!'));
        }else{
            return redirect()->back()->with('error',__('Something is wrong.'));
        }
    }

}
