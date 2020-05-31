<?php

namespace App\Http\Controllers;

use App\Note;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $notes = Note::select(['id','title','text','color'])->where('workspace','=',$currantWorkspace->id)->where('created_by','=',Auth::user()->id)->get();
        return view('notes.index',compact('currantWorkspace','notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        return view('notes.create',compact('currantWorkspace'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug,Request $request)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            'color' => 'required',
        ]);
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $objUser = Auth::user();
        $post = $request->all();
        $post['workspace'] = $currantWorkspace->id;
        $post['created_by'] = $objUser->id;
        Note::create($post);
        return redirect()->route('notes.index',$currantWorkspace->slug)
            ->with('success','Note   created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit($slug,$noteID)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $notes = Note::where('workspace','=',$currantWorkspace->id)->where('created_by','=',Auth::user()->id)->where('id','=',$noteID)->first();
        return view('notes.edit',compact('currantWorkspace','notes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug,$noteID)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            'color' => 'required',
        ]);
        $objUser = Auth::user();
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $notes = Note::where('workspace','=',$currantWorkspace->id)->where('created_by','=',Auth::user()->id)->where('id','=',$noteID)->first();
        $notes->update($request->all());
        return redirect()->route('notes.index',$slug)
            ->with('success',__('Note Updated Successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug,$noteID)
    {
        $objUser = Auth::user();
        $note = Note::find($noteID);
        if($note->created_by == $objUser->id) {
            $note->delete();
            return redirect()->route('notes.index',$slug)->with('success',__('Note Deleted Successfully!'));
        }
        else{
            return redirect()->route('notes.index',$slug)->with('error',__('You can\'t delete Note!'));
        }
    }
}
