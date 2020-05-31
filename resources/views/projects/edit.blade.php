<form class="pl-3 pr-3" method="post" action="{{ route('projects.update',[$currantWorkspace->slug,$project->id]) }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="projectname">{{ __('Name') }}</label>
                <input class="form-control" type="text" id="projectname" name="name" value="{{$project->name}}" required="" placeholder="{{ __('Project Name') }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">{{ __('Status') }}</label>
                        <select id="status" name="status" class="form-control">
                            <option value="Ongoing">{{ __('Ongoing') }}</option>
                            <option value="Finished" @if($project->status == 'Finished') selected @endif>{{ __('Finished') }}</option>
                            <option value="OnHold" @if($project->status == 'OnHold') selected @endif>{{ __('OnHold') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="budget">{{ __('Budget') }}</label>
                        <div class="input-group">
                            <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend"><span class="input-group-text">$</span></span>
                            <input class="form-control" type="number" min="0" id="budget" name="budget" value="{{$project->budget}}" placeholder="{{ __('Project Budget') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="start_date">{{ __('Start Date') }}</label>
                <input class="form-control date" type="text" id="start_date" name="start_date" value="{{$project->start_date}}" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="end_date">{{ __('End Date') }}</label>
                <input class="form-control date" type="text" id="end_date" name="end_date" value="{{$project->end_date}}" autocomplete="off">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                <textarea class="form-control" id="description" name="description">{{$project->description}}</textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">{{ __('Edit Project') }}</button>
    </div>
</form>
<script>
    $( function() {
        var dateFormat = "yy-mm-dd",
            from = $( "#start_date" )
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3,
                    dateFormat:dateFormat
                })
                .on( "change", function() {
                    to.datepicker( "option", "minDate", getDate( this ) );
                }),
            to = $( "#end_date" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3,
                dateFormat:dateFormat
            })
                .on( "change", function() {
                    from.datepicker( "option", "maxDate", getDate( this ) );
                });

        function getDate( element ) {
            var date;
            try {
                date = $.datepicker.parseDate( dateFormat, element.value );
            } catch( error ) {
                date = null;
            }

            return date;
        }
    } );
</script>
