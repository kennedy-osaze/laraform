@if (session()->has($name) || !empty($forced_alert))
	@php
		$alert = (session()->has($name)) ? session($name) : $forced_alert;
	@endphp
	<div id="flash" class="alert alert-{{ $alert['status'] }} alert-bordered" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{ $alert['message'] }}
	</div>
@endif
