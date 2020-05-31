<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $todos = Todo::select(['id','text','done'])->where('workspace','=',$currantWorkspace->id)->where('created_by','=',Auth::user()->id)->get()->toJson();
        return view('todos.index',compact('currantWorkspace','todos'));
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
           'text' => 'required',
       ]);
        $currantWorkspace = Utility::getWorkspaceBySlug($slug);
        $post = $request->all();
        $post['workspace'] = $currantWorkspace->id;
        $post['created_by'] = Auth::user()->id;
        $todos = Todo::create($post);
        return $todos->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $post = $request->all();
        $todos = Todo::find($post['id']);
        $todos->done = $post['done'];
        $todos->save();
        return $todos->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post = $request->all();
        $todoId = [];
        foreach ($post['archives'] as $todo){
            $todoId[]= $todo['id'];
        }
        return Todo::whereIn('id',$todoId)->delete();
    }
}
