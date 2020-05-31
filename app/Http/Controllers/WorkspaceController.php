<?php

namespace App\Http\Controllers;


use App\Utility;
use Auth;
use App\UserProject;
use App\Project;
use App\UserWorkspace;
use App\Workspace;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class WorkspaceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $objUser = Auth::user();
        $objWorkspace = Workspace::create(['created_by'=>$objUser->id,'name'=>$request->name]);

        UserWorkspace::create(['user_id'=>$objUser->id,'workspace_id'=>$objWorkspace->id,'permission'=>'Owner']);

        $objUser->currant_workspace = $objWorkspace->id;
        $objUser->update();

        return redirect()->route('home',$objWorkspace->slug)->with('success',__('Workspace Created Successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int  $workspaceID
     * @return \Illuminate\Http\Response
     */
    public function destroy($workspaceID)
    {
        $objUser = Auth::user();
        $workspace = Workspace::find($workspaceID);
        if($workspace->created_by == $objUser->id) {
            UserWorkspace::where('workspace_id', '=', $workspaceID)->delete();
            $workspace->delete();
            return redirect()->route('home')->with('success',__('Workspace Deleted Successfully!'));
        }
        else{
            return redirect()->route('home')->with('error',__('You can\'t delete Workspace!'));
        }
    }

    /**
     * Leave the specified resource from storage.
     *
     * @param  Int  $workspaceID
     * @return \Illuminate\Http\Response
     */
    public function leave($workspaceID)
    {
        $objUser = Auth::user();

        $userProjects = Project::where('workspace', '=', $workspaceID)->get();
        foreach ($userProjects as $userProject){
            UserProject::where('project_id','=',$userProject->id)->where('user_id', '=', $objUser->id)->delete();
        }
        UserWorkspace::where('workspace_id', '=', $workspaceID)->where('user_id', '=', $objUser->id)->delete();
        return redirect()->route('home')->with('success',__('Workspace Leave Successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int  $workspaceID
     * @return \Illuminate\Http\Response
     */
    public function changeCurrantWorkspace($workspaceID)
    {
        $objUser = Auth::user();
        $objUser->currant_workspace = $workspaceID;
        $objUser->update();
        $objWorkspace = Workspace::find($workspaceID);
        return redirect()->route('home',$objWorkspace->slug)->with('success',__('Workspace Change Successfully!'));
    }

    public function changeLangWorkspace($workspaceID,$lang)
    {
        $workspace = Workspace::find($workspaceID);
        $workspace->lang = $lang;
        $workspace->save();
        return redirect()->route('home',$workspace->slug)->with('success',__('Workspace Language Change Successfully!'));
    }

    public function langWorkspace($slug,$currantLang){

        $currantWorkspace = Utility::getWorkspaceBySlug($slug);

        $dir    = base_path().'/resources/lang/'.$currantWorkspace->id."/".$currantLang;
        if(!is_dir($dir)) {
			$dir = base_path() . '/resources/lang/'.$currantLang;
			if(!is_dir($dir)) {
            	$dir = base_path() . '/resources/lang/en';
			}
        }
        $arrLabel = json_decode(file_get_contents($dir.'.json'));

        $arrFiles = array_diff(scandir($dir), array('..', '.'));
        $arrMessage = [];
        foreach ($arrFiles as $file){
            $fileName =  basename($file,".php");
            $fileData = $myArray = include $dir."/".$file;
            if(is_array($fileData))
                $arrMessage[$fileName] = $fileData ;
        }
        return view('lang.index',compact('currantWorkspace','currantLang','arrLabel','arrMessage'));
    }

    public function storeLangDataWorkspace($slug,$currantLang,Request $request){
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
		$Filesystem = new Filesystem();
        $dir = base_path().'/resources/lang/'.$currantWorkspace->id;
        if(!is_dir($dir)) {
            mkdir($dir);
            chmod($dir,0777);
        }
        $jsonFile = $dir."/".$currantLang.".json";

        file_put_contents($jsonFile,json_encode($request->label));

        $langFolder = $dir."/".$currantLang;
        if(!is_dir($langFolder)) {
            mkdir($langFolder);
            chmod($langFolder,0777);

			$dirN = base_path().'/resources/lang/';
			$arrFiles = ['da','de','en','es','fr','it','nl'];
		 	foreach ($arrFiles as $file){
				echo $dirN.$file."  -- ".$dirN.$currantWorkspace->id."/".$file."<br>";

				if(is_dir($dirN."/".$file)){
					$Filesystem->copyDirectory($dirN.$file,$dirN.$currantWorkspace->id."/".$file);
					\File::copy($dirN.$file.".json",$dirN.$currantWorkspace->id."/".$file.".json");
				}
			}

        }

        foreach ($request->message as $fileName => $fileData){
            $content = "<?php return [";
            $content .= $this->buildArray($fileData);
            $content .= "];";
            file_put_contents($langFolder."/".$fileName.'.php',$content);
        }

        return redirect()->route('lang_workspace',[$currantWorkspace->slug,$currantLang])->with('success',__('Language Save Successfully!'));
    }
    public function buildArray($fileData)
    {
        $content = "";
        foreach ($fileData as $lable => $data)
        {
            if(is_array($data)){
                $content .= "'$lable'=>[".$this->buildArray($data)."],";
            }
            else{
                $content .= "'$lable'=>'".addslashes($data)."',";
            }
        }
        return $content;
    }
    public function createLangWorkspace($slug){
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        return view('lang.create',compact('currantWorkspace'));
    }
    public function storeLangWorkspace($slug,Request $request){
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $Filesystem = new Filesystem();
        $langCode = strtolower($request->code);

        $langDir = base_path().'/resources/lang/';
        $dir    = $langDir.$currantWorkspace->id;
        if(!is_dir($dir)) {
            mkdir($dir);
            chmod($dir,0777);

			$dirN = base_path().'/resources/lang/';
			$arrFiles = ['da','de','en','es','fr','it','nl'];
		 	foreach ($arrFiles as $file){
				if(is_dir($dirN."/".$file)){
					$Filesystem->copyDirectory($dirN.$file,$dirN.$currantWorkspace->id."/".$file);
					\File::copy($dirN.$file.".json",$dirN.$currantWorkspace->id."/".$file.".json");
				}
			}
        }

        if(!file_exists($dir.'/en.json')){
            \File::copy($langDir.'en.json',$dir.'/en.json');
            if(!is_dir($dir."/en")) {
                mkdir($dir."/en");
                chmod($dir."/en",0777);
            }
            $Filesystem->copyDirectory($langDir."en", $dir."/en/");
        }

        $dir    = $dir.'/'.$langCode;
        $jsonFile = $dir.".json";
        \File::copy($langDir.'en.json',$jsonFile);

        if(!is_dir($dir)) {
            mkdir($dir);
            chmod($dir,0777);
        }

        $Filesystem->copyDirectory($langDir."en", $dir."/");

        return redirect()->route('lang_workspace',[$currantWorkspace->slug,$langCode])->with('success',__('Language Created Successfully!'));
    }
}
