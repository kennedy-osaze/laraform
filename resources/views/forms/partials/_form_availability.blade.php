@push('styles')
    <style>
        body { background: red; }
        .picker--time .picker__holder {
            width: 75% !important;
        }
    </style>
@endpush

@php $availability = $form->availability; @endphp

<div id="form-availability" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Form Availabilty Settings</h6>
            </div>

            <form id="form-availability-form" method="post" action="{{ route('form.availability.save', $form->code) }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="open_form_date" class="mt-15">Open the form on</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" id="open_form_date" name="open_form_date" class="form-control pickadate" data-value="{{ isset($availability) ? optional($availability->open_form_at)->toDateString() : null }}">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" id="open_form_time" name="open_form_time" class="form-control pickatime" data-value="{{ isset($availability) ? optional($availability->open_form_at)->toTimeString() : null }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="close_form_date" class="mt-15">Close the form on</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" id="close_form_date" name="close_form_date" class="form-control pickadate" data-value="{{ isset($availability) ? optional($availability->close_form_at)->toDateString() : null }}">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" id="close_form_time" name="close_form_time" class="form-control pickatime" data-value="{{ isset($availability) ? optional($availability->close_form_at)->toDateString() : null }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="response_limit" class="mt-15">Or turn off after</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" min="1" max="999999999" id="response_limit" name="response_limit" class="form-control" value="{{ $availability ? $availability->response_count_limit : null }}">
                        </div>
                        <div class="col-sm-5">
                            <label for="end_time" class="mt-15">responses (i.e. the response limit)</label>
                        </div>
                    </div>

                    <div class="mt-30">
                        <p>Open form on a recurring schedule. The form remains closed outside the specified schedule.</p>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="weekday" class="mt-15">Enable form every</label>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" name="weekday">
                                    <option value="">Choose Days</option>
                                    @foreach(App\FormAvailability::weekDays() as $index => $day)
                                        <option value="{{ $index }}"{{ (optional($availability)->available_weekday === $index) ? ' selected' : '' }}>{{ $day }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="start_time" class="mt-15">between</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" id="start_time" name="start_time" class="form-control pickatime" data-value="{{ optional($availability)->available_start_time }}">
                            </div>
                            <div class="col-sm-1">
                                <label for="end_time" class="mt-15">and</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" id="end_time" name="end_time" class="form-control pickatime" data-value="{{ optional($availability)->available_end_time }}">
                            </div>
                        </div>

                        <div class="form-group mt-30">
                            <textarea name="closed_form_message" id="closed_form_message" class="form-control" rows="4" placeholder="Closed form message">{{ optional($availability)->closed_form_message }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary reset pull-left" data-loading-text="Resetting...">Reset Settings</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn bg-teal submit" data-loading-text="Saving...">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
<script src="{{ asset('assets/js/plugins/pickadate/picker.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pickadate/picker.date.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pickadate/picker.time.js') }}"></script>
<script src="{{ asset('assets/js/plugins/pickadate/legacy.js') }}"></script>

<script>
    $(function () {
        $('.pickadate').each(function (index) {
            var $pickadate = $(this);

            toggleFormAvailabilityResetButton(Boolean({{ $availability !== null }}));

            $pickadate.pickadate({
                format: 'd mmmm, yyyy',
                formatSubmit: 'yyyy-mm-dd',
                hiddenName: true,
                today: '',
                min: true,
                editable: true,
                onClose: function() {
                    $('.datepicker').focus();
                }
            });

            var picker_date = $pickadate.pickadate('picker');
            $pickadate.on('click', function(event) {
                if (picker_date.get('open')) {
                    picker_date.close();
                } else {
                    picker_date.open();
                }
                event.stopPropagation();
            });
        });

        $('.pickatime').each(function (index) {
            var $pickatime = $(this);

            $pickatime.pickatime({
                editable: true,
                formatSubmit: 'HH:i',
                hiddenName: true
            });

            var picker_time = $pickatime.pickatime('picker');
            $pickatime.on('click', function(event) {
                if (picker_time.get('open')) {
                    picker_time.close();
                } else {
                    picker_time.open();
                }
                event.stopPropagation();
            });
        });

        $('#form-availability-form').validate({
            submitHandler: function (form) {
                saveFormAvailability(form);
                return false;
            },
            rules: {
                closed_form_message: {
                    maxlength: 30000,
                    minWords: 3,
                }
            },
        });

        function saveFormAvailability(form) {
            var $form = $(form);

            submit_button = $form.find('.submit');
            submit_button.button('loading');

            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: $form.serialize(),
                dataType: 'json'
            })
            .done(function (response) {
                submit_button.button('reset');

                if (response.success) {
                    $form.closest('#form-availability').modal('hide');

                    notify('success', 'The form availability details have been saved successfully.');

                    toggleFormAvailabilityResetButton(true);
                } else {
                    notify('error', 'Error occurred: ' + response.error);
                }
            });
        }

        $("#form-availability-form button.reset").click(function () {
            var $form = $("#form-availability-form");

            $form.find('.reset').button('loading');

            $.ajax({
                url: '{{ route('form.availability.reset', $form->code) }}',
                type: 'POST',
                data: { _token: csrf_token, _method: 'DELETE' },
                dataType: 'json'
            })
            .done(function (response) {
                if (response.success) {
                    $form.find('.reset').button('reset');

                    $("#form-availability-form")[0].reset();

                    toggleFormAvailabilityResetButton(false);
                } else {
                    notify('error', 'Error occurred: ' + response.error);
                }
            });
        });

        function toggleFormAvailabilityResetButton(should_show) {
            $reset_button = $("#form-availability-form button.reset");

            if (should_show) {
                $reset_button.show();
            } else {
                $reset_button.hide();
            }
        }
    });
</script>
@endpush
