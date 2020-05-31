
@if($project && $currantWorkspace)

    <form class="pl-3 pr-3" method="post" action="{{ route('projects.milestone.store',[$currantWorkspace->slug,$project->id]) }}">
        @csrf

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="milestone-title">{{ __('Milestone Title')}}</label>
                    <input type="text" class="form-control form-control-light" id="milestone-title" placeholder="{{ __('Enter Title')}}" name="title" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="milestone-status">{{ __('Status')}}</label>
                    <select class="form-control form-control-light" name="status" id="milestone-status" required>
                        <option value="incomplete">{{ __('Incomplete')}}</option>
                        <option value="complete">{{ __('Complete')}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="milestone-title">{{ __('Milestone Cost')}}</label>
            <input type="number" class="form-control form-control-light" id="milestone-title" placeholder="{{ __('Enter Cost')}}" value="0" min="0" name="cost" required>
        </div>
        <div class="form-group">
            <label for="task-summary">{{ __('Summary')}}</label>
            <textarea class="form-control form-control-light" id="task-summary" rows="3" name="summary"></textarea>
        </div>


        <div class="text-right">
            <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('Cancel')}}</button>
            <button type="submit" class="btn btn-primary">{{ __('Create')}}</button>
        </div>

    </form>

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
