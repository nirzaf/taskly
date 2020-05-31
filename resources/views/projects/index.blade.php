@extends('layouts.main')

@section('content')

<section class="section">

    <h2 class="section-title">{{ __('Projects') }}</h2>

    @if($projects && $currantWorkspace)

    <div class="row mb-2">
        @if($currantWorkspace->creater->id == Auth::user()->id)
        <div class="col-sm-4">
            <button type="button" class="btn btn-primary btn-rounded mb-3" data-ajax-popup="true" data-size="lg" data-title="{{ __('Create New Project') }}" data-url="{{route('projects.create',$currantWorkspace->slug)}}">
                <i class="mdi mdi-plus"></i> {{ __('Create Project') }}
            </button>
        </div>
        @endif
        <div class="col-sm-8">
            <div class="text-sm-right status-filter">
                <div class="btn-group mb-3">
                    <button type="button" class="btn btn-primary" data-status="All">{{ __('All')}}</button>
                </div>
                <div class="btn-group mb-3 ml-1">
                    <button type="button" class="btn btn-light" data-status="Ongoing">{{ __('Ongoing')}}</button>
                    <button type="button" class="btn btn-light" data-status="Finished">{{ __('Finished')}}</button>
                    <button type="button" class="btn btn-light" data-status="OnHold">{{ __('OnHold')}}</button>
                </div>

            </div>
        </div><!-- end col-->
    </div>

    <div class="row">
        @foreach ($projects as $project)

        <div class="col-12 col-sm-12 col-lg-6 animated filter {{$project->status}}">
            <div class="card author-box card-primary">
                <div class="card-body">
                    <div class="card-header-action">
                        <div class="dropdown card-widgets">
                            <a href="#" class="btn active dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="dripicons-gear"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            @if($currantWorkspace->permission == 'Owner')
                                <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="{{ __('Edit Project') }}" data-url="{{route('projects.edit',[$currantWorkspace->slug,$project->id])}}"><i class="mdi mdi-pencil mr-1"></i>{{ __('Edit')}}</a>
                                <a href="#" onclick="(confirm('Are you sure ?')?document.getElementById('delete-form-{{$project->id}}').submit(): '');" class="dropdown-item"><i class="mdi mdi-delete mr-1"></i>{{ __('Delete')}}</a>
                                <form id="delete-form-{{$project->id}}" action="{{ route('projects.destroy',[$currantWorkspace->slug,$project->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="#" class="dropdown-item" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="{{ __('Invite Users') }}" data-url="{{route('projects.invite.popup',[$currantWorkspace->slug,$project->id])}}"><i class="mdi mdi-email-outline mr-1"></i>{{ __('Invite')}}</a>
                                <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="{{ __('Share to Clients') }}" data-url="{{route('projects.share.popup',[$currantWorkspace->slug,$project->id])}}"><i class="mdi mdi-email-outline mr-1"></i>{{ __('Share')}}</a>
                            @else
                                <a href="#" onclick="(confirm('Are you sure ?')?document.getElementById('leave-form-{{$project->id}}').submit(): '');" class="dropdown-item"><i class="mdi mdi-exit-to-app mr-1"></i>{{ __('Leave')}}</a>
                                <form id="leave-form-{{$project->id}}" action="{{ route('projects.leave',[$currantWorkspace->slug,$project->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                            </div>
                        </div>
                    </div>

                    <div class="author-box-name">

                        <a href="{{route('projects.show',[$currantWorkspace->slug,$project->id])}}" title="{{ $project->name }}" class="text-title">{{ $project->name }}</a>

                    </div>
                    <div class="author-box-job">
                        @if($project->status == 'Finished')
                            <div class="badge badge-success">{{ __('Finished')}}</div>
                        @elseif($project->status == 'Ongoing')
                            <div class="badge badge-secondary">{{ __('Ongoing')}}</div>
                        @else
                            <div class="badge badge-warning">{{ __('OnHold')}}</div>
                        @endif
                    </div>

                    <div class="author-box-description">
                        <p>
                            {{Str::limit($project->description, $limit = 100, $end = '...')}}
                        </p>
                    </div>
                    <p class="mb-1">
                        <span class="pr-2 text-nowrap mb-2 d-inline-block">
                            <i class="mdi mdi-format-list-bulleted-type text-muted"></i>
                            <b>{{$project->countTask()}}</b> {{ __('Tasks')}}
                        </span>
                        <span class="text-nowrap mb-2 d-inline-block">
                            <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                            <b>{{$project->countTaskComments()}}</b> {{ __('Comments')}}
                        </span>
                    </p>

                    @foreach($project->users as $user)

                            <figure class="avatar mr-2 avatar-sm animated" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$user->name}}">
                                <img @if($user->avatar) src="{{asset('/storage/avatars/'.$user->avatar)}}" @else avatar="{{ $user->name }}"@endif class="rounded-circle">
                            </figure>

                    @endforeach

                    <div class="float-right mt-sm-0 mt-3">
                        <a href="{{route('projects.show',[$currantWorkspace->slug,$project->id])}}" class="btn btn-sm btn-primary">{{__('View More')}} <i class="dripicons-arrow-right"></i></a>
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

@push('style')
{{--    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('assets/css/vendor/bootstrap-tagsinput.css') }}" rel="stylesheet">
@endpush