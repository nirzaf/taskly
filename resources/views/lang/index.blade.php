@extends('layouts.main')

@section('content')
    <section class="section">

        @if($currantWorkspace && $currantWorkspace->permission == 'Owner')

            <div class="row mb-2">
                <div class="col-sm-4">
                    <h2 class="section-title">{{ __('Languages') }}</h2>
                </div>
                <div class="col-sm-8">
                    <div class="text-sm-right">
                        <button type="button" class="btn btn-primary btn-rounded mt-4" data-ajax-popup="true" data-size="lg" data-title="{{ __('Create new')}}" data-url="{{route('create_lang_workspace',$currantWorkspace->slug)}}">
                            <i class="mdi mdi-plus"></i> {{ __('Create new')}}
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach($currantWorkspace->languages() as $lang)
                                    <a href="{{route('lang_workspace',[$currantWorkspace->slug,$lang])}}" class="nav-link @if($currantLang == $lang) active @endif">
                                        <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">{{Str::upper($lang)}}</span>
                                    </a>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#labels" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                        <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">{{ __('Labels')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#messages" data-toggle="tab" aria-expanded="true" class="nav-link">
                                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">{{ __('Messages')}}</span>
                                    </a>
                                </li>
                            </ul>
                            <form method="post" action="{{route('store_lang_data_workspace',[$currantWorkspace->slug,$currantLang])}}">
                                @csrf
                                <div class="tab-content">
                                    <div class="tab-pane active" id="labels">
                                        <div class="row">
                                            @foreach($arrLabel as $label => $value)
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-3">
                                                        <label>{{$label}}</label>
                                                        <input type="text" class="form-control" name="label[{{$label}}]" value="{{$value}}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane show" id="messages">
                                        @foreach($arrMessage as $fileName => $fileValue)
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h3>{{ucfirst($fileName)}}</h3>
                                                </div>
                                                @foreach($fileValue as $label => $value)
                                                    @if(is_array($value))
                                                        @foreach($value as $label2 => $value2)
                                                            @if(is_array($value2))
                                                                @foreach($value2 as $label3 => $value3)
                                                                    @if(is_array($value3))
                                                                        @foreach($value3 as $label4 => $value4)
                                                                            @if(is_array($value4))
                                                                                @foreach($value4 as $label5 => $value5)
                                                                                    <div class="col-lg-6">
                                                                                        <div class="form-group mb-3">
                                                                                            <label>{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}.{{$label5}}</label>
                                                                                            <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}][{{$label5}}]" value="{{$value5}}">
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @else
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group mb-3">
                                                                                        <label>{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}</label>
                                                                                        <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}]" value="{{$value4}}">
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group mb-3">
                                                                                <label>{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}</label>
                                                                                <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}]" value="{{$value3}}">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <div class="col-lg-6">
                                                                    <div class="form-group mb-3">
                                                                        <label>{{$fileName}}.{{$label}}.{{$label2}}</label>
                                                                        <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}]" value="{{$value2}}">
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <div class="col-lg-6">
                                                            <div class="form-group mb-3">
                                                                <label>{{$fileName}}.{{$label}}</label>
                                                                <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}]" value="{{$value}}">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">{{ __('Save')}}</button>
                            </form>
                        </div>
                    </div> <!-- end card-->
                </div>
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
