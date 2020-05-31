@extends('layouts.main')

@section('content')
<!-- Start Content-->
<section class="section">

    @if($currantWorkspace || Auth::user()->type == 'admin')

        <div class="row mb-2">
            <div class="col-sm-4">
                <h2 class="section-title">{{ __('Users') }}</h2>
            </div>
            @if($currantWorkspace && $currantWorkspace->creater->id == Auth::user()->id)
            <div class="col-sm-8">
                <div class="text-sm-right">
                    <button type="button" class="btn btn-primary btn-rounded mt-4" data-ajax-popup="true" data-size="lg" data-title="{{ __('Invite New User') }}" data-url="{{route('users.invite',$currantWorkspace->slug)}}">
                        <i class="mdi mdi-plus"></i> {{ __('Invite User') }}
                    </button>
                </div>
            </div>
            @endif
        </div>


        <div class="row">
            @foreach ($users as $user)
            <div class="col-lg-4 col-md-4 animated">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img @if($user->avatar) src="{{asset('/storage/avatars/'.$user->avatar)}}" width="75px" @else avatar="{{ $user->name }}"@endif alt="" class="rounded-circle profile-widget-picture">
                        <div class="profile-widget-items">

                            @if(Auth::user()->type == 'admin')
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">{{ __('Number of Workspaces')}}</div>
                                    <div class="profile-widget-item-value">{{$user->countWorkspace()}}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">{{ __('Number of Users')}}</div>
                                    <div class="profile-widget-item-value">{{$user->countUsers(($currantWorkspace)?$currantWorkspace->id:'')}}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">{{ __('Number of Clients')}}</div>
                                    <div class="profile-widget-item-value">{{$user->countClients(($currantWorkspace)?$currantWorkspace->id:'')}}</div>
                                </div>
                            @endif
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">{{ __('Number of Projects')}}</div>
                                <div class="profile-widget-item-value">{{$user->countProject(($currantWorkspace)?$currantWorkspace->id:'')}}</div>
                            </div>
                            @if(Auth::user()->type != 'admin')
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">{{ __('Number of Tasks')}}</div>
                                    <div class="profile-widget-item-value">{{$user->countTask(($currantWorkspace)?$currantWorkspace->id:'')}}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="profile-widget-description pb-0">
                        <div class="card-body p-0">
                            <div class="card-header-action">
                                <div class="dropdown card-widgets text-right">
                                    @if($currantWorkspace->permission == 'Owner' && Auth::user()->id != $user->id)
                                        <div class="dropdown card-widgets float-right">
                                            <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown" aria-expanded="false">
                                                <i class="dripicons-gear"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="{{__('Edit User')}}" data-url="{{route('users.edit',[$currantWorkspace->slug,$user->id])}}"><i class="mdi mdi-pencil mr-1"></i>{{__('Edit')}}</a>
                                                <a href="#" onclick="(confirm('Are you sure ?')?document.getElementById('delete-form-{{$user->id}}').submit(): '');" class="dropdown-item"><i class="mdi mdi-delete mr-1"></i>{{__('Remove User From Workspace')}}</a>
                                                <form method="post" id="delete-form-{{$user->id}}" action="{{route('users.remove',[$currantWorkspace->slug,$user->id])}}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="profile-widget-name">{{$user->name}} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> {{$user->permission}}</div></div>

                            <p><label class="font-weight-bold">{{__('Email Address ')}} : </label> {{$user->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="container mt-5">
            <div class="page-error">
                <div class="page-inner">
                    <h1>404</h1>
                    <div class="page-description">
                        {{ __('Page Not Found') }}
                    </div>
                    <div class="page-search">
                        <p class="text-muted mt-3">{{ __('It\'s looking like you may have taken a wrong turn. Don\'t worry... it happens to the best of us. Here\'s a little tip that might help you get back on track.')}}</p>
                        <div class="mt-3">
                            <a class="btn btn-info mt-3" href="{{route('home')}}"><i class="mdi mdi-reply"></i> {{ __('Return Home')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>
<!-- container -->
@endsection