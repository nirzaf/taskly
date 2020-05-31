@component('mail::message')
#  {{ __('Hello')}}, {{ $client->name }}

{{ __('You invite in new project')}} <b> {{ $project->name }}</b> {{ __('by')}} {{ $project->creater->name }}

@component('mail::button', ['url' => route('projects.client.task.board',[$project->workspaceData->slug,\Illuminate\Support\Facades\Crypt::encrypt(['client_id'=>$client->id,'project_id'=>$project->id])])])
{{ __('Open Project')}}
@endcomponent

{{ __('Thanks')}},<br>
{{ config('app.name') }}
@endcomponent
