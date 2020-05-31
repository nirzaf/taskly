<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

// Calender

Route::get('/{slug}/calender',['as' => 'calender.index','uses' =>'CalenderController@index'])->middleware(['auth','XSS']);

//Client

Route::get('/{slug}/clients',['as' => 'clients.index','uses' =>'ClientController@index'])->middleware(['auth','XSS']);
Route::post('/{slug}/clients',['as' => 'clients.store','uses' =>'ClientController@store'])->middleware(['auth','XSS']);
Route::get('/{slug}/clients/create',['as' => 'clients.create','uses' =>'ClientController@create'])->middleware(['auth','XSS']);
Route::get('/{slug}/clients/edit/{id}',['as' => 'clients.edit','uses' =>'ClientController@edit'])->middleware(['auth','XSS']);
Route::put('/{slug}/clients/{id}',['as' => 'clients.update','uses' =>'ClientController@update'])->middleware(['auth','XSS']);
Route::delete('/{slug}/clients/{id}',['as' => 'clients.destroy','uses' =>'ClientController@destroy'])->middleware(['auth','XSS']);
// User
Route::get('/usersJson',['as' => 'user.email.json','uses' =>'UserController@getUserJson'])->middleware(['auth','XSS']);
Route::get('/{slug}/searchJson/{search?}',['as' => 'search.json','uses' =>'ProjectController@getSearchJson'])->middleware(['auth','XSS']);
Route::get('/userProjectJson/{id}',['as' => 'user.project.json','uses' =>'UserController@getProjectUserJson'])->middleware(['auth','XSS']);
Route::get('/{slug}/users',['as' => 'users.index','uses' =>'UserController@index'])->middleware(['auth','XSS']);
Route::get('/{slug}/users/invite',['as' => 'users.invite','uses' =>'UserController@invite'])->middleware(['auth','XSS']);
Route::put('/{slug}/users/invite',['as' => 'users.invite.update','uses' =>'UserController@inviteUser'])->middleware(['auth','XSS']);
Route::get('/{slug}/users/edit/{id}',['as' => 'users.edit','uses' =>'UserController@edit'])->middleware(['auth','XSS']);
Route::put('/{slug}/users/update/{id}',['as' => 'users.update','uses' =>'UserController@update'])->middleware(['auth','XSS']);
Route::delete('/{slug}/users/{id}',['as' => 'users.remove','uses' =>'UserController@removeUser'])->middleware(['auth','XSS']);

Route::get('/my-account',['as' => 'users.my.account','uses' =>'UserController@account'])->middleware(['auth','XSS']);
Route::post('/my-account',['as' => 'update.account','uses' =>'UserController@update'])->middleware(['auth','XSS']);
Route::post('/my-account/password',['as' => 'update.password','uses' =>'UserController@updatePassword'])->middleware(['auth','XSS']);
Route::delete('/my-account',['as' => 'delete.avatar','uses' =>'UserController@deleteAvatar'])->middleware(['auth','XSS']);


Route::get('/','HomeController@index')->middleware(['auth','XSS']);
Route::get('/{slug?}', ['as' => 'home','uses' =>'HomeController@index'])->middleware(['auth','XSS']);


// Workspace
Route::post('/workspace',['as' => 'add_workspace','uses' =>'WorkspaceController@store'])->middleware(['auth','XSS']);
Route::delete('/workspace/{id}',['as' => 'delete_workspace','uses' =>'WorkspaceController@destroy'])->middleware(['auth','XSS']);
Route::delete('/workspace/leave/{id}',['as' => 'leave_workspace','uses' =>'WorkspaceController@leave'])->middleware(['auth','XSS']);
Route::get('/workspace/{id}',['as' => 'change_workspace','uses' =>'WorkspaceController@changeCurrantWorkspace'])->middleware(['auth','XSS']);
Route::get('/workspace/{slug}/change_lang/{lang}',['as' => 'change_lang_workspace','uses' =>'WorkspaceController@changeLangWorkspace'])->middleware(['auth','XSS']);
Route::get('/workspace/{slug}/lang/create',['as' => 'create_lang_workspace','uses' =>'WorkspaceController@createLangWorkspace'])->middleware(['auth','XSS']);
Route::get('/workspace/{slug}/lang/{lang}',['as' => 'lang_workspace','uses' =>'WorkspaceController@langWorkspace'])->middleware(['auth','XSS']);
Route::post('/workspace/{slug}/lang/{lang}',['as' => 'store_lang_data_workspace','uses' =>'WorkspaceController@storeLangDataWorkspace'])->middleware(['auth','XSS']);
Route::post('/workspace/{slug}/lang',['as' => 'store_lang_workspace','uses' =>'WorkspaceController@storeLangWorkspace'])->middleware(['auth','XSS']);


// project
Route::get('/{slug}/projects',['as' => 'projects.index','uses' =>'ProjectController@index'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/create',['as' => 'projects.create','uses' =>'ProjectController@create'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/{id}',['as' => 'projects.show','uses' =>'ProjectController@show'])->middleware(['auth','XSS']);
Route::post('/{slug}/projects',['as' => 'projects.store','uses' =>'ProjectController@store'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/edit/{id}',['as' => 'projects.edit','uses' =>'ProjectController@edit'])->middleware(['auth','XSS']);
Route::put('/{slug}/projects/{id}',['as' => 'projects.update','uses' =>'ProjectController@update'])->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/{id}',['as' => 'projects.destroy','uses' =>'ProjectController@destroy'])->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/leave/{id}',['as' => 'projects.leave','uses' =>'ProjectController@leave'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/invite/{id}',['as' => 'projects.invite.popup','uses' =>'ProjectController@popup'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/share/{id}',['as' => 'projects.share.popup','uses' =>'ProjectController@sharePopup'])->middleware(['auth','XSS']);
Route::post('/{slug}/projects/share/{id}',['as' => 'projects.share','uses' =>'ProjectController@share'])->middleware(['auth','XSS']);
Route::put('/{slug}/projects/invite/{id}',['as' => 'projects.invite.update','uses' =>'ProjectController@invite'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/milestone/{id}',['as' => 'projects.milestone','uses' =>'ProjectController@milestone'])->middleware(['auth','XSS']);
Route::post('/{slug}/projects/milestone/{id}',['as' => 'projects.milestone.store','uses' =>'ProjectController@milestoneStore'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/milestone/{id}/show',['as' => 'projects.milestone.show','uses' =>'ProjectController@milestoneShow'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/milestone/{id}/edit',['as' => 'projects.milestone.edit','uses' =>'ProjectController@milestoneEdit'])->middleware(['auth','XSS']);
Route::put('/{slug}/projects/milestone/{id}',['as' => 'projects.milestone.update','uses' =>'ProjectController@milestoneUpdate'])->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/milestone/{id}',['as' => 'projects.milestone.destroy','uses' =>'ProjectController@milestoneDestroy'])->middleware(['auth','XSS']);
Route::post('/{slug}/projects/{id}/file',['as' => 'projects.file.upload','uses' =>'ProjectController@fileUpload'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/{id}/file/{fid}',['as' => 'projects.file.download','uses' =>'ProjectController@fileDownload'])->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/{id}/file/delete/{fid}',['as' => 'projects.file.delete','uses' =>'ProjectController@fileDelete'])->middleware(['auth','XSS']);

// Task Board
Route::get('/{slug}/projects/client/task-board/{code}',['as' => 'projects.client.task.board','uses' =>'ProjectController@taskBoard']);
Route::get('/{slug}/projects/{id}/task-board',['as' => 'projects.task.board','uses' =>'ProjectController@taskBoard'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/{id}/task-board/create',['as' => 'tasks.create','uses' =>'ProjectController@taskCreate'])->middleware(['auth','XSS']);
Route::post('/{slug}/projects/{id}/task-board',['as' => 'tasks.store','uses' =>'ProjectController@taskStore'])->middleware(['auth','XSS']);
Route::put('/{slug}/projects/{id}/task-board/order',['as' => 'tasks.update.order','uses' =>'ProjectController@taskOrderUpdate']);
Route::get('/{slug}/projects/{id}/task-board/edit/{tid}',['as' => 'tasks.edit','uses' =>'ProjectController@taskEdit'])->middleware(['auth','XSS']);
Route::put('/{slug}/projects/{id}/task-board/{tid}',['as' => 'tasks.update','uses' =>'ProjectController@taskUpdate'])->middleware(['auth','XSS']);
Route::delete('/{slug}/projects/{id}/task-board/{tid}',['as' => 'tasks.destroy','uses' =>'ProjectController@taskDestroy'])->middleware(['auth','XSS']);
Route::get('/{slug}/projects/{id}/task-board/{tid}/{cid?}',['as' => 'tasks.show','uses' =>'ProjectController@taskShow']);

Route::post('/{slug}/projects/{id}/comment/{tid}/file/{cid?}',['as' => 'comment.store.file','uses' =>'ProjectController@commentStoreFile']);
Route
    ::delete('/{slug}/projects/{id}/comment/{tid}/file/{fid}',['as' => 'comment.destroy.file','uses' =>'ProjectController@commentDestroyFile']);
Route::post('/{slug}/projects/{id}/comment/{tid}/{cid?}',['as' => 'comment.store','uses' =>'ProjectController@commentStore']);
Route
    ::delete('/{slug}/projects/{id}/comment/{tid}/{cid}',['as' => 'comment.destroy','uses' =>'ProjectController@commentDestroy']);
Route::post('/{slug}/projects/{id}/sub-task/{tid}/{cid?}',['as' => 'subtask.store','uses' =>'ProjectController@subTaskStore']);
Route::put('/{slug}/projects/{id}/sub-task/{stid}',['as' => 'subtask.update','uses' =>'ProjectController@subTaskUpdate']);
Route::delete('/{slug}/projects/{id}/sub-task/{stid}',['as' => 'subtask.destroy','uses' =>'ProjectController@subTaskDestroy']);


// todo
//Route::get('/{slug}/todo',['as' => 'todos.index','uses' =>'TodoController@index'])->middleware(['auth','XSS']);
//Route::post('/{slug}/todo',['as' => 'todos.store','uses' =>'TodoController@store'])->middleware(['auth','XSS']);
//Route::put('/{slug}/todo',['as' => 'todos.update','uses' =>'TodoController@update'])->middleware(['auth','XSS']);
//Route::delete('/{slug}/todo',['as' => 'todos.destroy','uses' =>'TodoController@destroy'])->middleware(['auth','XSS']);

// note
Route::get('/{slug}/notes',['as' => 'notes.index','uses' =>'NoteController@index'])->middleware(['auth','XSS']);
Route::get('/{slug}/notes/create',['as' => 'notes.create','uses' =>'NoteController@create'])->middleware(['auth','XSS']);
Route::post('/{slug}/notes',['as' => 'notes.store','uses' =>'NoteController@store'])->middleware(['auth','XSS']);
Route::get('/{slug}/notes/edit/{id}',['as' => 'notes.edit','uses' =>'NoteController@edit'])->middleware(['auth','XSS']);
Route::put('/{slug}/notes/{id}',['as' => 'notes.update','uses' =>'NoteController@update'])->middleware(['auth','XSS']);
Route::delete('/{slug}/notes/{id}',['as' => 'notes.destroy','uses' =>'NoteController@destroy'])->middleware(['auth','XSS']);

// calendar
//Route::get('/{slug}/calendar',['as' => 'calendar.index','uses' =>'CalendarController@index'])->middleware(['auth','XSS']);
//Route::post('/{slug}/calendar',['as' => 'calendar.store','uses' =>'CalendarController@store'])->middleware(['auth','XSS']);
//Route::delete('/{slug}/calendar',['as' => 'calendar.destroy','uses' =>'CalendarController@destroy'])->middleware(['auth','XSS']);
//Route::put('/{slug}/calendar',['as' => 'calendar.update','uses' =>'CalendarController@update'])->middleware(['auth','XSS']);
//Route::put('/{slug}/calendar/date',['as' => 'calendar.updateDate','uses' =>'CalendarController@updateDate'])->middleware(['auth','XSS']);
//Route::post('/{slug}/calendar/json',['as' => 'calendar.getJson','uses' =>'CalendarController@getJson'])->middleware(['auth','XSS']);
//Route::post('/{slug}/event',['as' => 'event.store','uses' =>'CalendarController@eventStore'])->middleware(['auth','XSS']);


