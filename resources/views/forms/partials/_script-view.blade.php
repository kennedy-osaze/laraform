<script>
    $(function() {
        var form = '{{ $form->code }}';
        var fields = {!! json_encode($formatted_fields) !!};
        var template_divs = $('#form-fields').children('.field');

        if (!$.isEmptyObject(fields) && template_divs.length > 0) {
            setUpFormFields(fields, template_divs);
        }

        autosize($('.elastic'));

        $('.styled').uniform({
            radioClass: 'choice'
        });

        // $('.bootstrap-select').selectpicker();
        $('select.select').select2({
            minimumResultsForSearch: Infinity
        });

        $('.pickadate').each(function (index) {
            var $pickadate = $(this);

            $pickadate.pickadate({
                format: 'd mmmm, yyyy',
                formatSubmit: 'yyyy-mm-dd',
                hiddenName: true,
                selectMonths: true,
                today: '',
                selectYears: 90,
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

        $('#user-form').validate({
            submitHandler: function (form) {
                saveResponse(form, function () {
                    var $panel = $(form).closest('.panel-body');
                    var response = 'Your responses have been submitted successfully.';
                    var paragraph = $('p').addClass('content-group').text(response);

                    $panel.empty();
                    $panel.append(paragraph);
                }, function (error_message) {
                    notify('error', 'Error occured: ' + error_message);
                });
                return false;
            }
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

        function setUpFormFields(fields, template_divs) {
            template_divs.each(function (index) {
                var field_id = $(this).data('id');
                var field_attribute = $(this).data('attribute');
                var field_attribute_type = $(this).data('attributeType');

                var field_data = fields[field_attribute];
                var template = $(this).find('.template');

                var label = template.find('label.field-label');
                var id = field_attribute + '.' + field_id;

                label.attr('for', id);
                label.find('span.question').text(field_data['question']);

                if (field_data['required']) {
                    label.append(' <span class="text-danger required">*</span>');
                }

                if (field_attribute_type === 'single') {
                    var template_input = template.find('input');
                    var input = (template_input.length) ? template_input : template.find('textarea');

                    input.attr({
                        id: id,
                        name: field_attribute
                    });

                    if (field_data['required']) {
                        input.prop('required', true);
                        input.attr('required', 'required');
                    }
                } else {
                    var options_div = template.find('.options');
                    if (options_div.hasClass('button')) {
                        var type = options_div.hasClass('checkboxes') ? 'checkbox' : 'radio';
                        var sample_button = options_div.find('div.' + type).clone();
                        options_div.empty();

                        if (field_data['options'] !== null) {
                            var field_options = field_data['options'];
                            for (var i = 0; i < field_options.length; i++) {
                                var button = sample_button.clone();
                                var button_field_name = 'input[type='+ type +']';
                                var input = button.find(button_field_name);
                                var name = (type === 'checkbox') ? field_attribute + '[]' : field_attribute;

                                input.attr({
                                    name: name,
                                    value: field_options[i]
                                });

                                if (i === 0 && field_data['required']) {
                                    input.prop('required', true);
                                    input.attr('required', 'required');
                                }

                                button.find('span.option').text(field_options[i]);
                                options_div.append(button);
                            }
                        }
                    } else if (options_div.hasClass('select')) {
                        var select = options_div.find('select.select');
                        select.attr({
                            id: id,
                            name: field_attribute
                        });

                        if (field_data['required']) {
                            select.prop('required', true);
                            select.attr('required', 'required');
                        }

                        if (field_data['options'] !== null) {
                            var field_options = field_data['options'];
                            var option = '<option value="">Choose an Option</option>'
                            for (var i = 0; i < field_options.length; i++) {
                                option += '<option value="' + field_options[i] + '">' + field_options[i] + '</option>';
                            }
                            select.append(option);
                        }
                    } else if (options_div.hasClass('scale')) { // Linear scale
                        var input = options_div.find('.input-group');
                        var field_options = field_data['options'];
                        var min = field_options["min"];
                        var max = field_options["max"];

                        if (min["label"] === null && max["label"] === null) {
                            input.removeClass('input-group').addClass('no-label');
                        }

                        if (min["label"] !== null) {
                            var option_span = $('<span class="input-group-addon option-label"></span>');
                            option_span.text(min["label"]);
                            input.prepend(option_span);
                        }

                        var min_value = Number(min["value"]);
                        var max_value = Number(max["value"]);
                        var input_range = $('<input type="range" class="form-control slider" name="' + field_attribute + '" id="' + id + '" min="' + min_value + '" max="' + max_value + '" step="1">');
                        if (field_data['required']) {
                            input_range.prop('required', true);
                            input_range.attr('required', 'required');
                        }
                        input.append(input_range);
                        var values = [];

                        for (var i = min_value; i <= max_value; i++) {
                            values.push(i);
                        }

                        input_range.ionRangeSlider({
                            min: min_value,
                            max: max_value,
                            // grid: true,
                            step: 1,
                            prefix: 'Rating: ',
                            keyboard: true,
                            values: values,
                        });

                        if (max["label"] !== null) {
                            var option_span = $('<span class="input-group-addon option-label"></span>');
                            option_span.text(max["label"]);
                            input.append(option_span);
                        }
                    }
                }
            });
        }

        function saveResponse(form, successCallback, failedCallback) {
            var $form = $(form);

            submit_button = $form.find('#submit');
            submit_button.button('loading');

            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: $form.serialize(),
                dataType: 'json'
            })
            .done(function (response) {
                submit_button.button('complete');

                if (response.success) {
                    successCallback();
                } else {
                    failedCallback(response.error);
                }
            });
        }
    });

    function notify(type, message) {
        noty({
            width: 200,
            text: message,
            type: type,
            dismissQueue: true,
            timeout: 6000,
            layout: 'top',
            buttons: false
        });
    }
</script>
