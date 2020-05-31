
@if($currantWorkspace && $task)

    <div class="p-2">
        <div class="font-weight-bold">{{ __('Description')}}:</div>

        <p class="text-muted mb-4">
            {{$task->description}}
        </p>

        <div class="row mb-4">
            <div class="col-md-3">
                <div>
                    <div class="font-weight-bold">{{ __('Create Date')}}</div>
                    <p class="mt-1">{{date('d M Y',strtotime($task->created_at))}}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div>
                    <div class="font-weight-bold">{{ __('Due Date')}}</div>
                    <p class="mt-1">{{date('d M Y',strtotime($task->due_date))}}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div>
                    <div class="font-weight-bold">{{ __('Asigned')}}</div>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="{{$task->user->name}}" data-original-title="{{$task->user->name}}" class="d-inline-block mt-1">
                        <img @if($task->user->avatar) src="{{asset('/storage/avatars/'.$task->user->avatar)}}" @else avatar="{{ $task->user->name }}" @endif class="rounded-circle avatar-xs" width="30" alt="{{$task->user->name}}">
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div>
                    <div class="font-weight-bold">{{ __('Milestone')}}</div>
                    @php($milestone = $task->milestone())
                    <p class="mt-1">@if($milestone) {{$milestone->title}} @endif</p>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs nav-bordered mb-3">
            <li class="nav-item">
                <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                    {{ __('Comments')}}
                </a>
            </li>
            <li class="nav-item">
                <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link">
                    {{ __('Files')}}
                </a>
            </li>
            @if(empty($clientID))
            <li class="nav-item">
                <a href="#sub-task" data-toggle="tab" aria-expanded="true" class="nav-link">
                    {{ __('Sub Task')}}
                </a>
            </li>
            @endif
        </ul>

        <div class="tab-content">
            <div class="tab-pane show active" id="home-b1">
                <form method="post" id="form-comment" data-action="{{route('comment.store',[$currantWorkspace->slug,$task->project_id,$task->id,$clientID])}}">
                    <textarea class="form-control form-control-light mb-2" name="comment" placeholder="{{ __('Write message')}}" id="example-textarea" rows="3" required></textarea>
                    <div class="text-right">
                        <div class="btn-group mb-2 ml-2 d-none d-sm-inline-block">
                            <button type="button" class="btn btn-primary">{{ __('Submit')}}</button>
                        </div>
                    </div>
                </form>

                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border" id="comments">

                        @foreach($task->comments as $comment)
                            <li class="media">
                                <img class="mr-3 avatar-sm rounded-circle img-thumbnail" width="60"
                                     @if($comment->user_type!='Client')
                                     @if($comment->user->avatar) src="{{asset('/storage/avatars/'.$comment->user->avatar)}}" @else avatar="{{ $comment->user->name }}" @endif alt="{{ $comment->user->name }}"
                                     @else
                                     avatar="{{ $comment->client->name }}" alt="{{ $comment->client->name }}"
                                        @endif
                                />
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1 font-weight-bold">@if($comment->user_type!='Client'){{$comment->user->name}}@else {{$comment->client->name}} @endif</h5>
                                    {{$comment->comment}}
                                    @if(empty($clientID))
                                    <div class="float-right">
                                        <a href="#" class="text-danger text-muted delete-comment" data-url="{{route('comment.destroy',[$currantWorkspace->slug,$task->project_id,$task->id,$comment->id])}}">
                                            <i class="dripicons-trash"></i>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="tab-pane" id="profile-b1">
                <form method="post" id="form-file" enctype="multipart/form-data" data-action="{{ route('comment.store.file',[$currantWorkspace->slug,$task->project_id,$task->id,$clientID]) }}">
                    @csrf
                    <input type="file" class="form-control mb-2" name="file" id="file">
                    <span class="invalid-feedback" id="file-error" role="alert">
                        <strong></strong>
                    </span>
                    <div class="text-right">
                        <div class="btn-group mb-2 ml-2 d-none d-sm-inline-block">
                            <button type="submit" class="btn btn-primary">{{ __('Upload')}}</button>
                        </div>
                    </div>
                </form>
                <div id="comments-file" class="mt-2">
                    @foreach($task->taskFiles as $file)
                    <div class="card mb-1 shadow-none border">
                        <div class="card-body pt-2 pb-2">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded text-uppercase">
                                            {{$file->extension}}
                                        </span>
                                    </div>
                                </div>
                                <div class="col pl-0">
                                    <a href="#" class="text-muted font-weight-bold">{{$file->name}}</a>
                                    <p class="mb-0">{{$file->file_size}}</p>
                                </div>
                                <div class="col-auto">
                                    <!-- Button -->
                                    <a download href="{{asset('/storage/tasks/'.$file->file)}}" class="btn btn-link text-muted">
                                        <i class="dripicons-download"></i>
                                    </a>
                                    @if(empty($clientID))
                                        <a href="#" class="text-danger text-muted delete-comment-file" data-url="{{route('comment.destroy.file',[$currantWorkspace->slug,$task->project_id,$task->id,$file->id])}}">
                                            <i class="dripicons-trash"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @if(empty($clientID))
            <div class="tab-pane show" id="sub-task">
                <div class="text-right mb-1">
                    <a href="#" class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#form-subtask">{{ __('Add Sub Task')}}</a>
                </div>
                <form method="post" id="form-subtask" class="collapse" data-action="{{route('subtask.store',[$currantWorkspace->slug,$task->project_id,$task->id,$clientID])}}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{__('Name')}}</label>
                                    <input type="text" name="name" class="form-control" required placeholder="{{__('Sub Task Name')}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>{{__('Due Date')}}</label>
                                    <input type="text" name="due_date" class="form-control date" required data-date-format="yy-mm-dd" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="btn-group mb-2 ml-2 d-none d-sm-inline-block">
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('Create')}}</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card-body p-1">
                    <ul class="list-group" id="subtasks">

                        @foreach($task->sub_tasks as $subTask)
                            <li class="list-group-item pt-2 pb-0">
                                <label class="custom-switch pl-0">
                                    <input type="checkbox" name="option" value="{{$subTask->id}}" class="custom-switch-input" @if($subTask->status) checked @endif data-url="{{route('subtask.update',[$currantWorkspace->slug,$task->project_id,$subTask->id])}}">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">{{$subTask->name}} <small class="text-dark">{{__('Due Date')}} - {{date('d M Y',strtotime($subTask->due_date))}}</small></span>
                                </label>
                                <div class="float-right">
                                    <a href="#" class="text-danger text-muted delete-subtask" data-url="{{route('subtask.destroy',[$currantWorkspace->slug,$task->project_id,$subTask->id])}}">
                                        <i class="dripicons-trash"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>

    </div>

    <script>
        $("input.date").each(function () {
            $(this).datepicker({
                dateFormat:$(this).data('date-format'),
                minDate:'{{date('Y-m-d')}}'
            });
        });
    </script>

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
