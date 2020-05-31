<form class="pl-3 pr-3" method="post" action="{{ route('projects.store',$currantWorkspace->slug) }}">
    @csrf
    <div class="form-group">
        <label for="projectname">{{ __('Name') }}</label>
        <input class="form-control" type="text" id="projectname" name="name" required="" placeholder="{{ __('Project Name') }}">
    </div>
    <div class="form-group">
        <label for="description">{{ __('Description') }}</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <div class="form-group">
        <label for="users_list">{{ __('Users') }}</label>
        <select class="select2 form-control select2-multiple" id="users_list" name="users_list[]" data-toggle="select2" multiple="multiple" data-placeholder="{{ __('Select Users ...') }}">
            @foreach($currantWorkspace->users($currantWorkspace->created_by) as $user)
                <option value="{{$user->email}}">{{$user->name}} - {{$user->email}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">{{ __('Create Project') }}</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
