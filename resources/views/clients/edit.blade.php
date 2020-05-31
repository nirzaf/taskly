<form class="pl-3 pr-3" method="post" action="{{ route('clients.update',[$currantWorkspace->slug,$client->id]) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$client->name}}"/>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">{{ __('Update Client') }}</button>
    </div>
</form>