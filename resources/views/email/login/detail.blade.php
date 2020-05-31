@component('mail::message')
# {{ __('Hello')}}, {{ $user->name }}

{{ __('Your login detail for')}} {{ config('app.name') }} is

<table>
    <tr>
        <td>{{ __('Username')}}</td>
        <td>:</td>
        <td>{{$user->email}}</td>
    </tr>
    <tr>
        <td>{{ __('Password')}}</td>
        <td>:</td>
        <td>{{$user->password}}</td>
    </tr>
</table>

@component('mail::button', ['url' => route('login')])
{{ __('Login')}}
@endcomponent

{{ __('Thanks')}},<br>
{{ config('app.name') }}
@endcomponent
