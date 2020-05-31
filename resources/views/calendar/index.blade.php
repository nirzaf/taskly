@extends('layouts.main')

@section('content')

    <section class="section">

    @if($currantWorkspace)

        <h2 class="section-title">{{ __('Calendar') }}</h2>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12">
                                <div id="calendar"></div>
                            </div> <!-- end col -->

                        </div>  <!-- end row -->
                    </div> <!-- end card body-->
                </div> <!-- end card -->

            </div>
            <!-- end col-12 -->
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
@endsection

@if($currantWorkspace)
@push('style')
    <link rel="stylesheet" href="{{asset('assets/css/calender.main.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/calender.daygrid.min.css')}}">
@endpush
@push('scripts')
    <script src="{{asset('assets/js/calender.main.min.js')}}"></script>
    <script src="{{asset('assets/js/calender.daygrid.min.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'dayGrid' ],
                events: {!! json_encode($arrayJson) !!},
                eventClick: function(calEvent) {

                    console.log(calEvent);
                    console.log(calEvent.el.innerText);

                    return false;

                }
            });

            calendar.render();
        });

        $(document).on("click",'.fc-day-grid-event',function (e) {
            e.preventDefault();
            var title = $(this).find('.fc-content .fc-title').text();
            var size = 'lg';
            var url = $(this).attr('href');

            $("#commanModel .modal-title").html(title);
            $("#commanModel .modal-dialog").addClass('modal-'+size);
            $("#commanModel").modal('show');

            $.get(url, {}, function(data) {
                $('#commanModel .modal-body').html(data);
                animate();
                setTimeout(function(){ animate(); }, 200);
                LetterAvatar.transform();
            });
        })

    </script>
    <!-- third party js ends -->
    <script>
        $(document).on('click','#form-comment button',function (e) {
            var comment = $.trim($("#form-comment textarea[name='comment']").val());
            if(comment != ''){
                $.ajax({
                    url:$("#form-comment").data('action'),
                    data:{comment:comment,"_token":$('meta[name="csrf-token"]').attr('content')},
                    type:'POST',
                    success:function (data) {
                        data = JSON.parse(data);

                        if(data.user_type == 'Client'){
                            var avatar = "avatar='"+data.client.name+"'";
                            var html = "<li class='media'>" +
                                "                    <img class='mr-3 avatar-sm rounded-circle img-thumbnail' width='60' "+avatar+" alt='"+data.client.name+"'>" +
                                "                    <div class='media-body'>" +
                                "                        <h5 class='mt-0'>"+data.client.name+"</h5>" +
                                "                        "+data.comment +
                                "                    </div>" +
                                "                </li>";
                        }else{
                            var avatar = (data.user.avatar)?"src='{{asset('/storage/avatars/')}}/"+data.user.avatar+"'":"avatar='"+data.user.name+"'";
                            var html = "<li class='media'>" +
                                "                    <img class='mr-3 avatar-sm rounded-circle img-thumbnail' width='60' "+avatar+" alt='"+data.user.name+"'>" +
                                "                    <div class='media-body'>" +
                                "                        <h5 class='mt-0'>"+data.user.name+"</h5>" +
                                "                        "+data.comment +
                                "                           <div class='float-right'>"+
                                "                               <a href='#' class='text-danger text-muted delete-comment' data-url='"+data.deleteUrl+"'>"+
                                "                                   <i class='dripicons-trash'></i>"+
                                "                               </a>"+
                                "                           </div>"+
                                "                    </div>" +
                                "                </li>";
                        }




                        $("#comments").prepend(html);
                        LetterAvatar.transform();
                        $("#form-comment textarea[name='comment']").val('');
                        toastr('Success','{{ __("Comment Added Successfully!")}}','success');
                    },
                    error:function (data) {
                        toastr('Error', '{{ __("Some Thing Is Wrong!")}}', 'error');
                    }
                });
            }
            else{
                toastr('Error','{{ __("Please write comment!")}}','error');
            }
        });
        $(document).on("click",".delete-comment",function(){
            if(confirm('Are You Sure ?')) {
                var btn = $(this);
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    data: {_token: $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'JSON',
                    success: function (data) {
                        toastr('Success', '{{ __("Comment Deleted Successfully!")}}', 'success');
                        btn.closest('.media').remove();
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            toastr('Error', data.message, 'error');
                        } else {
                            toastr('Error', '{{ __("Some Thing Is Wrong!")}}', 'error');
                        }
                    }
                });
            }
        });
        $(document).on('submit','#form-subtask',function (e) {
            e.preventDefault();
            $.ajax({
                url: $("#form-subtask").data('action'),
                type: 'POST',
                data: new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data)
                {
                    console.log(data);
                    toastr('Success','{{ __("Sub Task Added Successfully!")}}','success');

                    var html = '<li class="list-group-item pt-2 pb-0">' +
                        '                                <label class="custom-switch pl-0">' +
                        '                                    <input type="checkbox" name="option" value="'+data.id+'" class="custom-switch-input" data-url="'+data.updateUrl+'">' +
                        '                                    <span class="custom-switch-indicator"></span>' +
                        '                                    <span class="custom-switch-description">'+data.name+'</span>' +
                        '                                </label>' +
                        '                                <div class="float-right">' +
                        '                                    <a href="#" class="text-danger text-muted delete-subtask" data-url="'+data.deleteUrl+'">' +
                        '                                        <i class="dripicons-trash"></i>' +
                        '                                    </a>' +
                        '                                </div>' +
                        '                            </li>';
                    $("#subtasks").prepend(html);
		    $("#form-subtask input[name=name]").val('');
                    $("#form-subtask input[name=due_date]").val('');
                    $("#form-subtask").collapse('toggle');
                },
                error: function(data)
                {
                    data = data.responseJSON;
                    if(data.message) {
                        toastr('Error', data.message, 'error');
                        $('#file-error').text(data.errors.file[0]).show();
                    }
                    else{
                        toastr('Error', '{{ __("Some Thing Is Wrong!")}}', 'error');
                    }
                }
            });
        });
        $(document).on("change","#subtasks input[type=checkbox]",function(){
            $.ajax({
                url: $(this).attr('data-url'),
                type: 'PUT',
                data: {_token:$('meta[name="csrf-token"]').attr('content')},
                dataType:'JSON',
                success: function(data)
                {
                    toastr('Success','{{ __("Subtask Updated Successfully!")}}','success');
                    // console.log(data);
                },
                error: function(data)
                {
                    data = data.responseJSON;
                    if(data.message) {
                        toastr('Error', data.message, 'error');
                    }
                    else{
                        toastr('Error', '{{ __("Some Thing Is Wrong!")}}', 'error');
                    }
                }
            });
        });
        $(document).on("click",".delete-subtask",function(){
            if(confirm('Are You Sure ?')) {
                var btn = $(this);
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    data: {_token: $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'JSON',
                    success: function (data) {
                        toastr('Success', '{{ __("Subtask Deleted Successfully!")}}', 'success');
                        btn.closest('.list-group-item').remove();
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            toastr('Error', data.message, 'error');
                        } else {
                            toastr('Error', '{{ __("Some Thing Is Wrong!")}}', 'error');
                        }
                    }
                });
            }
        });
        $(document).on('submit','#form-file',function (e) {

            e.preventDefault();
            $.ajax({
                url: $("#form-file").data('action'),
                type: 'POST',
                data: new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data)
                {
                    toastr('Success','{{ __("Comment Added Successfully!")}}','success');
                    // console.log(data);

                    var delLink = '';

                    if(data.deleteUrl.length > 0){
                        delLink = "<a href='#' class='text-danger text-muted delete-comment-file'  data-url='"+data.deleteUrl+"'>" +
                            "                                        <i class='dripicons-trash'></i>" +
                            "                                    </a>";
                    }

                    var html = "<div class='card mb-1 shadow-none border'>" +
                        "                        <div class='card-body pt-2 pb-2'>" +
                        "                            <div class='row align-items-center'>" +
                        "                                <div class='col-auto'>" +
                        "                                    <div class='avatar-sm'>" +
                        "                                        <span class='avatar-title rounded text-uppercase'>" +
                        data.extension +
                        "                                        </span>" +
                        "                                    </div>" +
                        "                                </div>" +
                        "                                <div class='col pl-0'>" +
                        "                                    <a href='#' class='text-muted font-weight-bold'>"+data.name+"</a>" +
                        "                                    <p class='mb-0'>"+data.file_size+"</p>" +
                        "                                </div>" +
                        "                                <div class='col-auto'>" +
                        "                                    <!-- Button -->" +
                        "                                    <a download href='{{asset('/storage/tasks/')}}/"+data.file+"' class='btn btn-link text-muted'>" +
                        "                                        <i class='dripicons-download'></i>" +
                        "                                    </a>" +
                        delLink +
                        "                                </div>" +
                        "                            </div>" +
                        "                        </div>" +
                        "                    </div>";
                    $("#comments-file").prepend(html);
                },
                error: function(data)
                {
                    data = data.responseJSON;
                    if(data.message) {
                        toastr('Error', data.message, 'error');
                        $('#file-error').text(data.errors.file[0]).show();
                    }
                    else{
                        toastr('Error', '{{ __("Some Thing Is Wrong!")}}', 'error');
                    }
                }
            });
        });
        $(document).on("click",".delete-comment-file",function(){
            if(confirm('Are You Sure ?')) {
                var btn = $(this);
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    data: {_token: $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'JSON',
                    success: function (data) {
                        toastr('Success', '{{ __("File Deleted Successfully!")}}', 'success');
                        btn.closest('.border').remove();
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            toastr('Error', data.message, 'error');
                        } else {
                            toastr('Error', '{{ __("Some Thing Is Wrong!")}}', 'error');
                        }
                    }
                });
            }
        });
    </script>
@endpush
@endif
