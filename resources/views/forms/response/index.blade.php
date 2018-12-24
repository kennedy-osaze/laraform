@php
    $page = "{$form->title} - Response";
    $response_count = $form->responses()->has('fieldResponses')->count();
    $response_type_shown_is_summary = ($query === 'summary');
@endphp

@extends('layouts.app')

@section('title', "My Form | {$page}")

@section('content')

@include('partials.alert', ['name' => 'index'])

<div class="panel panel-flat">
    <div class="panel-heading">
        @php $symbol = $form::getStatusSymbols()[$form->status]; @endphp
        <h5 class="panel-title">{{ $page }} <span class="label bg-{{ $symbol['color'] }} position-left">{{ $symbol['label'] }}</span></h5>
        <div class="heading-elements">
            <div class="btn-group heading-btn">
                <button class="btn btn-xs btn-success">Menu</button>
                <button class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right">
                    @if ($form->status === $form::STATUS_OPEN)
                        <li><a href="#">Share Form</a></li>
                    @endif
                    @if (in_array($form->status, [$form::STATUS_PENDING, $form::STATUS_CLOSED]))
                        <li><a href="{{ route('forms.open', $form->code) }}" data-method="post">Open Form for Response</a></li>
                    @endif
                    @if ($form->status === $form::STATUS_OPEN)
                        <li><a href="{{ route('forms.close', $form->code) }}" data-method="post">Close Form to Response</a></li>
                    @endif
                    @if (in_array($form->status, [$form::STATUS_OPEN, $form::STATUS_CLOSED]))
                        <li><a href="{{ route('forms.responses.index', $form->code) }}">View Responses</a></li>
                    @endif
                    @if ($response_count)
                        <li class="divider"></li>
                        <li><a href="javascript:void(0)" id="delete-button" data-href="{{ route('forms.responses.destroy.all', $form->code) }}" data-message="Are your sure you want to delete all the responses for this form?">Delete all Responses</a></li>

                        <li><a href="{{ route('forms.response.export', $form->code) }}">Download Responses as Spreadsheet</a></li>
                    @endif
                    @if (in_array($form->status, [$form::STATUS_OPEN, $form::STATUS_CLOSED, $form::STATUS_PENDING]))
                        <li class="divider"></li>
                    @endif
                    <li><a href="{{ route('forms.edit', $form->code) }}">Edit</a></li>
                    @if ($form->status !== $form::STATUS_OPEN)
                        <li><a href="javascript:void(0)" id="delete-button" data-href="{{ route('forms.destroy', $form->code) }}" data-item="form - {{ $form->title }}">Delete</a></li>
                    @endif
                    <li><a href="{{ route('forms.index') }}">All Forms</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="panel-body">
		{!! str_convert_line_breaks($form->description) !!}
    </div>
</div>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ $response_count . ' ' . str_plural('Response', $response_count) }}</h5>
        <div class="heading-elements">
            <div class="heading-btn">
                <a href="{{ route('forms.responses.index', $form->code) }}" class="btn {{ ($response_type_shown_is_summary) ? 'bg-teal' : 'btn-default' }}">Summary</a>
                <a href="{{ route('forms.responses.index', [$form->code, 'type' => 'individual']) }}" class="btn {{ (!$response_type_shown_is_summary) ? 'bg-teal' : 'btn-default' }}">Individual</a>
            </div>
        </div>
    </div>
</div>

{{-- @php $include_boolean = ($response_type_shown_is_summary) ? ($form->fields()->exists() && $response_count) : $response_count @endphp --}}
@includeWhen((bool) $response_count, "forms.response.{$query}")

@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
@endsection
