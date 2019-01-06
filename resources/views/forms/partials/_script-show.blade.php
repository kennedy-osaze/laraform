<script>
    $(function() {
        var form = '{{ $form->code }}';
        var fields = {!! json_encode($formatted_fields) !!};

        // Form questions
        var $questions = $('form .questions');

        // Add form fields
        $('a.question-template').on('click', function (event) {
            event.preventDefault();

            var data = {
                template: $(this).data('id'),
                _token: csrf_token
            };

            $.ajax({
                url: '{{ route('forms.fields.store', $form->code) }}',
                type: 'POST',
                data: data,
                dataType: 'json'
            })
            .done(function (response) {
                if (response.success) {
                    var template = instantiateFormTemplateWithData(form, response);
                    $questions.append(template);

                    completeTemplateInterfaceFeatures($questions);
                } else {
                    showError(response.error);
                }
            });
        });

        if (!$.isEmptyObject(fields) && $questions.children('.filled').length > 0) {
            var template_divs = $questions.children('.filled');

            prepareFormTemplatesWithFieldData(fields, template_divs);
            completeTemplateInterfaceFeatures($questions);
        }

        // Save form templates
        $('#create-form').validate({
            'submitHandler': function (form) {
                saveForm(form, function ($form) {
                    notify('success', 'Form template has been saved');
                    $form.find('#form-preview').removeClass('hidden').attr('href', '{{ route('forms.preview', $form->code) }}');
                }, function (error_message) {
                    showError(error_message);
                });
                return false;
            }
        });

        $('.tags-input').tagsinput({
            maxTags: 20,
            maxChars: 255,
            trimValue: true,
            tagClass: function(item){
                return 'label bg-teal';
            },
        });

        autosize($('.elastic'));

        function instantiateFormTemplateWithData(form, response) {
            var result = response.data;
            var template = $(result.sub_template);

            template.find('input.question-name').attr({
                name: result.attribute + '.question',
                id: result.attribute + '.question'
            });

            template.find('input.question-required').attr({
                name: result.attribute + '.required',
                id: result.attribute + '.required'
            });

            template.find('button.question-delete').attr({
                "data-form": form,
                "data-form-field": result.field
            });

            if (result.has_options) {
                if (template.hasClass('linear-scale')) {
                    var selects = template.find('select.question-option');
                    selects.each(function(index, element) {
                        var select = $(element);
                        var name = select.hasClass('min') ? 'minvalue' : 'maxvalue';
                        select.attr({
                            name: result.attribute + '.' + name,
                            id: result.attribute + '.' + name
                        });
                    });

                    var inputs = template.find('input.question-option-label');
                    inputs.each(function(index, element) {
                        var input = $(element);
                        var name = input.hasClass('min') ? 'minlabel' : 'maxlabel';
                        input.attr({
                            name: result.attribute + '.' + name,
                            id: result.attribute + '.' + name
                        });
                    });
                } else {
                    template.find('input.question-option').attr({
                        name: result.attribute + '.options[]',
                        id: result.attribute + '.options'
                    });
                }
            }

            return template;
        }

        function completeTemplateInterfaceFeatures($questions) {
            if ($questions.find('.template').length) {
                $('form .submit').removeClass('hidden');
            };

            // For Linear Scale
            var $bootstrap_select = $('.bootstrap-select');
            $bootstrap_select.selectpicker();

            $bootstrap_select.change(function () {
                var $select = $(this);
                var labels = $select.closest('.panel-body').find('.select-labels');
                var label_span = labels.find($select.hasClass('min') ? '.min-value' : '.max-value');

                label_span.text($select.find("option:selected").val() + '.');
            });

            // Add Field Options
            var add_option_buttons = $('button.add-option');
            add_option_buttons.each(function (index) {
                var $add_option_button = $(this);
                var max_option_count = 20;

                $add_option_button.on('click', function (event) {
                    event.preventDefault();

                    // Find the options wrapper
                    var options_wrapper = $(event.target).closest('.panel-body').find('div.options-wrapper');
                    var option_count = options_wrapper.children(':not(.hidden)').length + 1;

                    if (option_count < max_option_count) {
                        // Create a new wrapper
                        var new_option = options_wrapper.find('.hidden').clone().removeClass('hidden');

                        // Add attributes to new option
                        var count = option_count + 1;
                        var sn_span = new_option.find('.sn');

                        if (sn_span.length) {
                            sn_span.data('sn', count);
                            sn_span.text(count + '.');
                        }

                        new_option.find('input').prop('disabled', false);
                        new_option.find('input').removeAttr('disabled');
                        new_option.find('input').attr('placeholder', 'Option ' + count);

                        //append new option html to option wrapper
                        options_wrapper.append(new_option);
                    }
                });
            });

            finishUpFormFieldsExtras();
        }

        function finishUpFormFieldsExtras() {
            //Remove Options
            $('body').on('click', '.remove-option', function (event) {
                $(this).closest('.form-group').remove();
            });

            $('.styled').uniform({
                radioClass: 'choice'
            });

            // Switchery toggles
            if ($('.switchery').length > 0) {
                if (Array.prototype.forEach) {
                    var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
                    elems.forEach(function(html) {
                        var switchery = new Switchery(html);
                    });
                } else {
                    var elems = document.querySelectorAll('.switchery');

                    for (var i = 0; i < elems.length; i++) {
                        var switchery = new Switchery(elems[i]);
                    }
                }
            }

            //Delete Form Field
            $('button.question-delete').on('click', function () {
                var $button = $(this);

                var data = {
                    form: $button.data('form'),
                    form_field: $button.data('formField'),
                    _token: csrf_token,
                };

                $.ajax({
                    url: '{{ route('forms.fields.destroy', $form->code) }}',
                    type: 'POST',
                    data: data,
                    dataType: 'json'
                })
                .done(function (response) {
                    if (response.success) {
                        var template = $button.closest('.template');

                        template.fadeOut('slow', function() {
                            if (template.closest('.filled').length) {
                                template.closest('.filled').remove();
                            } else {
                                template.remove();
                            }
                        });

                        if ($questions.children().length === 1) {
                            fields = {};
                            $('form .submit').addClass('hidden');
                        }
                    } else {
                        showError(response.error);
                    }
                });
            });
        }

        function prepareFormTemplatesWithFieldData(fields, template_divs) {
            template_divs.each(function (index) {
                var field_id = $(this).data('id');
                var field_attribute = $(this).data('attribute');
                var field_data = fields[field_attribute];
                var template = $(this).find('.template');

                template.find('input.question-name').attr({
                    name: field_data['attribute'] + '.question',
                    id: field_data['attribute'] + '.question',
                    value: field_data['question']
                });

                template.find('input.question-required').attr({
                    name: field_data['attribute'] + '.required',
                    id: field_data['attribute'] + '.required'
                });

                if (field_data.hasOwnProperty('options')) {
                    var field_options = field_data['options'];

                    if (template.hasClass('linear-scale')) {
                        var selects = template.find('select.question-option');
                        var inputs = template.find('input.question-option-label');

                        selects.each(function(index, element) {
                            var select = $(element);
                            var name = select.hasClass('min') ? 'minvalue' : 'maxvalue';
                            var select_value = null;
                            if (field_options !== null) {
                                select_value = select.hasClass('min') ? field_options['min']['value'] : field_options['max']['value'];
                            }

                            select.attr({
                                name: field_data['attribute'] + '.' + name,
                                id: field_data['attribute'] + '.' + name,
                            });

                            select.find('option').prop('selected', false);
                            select.find('option').removeAttr('selected');

                            var selected_option = 'option[value=' + select_value + ']';
                            select.find(selected_option).prop('selected', true);
                            select.find(selected_option).attr('selected', 'selected');

                            var labels = select.closest('.panel-body').find('.select-labels');
                            var label_span = labels.find(select.hasClass('min') ? '.min-value' : '.max-value');
                            label_span.text(select.find("option:selected").val() + '.');
                        });

                        inputs.each(function(index, element) {
                            var input = $(element);
                            var name = input.hasClass('min') ? 'minlabel' : 'maxlabel';
                            var input_value = null;
                            if (field_options !== null) {
                                input_value = input.hasClass('min') ? field_options['min']['label'] : field_options['max']['label'];
                            }

                            input.attr({
                                name: field_data['attribute'] + '.' + name,
                                id: field_data['attribute'] + '.' + name,
                                value: input_value
                            });
                        });
                    } else {
                        var first_option = (field_options !== null) ? field_options.shift() : null;
                        template.find('input.question-option').attr({
                            name: field_data['attribute'] + '.options[]',
                            id: field_data['attribute'] + '.options',
                            value: first_option
                        });

                        if (field_options !== null && field_options.length > 0) {
                            for (var i = 0; i < field_options.length; i++) {
                                var options_wrapper = template.find('div.options-wrapper');
                                var new_option = options_wrapper.find('.hidden').clone().removeClass('hidden');
                                var count = i + 2;
                                var sn_span = new_option.find('.sn');

                                if (sn_span.length) {
                                    sn_span.data('sn', count);
                                    sn_span.text(count + '.');
                                }

                                new_option.find('input').prop('disabled', false);
                                new_option.find('input').removeAttr('disabled');
                                new_option.find('input').attr('placeholder', 'Option ' + count);
                                new_option.find('input').attr('value', field_options[i]);

                                options_wrapper.append(new_option);
                            }
                        }
                    }
                }

                template.find('button.question-delete').attr({
                    "data-form": form,
                    "data-form-field": field_id
                });

                if (field_data['required'] == true || field_data['required'] === null) {
                    template.find('input.question-required').prop('checked', true);
                    template.find('input.question-required').attr('checked', 'checked');
                } else {
                    template.find('input.question-required').prop('checked', false);
                    template.find('input.question-required').removeAttr('checked');
                }
            });
        }

        function saveForm(form, successCallback, failedCallback) {
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
                    successCallback($form);
                } else {
                    failedCallback(response.error);
                }
            });
        }

        function showError(error) {
            message = 'Error occured: ' + error;
            notify('error', message);
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
