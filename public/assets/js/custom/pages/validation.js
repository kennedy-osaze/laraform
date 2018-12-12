$(function() {
	if ($.validator != undefined) {
		$.validator.setDefaults({
			ignore: 'input[type=hidden], .select2-search__field, :hidden:not(.summernote), .note-editable.panel-body', // ignore hidden fields
			// errorElement: "span",
			submitHandler: function (form) {
				form.submit();
			},
			errorPlacement: function (error, element ) {
				error.addClass("help-block");
	            // Styled checkboxes, radios, bootstrap switch
	            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
	                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
	                    error.appendTo( element.parent().parent().parent().parent() );
	                }
	                 else {
	                    error.appendTo( element.parent().parent().parent().parent().parent() );
	                }
	            }

	            //input group
				else if (element.parents('div').hasClass('input-group')) {
					error.insertAfter(element.closest('.input-group')).addClass('text-center');
				}

	            // Unstyled checkboxes, radios
	            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
	                error.appendTo( element.parent().parent().parent() );
	            }

	            // Input with icons and Select2
	            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
	                error.appendTo( element.parent() );
	            }

	            // Inline checkboxes, radios
	            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
	                error.appendTo( element.parent().parent() );
	            }

	            // Input group, styled file input
	            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
	                error.appendTo( element.parent().parent() );
	            }

	            else {
	                // error.insertAfter(element);
	                error.appendTo(element.closest('.form-group'));
	            }
			},
			highlight: function (element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).closest('.form-group').removeClass( "has-error" );
			}
		});
	}
});
