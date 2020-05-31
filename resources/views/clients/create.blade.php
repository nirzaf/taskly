<form class="pl-3 pr-3" method="post" action="{{ route('clients.store',[$currantWorkspace->slug]) }}">
    @csrf
    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <input type="text" class="form-control" id="name" name="name"/>
    </div>
    <div class="form-group">
        <label for="email">{{ __('Email') }}</label>
        <input type="email" class="form-control" id="email" name="email"/>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">{{ __('Create Client') }}</button>
    </div>
</form>