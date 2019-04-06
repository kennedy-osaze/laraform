<button class="btn btn-xs btn-success">Menu</button>
<button class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
<ul class="dropdown-menu dropdown-menu-right">
    <li class="dropdown-header highlight"><i class="icon-menu7"></i> <i class="icon-share3 pull-right"></i> Share</li>
    @if ($form->status === $form::STATUS_OPEN)
        <li><a data-toggle="modal" data-target="#share-form" data-backdrop="static" data-keyboard="false">Share Form</a></li>
    @endif

    @if ($form->user_id === $current_user->id)
        <li><a data-toggle="modal" data-target="#form-collaborate" data-backdrop="static" data-keyboard="false">Form Collaborators</a></li>
    @endif

    @if (in_array($form->status, [$form::STATUS_OPEN, $form::STATUS_CLOSED]))
        <li class="dropdown-header highlight"><i class="icon-menu7"></i> <i class="icon-menu6 pull-right"></i> Responses</li>
        @if (Route::currentRouteName() !== 'forms.responses.index')
            <li><a href="{{ route('forms.responses.index', $form->code) }}">View Responses</a></li>
        @endif
        @if ($form->responses()->has('fieldResponses')->exists())
            <li><a id="delete-button" data-href="{{ route('forms.responses.destroy.all', $form->code) }}" data-message="Are your sure you want to delete all the responses for this form?">Delete all Responses</a></li>
            <li><a href="{{ route('forms.response.export', $form->code) }}">Download Responses as Spreadsheet</a></li>
        @endif
    @endif

    <li class="dropdown-header highlight"><i class="icon-menu7"></i> <i class="icon-gear pull-right"></i> Form Menu</li>
    <li><a data-toggle="modal" data-target="#form-availability" data-backdrop="static" data-keyboard="false">Form Availability Settings</a></li>
    @if (Route::currentRouteName() !== 'forms.show')
        <li><a href="{{ route('forms.show', $form->code) }}">View Form Template</a></li>
    @endif

    @if (in_array($form->status, [$form::STATUS_PENDING, $form::STATUS_CLOSED]))
        <li><a href="{{ route('forms.open', $form->code) }}" data-method="post">Open Form for Response</a></li>
    @endif
    @if ($form->status === $form::STATUS_OPEN)
        <li><a href="{{ route('forms.close', $form->code) }}" data-method="post">Close Form to Response</a></li>
    @endif

    <li class="divider"></li>

    {{-- @if ($form->user_id === $current_user->id)
        <li><a href="#">Form Settings</a></li>
    @endif --}}

    <li><a href="{{ route('forms.edit', $form->code) }}">Edit Form</a></li>
    @if ($form->status !== $form::STATUS_OPEN)
        <li><a id="delete-button" data-href="{{ route('forms.destroy', $form->code) }}" data-item="form - {{ $form->title }}">Delete Form</a></li>
    @endif
    <li><a href="{{ route('forms.index') }}">All Forms</a></li>
</ul>
