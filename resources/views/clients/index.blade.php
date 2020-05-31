@extends('layouts.main')

@section('content')
    <section class="section">


    @if($currantWorkspace)

        <div class="row mb-2">
            <div class="col-sm-4">
                <h2 class="section-title">{{ __('Clients') }}</h2>
            </div>
            <div class="col-sm-8">
                @if($currantWorkspace->creater->id == Auth::user()->id)
                <div class="text-sm-right">
                    <button type="button" class="btn btn-primary btn-rounded mt-4" data-ajax-popup="true" data-size="lg" data-title="{{ __('Add Client') }}" data-url="{{route('clients.create',$currantWorkspace->slug)}}">
                        <i class="mdi mdi-plus"></i> {{ __('Add Client') }}
                    </button>
                </div>
                @endif
            </div>
        </div>

        <div class="row">
            @foreach ($clients as $client)
            <div class="col-lg-4 col-md-4 animated">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown card-widgets float-right">
                            @if(isset($client->is_active) && !$client->is_active)
                                <a href="#" title="{{__('Locked')}}">
                                    <i class="mdi mdi-lock-outline"></i>
                                </a>
                            @endif
                            @if($currantWorkspace->permission == 'Owner')
                            <div class="dropdown card-widgets float-right">
                                <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown" aria-expanded="false">
                                    <i class="dripicons-gear"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="{{__('Edit Client')}}" data-url="{{route('clients.edit',[$currantWorkspace->slug,$client->id])}}"><i class="mdi mdi-pencil mr-1"></i>{{__('Edit')}}</a>
                                    <a href="#" onclick="(confirm('Are you sure ?')?document.getElementById('delete-form-{{$client->id}}').submit(): '');" class="dropdown-item"><i class="mdi mdi-delete mr-1"></i>{{__('Delete')}}</a>
                                    <form method="post" id="delete-form-{{$client->id}}" action="{{route('clients.destroy',[$currantWorkspace->slug,$client->id])}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                        <span class="float-left mr-4">
                            <img avatar="{{ $client->name }}" alt="" class="rounded-circle img-thumbnail">
                        </span>
                        <div class="media-body mt-2">
                            <h6 class="font-weight-bold">{{$client->name}}</h6>
                            <p class="mb-0">{{$client->email}}</p>
                        </div>
                        <div class="clearfix"></div>
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