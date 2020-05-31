@component('mail::message')
# {{ __('Hello')}}, {{ $user->name }}

{{ __('You invite in new project')}} <b> {{ $project->name }}</b> {{ __('by')}} {{ $project->creater->name }}

@component('mail::button', ['url' => route('projects.show',[$project->workspaceData->slug,$project->id])])
{{ __('Open Project')}}
@endcomponent

{{ __('Thanks')}},<br>
{{ config('app.name') }}
@endcomponent
