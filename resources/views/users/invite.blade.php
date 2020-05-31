<link href="{{ asset('assets/css/vendor/bootstrap-tagsinput.css') }}" rel="stylesheet">
<form class="pl-3 pr-3" method="post" action="{{ route('users.invite.update',[$currantWorkspace->slug]) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="users_list">{{ __('Users') }}</label>
        <input type="email" class="form-control" id="users_list" name="users_list" value=""/>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">{{ __('Invite Users') }}</button>
    </div>
</form>
<!-- third party js -->
<script src="{{ asset('assets/js/vendor/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap-tagsinput.min.js') }}"></script>
<!-- third party js ends -->

<script>
    var UserNames = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: {
            url: '{{ route('user.email.json',$currantWorkspace->id) }}',
            cache:false,
            filter: function(list) {
                return $.map(list, function(UserName) {
                    return { name: UserName };
                });
            }
        }
    });
    UserNames.initialize();

    $('.users_list').tagsinput({
        typeaheadjs: {
            name: 'UserNames',
            displayKey: 'name',
            valueKey: 'name',
            source: UserNames.ttAdapter()
        }
    });

    $('.users_list').on('itemAdded', function(event) {
        var yourRegex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;//
        if( yourRegex.test(event.item)){

        }else{
            $('.users_list').tagsinput('remove', event.item);
        }
    });

</script>