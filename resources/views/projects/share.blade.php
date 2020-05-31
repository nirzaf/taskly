<link href="{{ asset('css/vendor/bootstrap-tagsinput.css') }}" rel="stylesheet">
<form class="pl-3 pr-3" method="post" action="{{ route('projects.share',[$currantWorkspace->slug,$project->id]) }}">
    @csrf
    <div class="form-group">
        <label for="users_list">{{ __('Clients') }}</label>

        <select class="select2 form-control select2-multiple" data-toggle="select2" name="clients[]" multiple="multiple" data-placeholder="{{ __('Select Clients ...') }}">
            @foreach($currantWorkspace->clients as $client)

                    <option value="{{$client->id}}">{{$client->name}} - {{$client->email}}</option>

            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">{{ __('Share To Clients') }}</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
