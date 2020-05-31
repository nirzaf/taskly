<form class="pl-3 pr-3" method="post" action="{{ route('store_lang_workspace',$currantWorkspace->slug) }}">
    @csrf
    <div class="form-group">
        <label for="code">{{ __('Language Code') }}</label>
        <input class="form-control" type="text" id="code" name="code" required="" placeholder="{{ __('Language Code') }}">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">{{ __('Create') }}</button>
    </div>
</form>
<!-- third party js -->
<script src="{{ asset('js/app.min.js') }}"></script>
<!-- third party js ends -->