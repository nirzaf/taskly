<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Taskly') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons.min.css')}}">
    <link href="{{ asset('assets/css/easy-autocomplete.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @stack('style')
</head>

<body>

<!-- Begin page -->
<div>

    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                @include('partials.topnav')
            </nav>
            <div class="main-sidebar">
                @include('partials.sidebar')
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                @include('partials.footer')
            </footer>
        </div>
    </div>
</div>

<div id="commanModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modelCommanModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title" id="modelCommanModelLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

@if(Auth::user()->type != 'admin')
    <div id="modelCreateWorkspace" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modelCreateWorkspaceLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelCreateWorkspaceLabel">{{ __('Create Your Workspace') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="pl-3 pr-3" method="post" action="{{ route('add_workspace') }}">
                        @csrf
                        <div class="form-group">
                            <label for="workspacename">{{ __('Name') }}</label>
                            <input class="form-control" type="text" id="workspacename" name="name" required="" placeholder="{{ __('Workspace Name') }}">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">{{ __('Create Workspace') }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/scrollreveal.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

@if(isset($currantWorkspace) && $currantWorkspace)
<script src="{{ asset('assets/js/jquery.easy-autocomplete.min.js') }}"></script>

<script>
    var options = {
        url: function(phrase) {
            return "{{route('search.json',$currantWorkspace->slug)}}/" + phrase ;
        },
        categories: [
            {
                listLocation: "Projects",
                header: "{{ __('Projects') }}"
            },
            {
                listLocation: "Tasks",
                header: "{{ __('Tasks') }}"
            }
        ],
        getValue: "text",
        template: {
            type: "links",
            fields: {
                link: "link"
            }
        }
    };
    $(".search-element input").easyAutocomplete(options);
</script>
@endif
@stack('scripts')

@if ($message = Session::get('success'))
    <script>toastr('Success','{!! $message !!}','success')</script>
@endif

@if ($message = Session::get('error'))
    <script>toastr('Error','{!! $message !!}','error')</script>
@endif

@if ($message = Session::get('info'))
    <script>toastr('Info','{!! $message !!}','info')</script>
@endif
</body>

</html>
