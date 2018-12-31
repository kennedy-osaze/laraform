$(function() {
	window.csrf_token = csrfToken();

	var $initiator = null;

	$('.greeting').text(getGreeting());

	$(document).on("click", "#delete-button", function() {
		var $link = $('<a>');
		var href = $(this).data('href');
		var	item = $(this).data('item');
		var message = $(this).data('message');

		message = (message && message.length) ? message : 'Are you sure you want to delete the ' + item + '?';

		bootbox.confirm({
			message: message,
		    buttons: {
		        confirm: {
		            label: 'Yes',
		        },
		        cancel: {
		            label: 'No',
		        }
		    },
		    callback: function (result) {
		    	if (result) {
		    		$link.attr({
		    			href: href,
		    			id: "delete-item",
		    			"data-method": 'delete',
		    			"data-ajax": false,
		    			"data-item": item
		    		});

		    		$link.text(item);
		    		$link.hide().appendTo('body');
		    		$link[0].click();
		    	}
		    }
		});
	});

	// $('a[href="javascript:void(0)"]').click(function() {
	// 	$.ajax({
	// 		url: route,
	// 		type: 'POST',
	// 		dataType: 'json',
	// 		data: data_serialized,
	// 	})
	// 	.done(function (response) {
	// 		$(this).find('.no-click').addClass("text-muted");
	// 	});
	// });

	$(document).on('click', 'a[href]', function (e) {
		var method = $(this).data('method');

		if (method) {
			$initiator = $(this);
			e.preventDefault();
			var $form = $('<form>'),
				action = $(this).attr('href'),
				target = $(this).attr('target'),
				ajax_enabled = $(this).data('ajax');
				item_name = $(this).data('item');

			if (!action || !action.match(/(^\/|:\/\/)/i)) {
				action = window.location.href;
			}

			if (target) {
				$form.attr('target', target);
			}

			if (!method.match(/(get|post)/i)) {
				$form.append($('<input>', {type: 'hidden', name: '_method', value: method.toUpperCase()}));
				method = 'POST';
			}

			if (!method.match(/(get|head|option)/i)) {
				var csrf_token = csrfToken();
				if (csrf_token) {
					$form.append($('<input>', {type: 'hidden', name: '_token', value: csrf_token}));
				}
			}
			$form.attr('method', method);
			$form.attr('action', action);
			$form.attr('id', item_name);

			$form.hide().appendTo('body');

			var form_action_class = (ajax_enabled == true) ? 'action-by-ajax' : 'action-default';
			$form.addClass(form_action_class);

            $form.trigger('submit');
		}
	});

	$(document).on("submit", "form.action-by-ajax", function(e) {
		e.preventDefault();
		var data_serialized = $(this).serialize(),
			route = $(this).attr('action')
			parent_row = $initiator.closest('tr');

		bootbox.confirm({
			message: 'Are you sure you want to delete this ' + $('form.action-by-ajax').attr('id') + '?',
		    buttons: {
		        confirm: {
		            label: 'Yes',
		        },
		        cancel: {
		            label: 'No',
		        }
		    },
		    callback: function (result) {
		    	if (result) {
					$.ajax({
						url: route,
						type: 'POST',
						dataType: 'json',
						data: data_serialized,
					})
					.done(function (response) {
						if (response.success) {
							parent_row.fadeOut('slow');

							var next_row = parent_row.next();
							if (next_row.attr('class') == 'child') {
								next_row.fadeOut('fast');
							}
						} else {
			                noty({
			                    width: 200,
			                    text: 'Error occurred: ' + response.error,
			                    type: 'error',
			                    dismissQueue: true,
			                    timeout: 6000,
			                    layout: 'top',
			                    buttons: false
			                });
						}
					});
		    	}
		    },
		});
	});

	$('#flash').delay(6000).fadeOut('slow', function() {
        $('#flash').remove();
	});

	//functions
	function csrfToken() {
		return $('meta[name="csrf-token"]').attr('content');
	}

	function getGreeting() {
		var today = new Date()
		var curHr = today.getHours()

		if (curHr < 12) {
		  return 'Good Morning';
		} else if (curHr < 18) {
		  return 'Good Afternoon';
		} else {
		  return 'Good Evening';
		}
	}
});
