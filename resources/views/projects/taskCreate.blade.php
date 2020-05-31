
@if($project && $currantWorkspace)

    <form class="pl-3 pr-3" method="post" action="{{ route('tasks.store',[$currantWorkspace->slug,$project->id]) }}">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>{{ __('Project')}}</label>
                    <select class="form-control form-control-light" name="project_id" required>
                        @foreach($projects as $p)
                        <option value="{{$p->id}}" @if($p->id == $project->id) selected @endif>{{$p->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="task-milestone">{{ __('Milestone')}}</label>
                    <select class="form-control form-control-light" name="milestone_id" id="task-milestone">
                        <option value="">{{__('Select Milestone')}}</option>
                        @foreach($project->milestones as $milestone)
                            <option value="{{$milestone->id}}">{{$milestone->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="task-title">{{ __('Title')}}</label>
                    <input type="text" class="form-control form-control-light" id="task-title"
                           placeholder="{{ __('Enter Title')}}" name="title" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="task-priority">{{ __('Priority')}}</label>
                    <select class="form-control form-control-light" name="priority" id="task-priority" required>
                        <option value="Low">{{ __('Low')}}</option>
                        <option value="Medium">{{ __('Medium')}}</option>
                        <option value="High">{{ __('High')}}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="task-description">{{ __('Description')}}</label>
            <textarea class="form-control form-control-light" id="task-description" rows="3" name="description"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="assign_to">{{ __('Assign To')}}</label>
                    <select class="form-control form-control-light" id="assign_to" name="assign_to" required>
                        @foreach($users as $u)
                            <option value="{{$u->id}}">{{$u->name}} - {{$u->email}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="due_date">{{ __('Due Date')}}</label>
                    <input type="text" class="form-control form-control-light date" id="due_date" data-provide="datepicker" data-date-format="yy-mm-dd" name="due_date" required autocomplete="off">
                </div>
            </div>
        </div>

        <div class="text-right">
            <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('Cancel')}}</button>
            <button type="submit" class="btn btn-primary">{{ __('Create')}}</button>
        </div>

    </form>
    <script>
        $("input.date").each(function () {
            $(this).datepicker({
                dateFormat:$(this).data('date-format'),
                minDate:'{{date('Y-m-d')}}'
            });
        });
    </script>
    <script>
        $(document).on('change',"select[name=project_id]",function () {
            $.get('{{route('home')}}'+'/userProjectJson/'+$(this).val(),function (data) {
                $('select[name=assign_to]').html('');
                data = JSON.parse(data);
                $(data).each(function(i,d){
                    $('select[name=assign_to]').append('<option value="'+d.id+'">'+d.name+' - '+d.email+'</option>');
                });
            })
        })
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
