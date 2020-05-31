@extends('layouts.main')

@section('content')

    <section class="section">

        @if($project && $currantWorkspace)
        <div class="row mb-2">
            <div class="col-sm-4">
                <h2 class="section-title">{{ __('Project Detail') }}</h2>
            </div>
            <div class="col-sm-8">
                <div class="text-sm-right">
                    <div class="btn-group mt-4">
                        <a href="{{route('projects.task.board',[$currantWorkspace->slug,$project->id])}}" class="btn btn-primary">{{ __('Task Board')}}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 animated">
                <!-- project card -->
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
                        <!-- project title-->
                        <div class="author-box-name">
                           {{$project->name}}
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

                        <div class="mt-4 font-weight-bold">{{ __('Project Overview') }}:</div>

                        <div class="author-box-description">
                            {{$project->description}}
                        </div>

                        <div class="row mt-3">
                            @if($project->start_date)
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <div class="font-weight-bold">{{ __('Start Date')}}</div>
                                    <p> {{ date('d M Y',strtotime($project->start_date))}}</p>
                                </div>
                            </div>
                            @endif
                            @if($project->end_date)
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <div class="font-weight-bold">{{ __('End Date')}}</div>
                                    <p> {{ date('d M Y',strtotime($project->end_date))}}</p>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <div class="font-weight-bold">{{ __('Budget')}}</div>
                                    <p>${{ number_format($project->budget) }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="font-weight-bold mb-2">{{ __('Team Members') }}:</div>

                            @foreach($project->users as $user)

                                <figure class="avatar mr-2 avatar-sm animated" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$user->name}}">
                                    <img @if($user->avatar) src="{{asset('/storage/avatars/'.$user->avatar)}}" @else avatar="{{ $user->name }}"@endif class="rounded-circle">
                                </figure>

                            @endforeach
                        </div>

                    </div> <!-- end card-body-->

                </div> <!-- end card-->

                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-statistic-2">
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas mdi mdi-clock-outline"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{__('Days left')}}</h4>
                                </div>
                                <div class="card-body">
                                    @php
                                        $datetime1 = new DateTime($project->end_date);
                                        $datetime2 = new DateTime(date('Y-m-d'));
                                        $interval = $datetime1->diff($datetime2);
                                        $days = $interval->format('%a')
                                    @endphp
                                    {{$days}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-statistic-2">
                            <div class="card-icon shadow-danger bg-danger">
                                <i class="fas mdi mdi-format-list-checkbox"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{__('Total task')}}</h4>
                                </div>
                                <div class="card-body">
                                    {{$project->countTask()}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-statistic-2">
                            <div class="card-icon shadow-success bg-success">
                                <i class="fas mdi mdi-message-outline"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>{{__('Comments')}}</h4>
                                </div>
                                <div class="card-body">
                                    {{$project->countTaskComments()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card author-box card-primary">
                    <div class="card-body">
                        <div class="card-header-action">
                            <div class="dropdown card-widgets">
                                <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="{{ __('Create Milestone') }}" data-url="{{route('projects.milestone',[$currantWorkspace->slug,$project->id])}}">{{__('Create Milestone')}}</a>
                            </div>
                        </div>
                        <!-- project title-->
                        <div class="author-box-name mb-4">
                            {{__('Milestones')}} ({{count($project->milestones)}})
                        </div>

                        @foreach($project->milestones as $key => $milestone)

                            <div class="ribbon-wrapper  bg-white b-all mb-4 milestones">
                                <div class="ribbon ribbon-corner"><span class="milestone-count">#{{$key+1}}</span></div>
                                <div class="ribbon-content">
                                    <h5 class="media-heading text-info font-light">
                                        <a href="#" class="milestone-detail" data-ajax-popup="true" data-title="{{ __('Milestones Details') }}" data-url="{{route('projects.milestone.show',[$currantWorkspace->slug,$milestone->id])}}">{{$milestone->title}}</a>
                                        <div class="float-right">
                                            <small>
                                                <a href="#" class="btn btn-sm btn-outline-primary" data-ajax-popup="true" data-title="{{ __('Edit Milestone') }}" data-url="{{route('projects.milestone.edit',[$currantWorkspace->slug,$milestone->id])}}"><i class="mdi mdi-pencil"></i></a>
                                                <a href="#" class="btn btn-sm btn-outline-danger" onclick="(confirm('Are you sure ?')?document.getElementById('delete-form1-{{$milestone->id}}').submit(): '');"><i class="mdi mdi-delete"></i></a>
                                                <form id="delete-form1-{{$milestone->id}}" action="{{ route('projects.milestone.destroy',[$currantWorkspace->slug,$milestone->id]) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </small>
                                        </div>
                                    </h5>
                                    <div class="row">
                                        <div class="col-6">
                                            @if($milestone->status == 'incomplete')
                                                <label class="badge badge-warning">{{__('Incomplete')}}</label>
                                            @endif
                                            @if($milestone->status == 'complete')
                                                <label class="badge badge-success">{{__('Complete')}}</label>
                                            @endif
                                        </div>
                                        <div class="col-6 text-right">
                                            <strong>{{__('Milestone Cost')}}:</strong> ${{number_format($milestone->cost)}}
                                        </div>
                                        <div class="col-12">
                                            {{$milestone->summary}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div> <!-- end card-body-->

                </div> <!-- end card-->
                <div class="card author-box card-primary">
                    <div class="card-body">
                        <div class="author-box-name mb-4">
                            {{__('Files')}}
                        </div>
                        <div class="col-md-12 dropzone" id="dropzonewidget"></div>
                    </div>
                </div>

                <!-- end card-->
            </div> <!-- end col -->

            <div class="col-md-4 animated">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>{{ __('Progress') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="mt-3 chartjs-chart" style="height: 320px;">
                            <canvas id="line-chart-example"></canvas>
                        </div>
                    </div>
                </div>
                <!-- end card-->
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>{{ __('Activity') }}</h4>
                    </div>
                    <div class="card-body"  style="height: 500px;overflow-y: scroll">
                        <div class="activities">
                            @foreach($project->activities as $activity)
                                <div class="activity">
                                    @if($activity->log_type == 'Move')
                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                            <i class="mdi mdi-cursor-move"></i>
                                        </div>
                                    @elseif($activity->log_type == 'Create Milestone')
                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                            <i class="mdi mdi-target"></i>
                                        </div>
                                    @elseif($activity->log_type == 'Create Task')
                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                            <i class="mdi mdi-format-list-checks"></i>
                                        </div>
                                    @elseif($activity->log_type == 'Invite User')
                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                            <i class="mdi mdi-plus"></i>
                                        </div>
                                    @elseif($activity->log_type == 'Share with Client')
                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                            <i class="mdi mdi-plus"></i>
                                        </div>
                                    @elseif($activity->log_type == 'Upload File')
                                        <div class="activity-icon bg-primary text-white shadow-primary">
                                            <i class="mdi mdi-file"></i>
                                        </div>
                                    @endif
                                    <div class="activity-detail">
                                        <div class="mb-2">
                                            <span class="text-job">{{$activity->created_at->diffForHumans()}}</span>
                                        </div>
                                        <p>{!! $activity->remark !!}</p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

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

@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('assets/css/dropzone.min.css')}}">
@endpush
@push('scripts')
    <!-- third party js -->
    <script src="{{ asset('assets/js/vendor/Chart.bundle.min.js') }}"></script>
    <script>

window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};

    (function(global) {
	var MONTHS = [
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December'
	];

	var COLORS = [
		'#4dc9f6',
		'#f67019',
		'#f53794',
		'#537bc4',
		'#acc236',
		'#166a8f',
		'#00a950',
		'#58595b',
		'#8549ba'
	];

	var Samples = global.Samples || (global.Samples = {});
	var Color = global.Color;

	Samples.utils = {
		// Adapted from http://indiegamr.com/generate-repeatable-random-numbers-in-js/
		srand: function(seed) {
			this._seed = seed;
		},

		rand: function(min, max) {
			var seed = this._seed;
			min = min === undefined ? 0 : min;
			max = max === undefined ? 1 : max;
			this._seed = (seed * 9301 + 49297) % 233280;
			return min + (this._seed / 233280) * (max - min);
		},

		numbers: function(config) {
			var cfg = config || {};
			var min = cfg.min || 0;
			var max = cfg.max || 1;
			var from = cfg.from || [];
			var count = cfg.count || 8;
			var decimals = cfg.decimals || 8;
			var continuity = cfg.continuity || 1;
			var dfactor = Math.pow(10, decimals) || 0;
			var data = [];
			var i, value;

			for (i = 0; i < count; ++i) {
				value = (from[i] || 0) + this.rand(min, max);
				if (this.rand() <= continuity) {
					data.push(Math.round(dfactor * value) / dfactor);
				} else {
					data.push(null);
				}
			}

			return data;
		},

		labels: function(config) {
			var cfg = config || {};
			var min = cfg.min || 0;
			var max = cfg.max || 100;
			var count = cfg.count || 8;
			var step = (max - min) / count;
			var decimals = cfg.decimals || 8;
			var dfactor = Math.pow(10, decimals) || 0;
			var prefix = cfg.prefix || '';
			var values = [];
			var i;

			for (i = min; i < max; i += step) {
				values.push(prefix + Math.round(dfactor * i) / dfactor);
			}

			return values;
		},

		months: function(config) {
			var cfg = config || {};
			var count = cfg.count || 12;
			var section = cfg.section;
			var values = [];
			var i, value;

			for (i = 0; i < count; ++i) {
				value = MONTHS[Math.ceil(i) % 12];
				values.push(value.substring(0, section));
			}

			return values;
		},

		color: function(index) {
			return COLORS[index % COLORS.length];
		},

		transparentize: function(color, opacity) {
			var alpha = opacity === undefined ? 0.5 : 1 - opacity;
			return Color(color).alpha(alpha).rgbString();
		}
	};

	// DEPRECATED
	window.randomScalingFactor = function() {
		return Math.round(Samples.utils.rand(-100, 100));
	};

	// INITIALIZATION

	Samples.utils.srand(Date.now());



}(this));

var config = {
			type: 'line',
			data: {
				labels: {!! json_encode($chartData['label']) !!},
				datasets: [
				    {
                                label: "{{ __('Todo')}}",
                                fill: !0,
                                backgroundColor: "transparent",
                                borderColor: "#fa5c7c",
                                data: {!! json_encode($chartData['todo']) !!}
                            },
                            {
                                label: "{{ __('In Progress')}}",
                                fill: !0,
                                backgroundColor: "transparent",
                                borderColor: "#727cf5",
                                data: {!! json_encode($chartData['progress']) !!}
                            },
                            {
                                label: "{{ __('Review')}}",
                                fill: !0,
                                backgroundColor: "transparent",
                                borderColor: "#0acf97",
                                borderDash: [5, 5],
                                data: {!! json_encode($chartData['review']) !!}
                            },
                            {
                                label: "{{ __('Done')}}",
                                backgroundColor: "rgba(10, 207, 151, 0.3)",
                                borderColor: "#0acf97",
                                data: {!! json_encode($chartData['done']) !!}
                            },
				]
			},
			options: {
			    maintainAspectRatio:false,
			    scales: {
                    xAxes: [{reverse: !0, gridLines: {color: "rgba(0,0,0,0.05)"}}],
                    yAxes: [{
                        ticks: {stepSize: 10, display: !1},
                        min: 10,
                        max: 100,
                        display: !0,
                        borderDash: [5, 5],
                        gridLines: {color: "rgba(0,0,0,0)", fontColor: "#fff"}
                    }]
                },
				responsive: true,
				title: {
					display: false,
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				legend:{
				    display:false
				}
			}
		};

window.onload = function() {
			var ctx = document.getElementById('line-chart-example').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};

    </script>
    <!-- third party js ends -->

    <script src="{{asset('assets/js/dropzone.min.js')}}"></script>
    <script>
        Dropzone.autoDiscover = false;
        myDropzone = new Dropzone("#dropzonewidget",{
            maxFiles: 20,
            maxFilesize: 2,
            parallelUploads: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.txt",
            url: "{{route('projects.file.upload',[$currantWorkspace->slug,$project->id])}}",
            success: function(file, response){
                if(response.is_success){
                    dropzoneBtn(file,response);
                }else{
                    myDropzone.removeFile(file);
                    toastr('Error',response.error,'error');
                }
            },
            error: function (file, response) {
                myDropzone.removeFile(file);
                if(response.error) {
                    toastr('Error', response.error,'error');
                }else{
                    toastr('Error', response,'error');
                }
            }
        });
        myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("project_id", {{$project->id}});
        });
        function dropzoneBtn(file,response) {
            var download = document.createElement('a');
            download.setAttribute('href',response.download);
            download.setAttribute('class',"btn btn btn-outline-primary btn-sm mt-1 mr-1");
            download.setAttribute('data-toggle',"tooltip");
            download.setAttribute('data-original-title',"{{__('Download')}}");
            download.innerHTML = "<i class='mdi mdi-download'></i>";

            var del = document.createElement('a');
            del.setAttribute('href',response.delete);
            del.setAttribute('class',"btn btn-outline-danger btn-sm mt-1");
            del.setAttribute('data-toggle',"tooltip");
            del.setAttribute('data-original-title',"{{__('Delete')}}");
            del.innerHTML = "<i class='mdi mdi-delete'></i>";

            del.addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                if(confirm("Are you sure ?")) {
                    var btn = $(this);
                    $.ajax({
                        url: btn.attr('href'),
                        data: {_token: $('meta[name="csrf-token"]').attr('content')},
                        type: 'DELETE',
                        success: function (response) {
                            if(response.is_success) {
                                btn.closest('.dz-image-preview').remove();
                            }else{
                                toastr('Error', response.error,'error');
                            }
                        },
                        error: function (response) {
                            response = response.responseJSON;
                            if(response.is_success) {
                                toastr('Error', response.error,'error');
                            }else{
                                toastr('Error', response,'error');
                            }
                        }
                    })
                }
            });

            var html = document.createElement('div');
            html.appendChild(download);
            html.appendChild(del);

            file.previewTemplate.appendChild(html);
        }

        @php
            $files = $project->files;
        @endphp
        @foreach($files as $file)
        // Create the mock file:
        var mockFile = { name: "{{$file->file_name}}", size: {{filesize(storage_path('project_files/'.$file->file_path))}} };
        // Call the default addedfile event handler
        myDropzone.emit("addedfile", mockFile);
        // And optionally show the thumbnail of the file:
        myDropzone.emit("thumbnail", mockFile, "{{asset('storage/project_files/'.$file->file_path)}}");
        myDropzone.emit("complete", mockFile);

        dropzoneBtn(mockFile,{download:"{{route('projects.file.download',[$currantWorkspace->slug,$project->id,$file->id])}}",delete:"{{route('projects.file.delete',[$currantWorkspace->slug,$project->id,$file->id])}}"});

        @endforeach
    </script>
@endpush
