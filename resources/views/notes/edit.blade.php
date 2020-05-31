<form class="pl-3 pr-3" method="post" action="{{ route('notes.update',[$currantWorkspace->slug,$notes->id]) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">{{ __('Title') }}</label>
        <input class="form-control" type="text" id="title" name="title" value="{{$notes->title}}" required="" placeholder="{{ __('Title') }}">
    </div>
    <div class="form-group">
        <label for="description">{{ __('Description') }}</label>
        <textarea class="form-control" id="description" name="text" required>{{$notes->text}}</textarea>
    </div>
    <div class="form-group">
        <label for="color">{{ __('Color') }}</label>
        <select class="form-control" name="color" required>
            <option value="bg-primary">{{ __('Primary')}}</option>
            <option @if($notes->color == 'bg-secondary') selected @endif value="bg-secondary">{{ __('Secondary')}}</option>
            <option @if($notes->color == 'bg-info') selected @endif value="bg-info">{{ __('Info')}}</option>
            <option @if($notes->color == 'bg-warning') selected @endif value="bg-warning">{{ __('Warning')}}</option>
            <option @if($notes->color == 'bg-danger') selected @endif value="bg-danger">{{ __('Danger')}}</option>
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">{{ __('Update Note') }}</button>
    </div>
</form>