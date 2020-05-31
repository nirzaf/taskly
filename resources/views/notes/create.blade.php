<form class="pl-3 pr-3" method="post" action="{{ route('notes.store',$currantWorkspace->slug) }}">
    @csrf
    <div class="form-group">
        <label for="title">{{ __('Title') }}</label>
        <input class="form-control" type="text" id="title" name="title" required="" placeholder="{{ __('Title') }}">
    </div>
    <div class="form-group">
        <label for="description">{{ __('Description') }}</label>
        <textarea class="form-control" id="description" name="text" required></textarea>
    </div>
    <div class="form-group">
        <label for="color">{{ __('Color') }}</label>
        <select class="form-control" name="color" required>
            <option value="bg-primary">{{ __('Primary') }}</option>
            <option value="bg-secondary">{{ __('Secondary') }}</option>
            <option value="bg-info">{{ __('Info') }}</option>
            <option value="bg-warning">{{ __('Warning') }}</option>
            <option value="bg-danger">{{ __('Danger') }}</option>
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">{{ __('Create Note') }}</button>
    </div>
</form>