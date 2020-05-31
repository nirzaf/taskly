<form class="pl-3 pr-3" method="post" action="{{ route('users.update',[$currantWorkspace->slug,$user->id]) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}"/>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">{{ __('Update User') }}</button>
    </div>
</form>