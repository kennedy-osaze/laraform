@php
    $page = "{$form->title} - Response";
    $response_count = $form->responses()->has('fieldResponses')->count();
    $response_type_shown_is_summary = ($query === 'summary');

    $current_user = auth()->user();
@endphp

@extends('layouts.app')

@section('plugin-css')
    @stack('styles')
@endsection

@section('title', "My Form | {$page}")

@section('content')

@include('partials.alert', ['name' => 'index'])

<div class="panel panel-flat">
    <div class="panel-heading">
        @php $symbol = $form::getStatusSymbols()[$form->status]; @endphp
        <h5 class="panel-title">{{ $page }} <span class="label bg-{{ $symbol['color'] }} position-left">{{ $symbol['label'] }}</span></h5>
        <div class="heading-elements">
            <div class="btn-group heading-btn">
                @include('forms.partials._form-menu')
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

@includeWhen($response_count, "forms.response.{$query}")

@includeWhen(($form->status === $form::STATUS_OPEN), 'forms.partials._form-share')

@includeWhen(($form->user_id !== $current_user->id), 'forms.partials._form-collaborate')

@include('forms.partials._form_availability')
@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/noty.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/uniform.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/autosize.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/validation/additional-methods.min.js') }}"></script>
@endsection

@section('page-script')
    @stack('script')

    <script>
        $(function () {
            autosize($('.elastic'));

            $('.tags-input').tagsinput({
                maxTags: 20,
                maxChars: 255,
                trimValue: true,
                tagClass: function(item){
                    return 'label bg-teal';
                },
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
        });
    </script>
@endsection
