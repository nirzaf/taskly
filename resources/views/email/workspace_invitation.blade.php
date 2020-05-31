@component('mail::message')
# {{ __('Hello')}}, {{ $user->name }}

{{ __('You invite in new Workspace')}} <b> {{ $workspace->name }}</b> {{ __('by')}} {{ $workspace->creater->name }}

@component('mail::button', ['url' => route('home',[$workspace->slug])])
    {{ __('Open Workspace')}}
@endcomponent

{{ __('Thanks')}},<br>
{{ config('app.name') }}
@endcomponent
