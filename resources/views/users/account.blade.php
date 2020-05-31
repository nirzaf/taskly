@extends('layouts.main')

@section('content')
<section class="section">

    <h2 class="section-title">{{ __('User Profile') }}</h2>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-3 mb-2 mb-sm-0">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link show active animated" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="false">
                                        <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">{{ __('Account')}}</span>
                                    </a>
                                    <a class="nav-link animated" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">{{ __('Change Password')}}</span>
                                    </a>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-sm-9">
                                <div class="tab-content animated" id="v-pills-tabContent">
                                    <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <form method="post" action="{{route('update.account')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="fullname">{{ __('Full Name') }}</label>
                                                        <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" id="fullname" placeholder="{{ __('Enter Your Name') }}" value="{{ $user->name }}" required autocomplete="name">
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="avatar">{{ __('Avatar') }}</label>
                                                        <input class="form-control @error('avatar') is-invalid @enderror" name="avatar" type="file" id="avatar" accept="image/*">
                                                        @error('avatar')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                        <span>
                                                            <small>{{ __('Please upload a valid image file. Size of image should not be more than 2MB.')}}</small>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 text-center pt-5 pl-5 pr-5">
                                                    <img @if($user->avatar) src="{{asset('/storage/avatars/'.$user->avatar)}}" @else avatar="{{ $user->name }}" @endif id="myAvatar" alt="user-image" class="rounded-circle img-thumbnail w-100">
                                                    @if($user->avatar!='')
                                                        <button type="button" class="btn btn-danger mt-2" onclick="document.getElementById('delete_avatar').submit();">
                                                            <i class="mdi mdi-delete mr-1"></i> {{ __('Delete')}}
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-sm-6">
                                                    <div class="">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="mdi mdi-update mr-1"></i> {{ __('Update')}} </button>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                        </form>
                                        @if($user->avatar!='')
                                            <form action="{{route('delete.avatar')}}" method="post" id="delete_avatar">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <form method="post" action="{{route('update.password')}}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="old_password">{{ __('Old Password') }}</label>
                                                        <input class="form-control @error('old_password') is-invalid @enderror" name="old_password" type="password" id="old_password" required autocomplete="old_password" placeholder="{{ __('Enter Old Password') }}">
                                                        @error('old_password')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">{{ __('Password') }}</label>
                                                        <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" required autocomplete="new-password" id="password" placeholder="{{ __('Enter Your Password') }}">
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                                        <input class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" type="password" required autocomplete="new-password" id="password_confirmation" placeholder="{{ __('Enter Your Password') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-sm-6">
                                                    <div>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="mdi mdi-lock mr-1"></i> {{ __('Change Password')}} </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection