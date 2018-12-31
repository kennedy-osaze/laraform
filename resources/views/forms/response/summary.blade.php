@php
    $data_for_chart = [];
    $fields = $form->fields;
    $template_alias_no_options = get_form_templates()->where('attribute_type', 'string')->pluck('alias')->all();
@endphp

<div class="panel panel-body">
    @foreach ($fields as $field)
        @php
            $responses = $field->responses;
            $responses_count = $responses->where('answer', '!==', null)->count();
        @endphp
        <div class="row">
            <div class="col-md-12">
                <label class="label-xlg">{{ $field->question }}
                    @if ($field->required) <span class="text-danger">*</span> @endif
                </label>
                <p>{{ $responses_count }} {{ str_plural('response', $responses_count) }}</p>

                @if (in_array($field->template, $template_alias_no_options))
                    <div class="table-responsive">
                        <table class="table table-striped-info table-xxs table-framed-info">
                            @foreach ($responses as $response)
                                @if ($loop->index === 10)
                                    <tr><strong>Check the individual responses for more information</strong></tr>
                                    @break
                                @endif
                                <tr>
                                    @php $answer = $response->getAnswerForTemplate($field->template); @endphp
                                    <td>{!! $answer !!}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @else
                    @php $response_for_chart = $field->getResponseSummaryDataForChart(); @endphp
                    @if (!empty($response_for_chart))
                        @php $data_for_chart[] = $response_for_chart; @endphp

                        <div class="chart-container{{ ($response_for_chart['chart'] == 'pie_chart') ? ' text-center' : '' }}">
                            <div class="{{ ($response_for_chart['chart'] == 'pie_chart') ? 'display-inline-block' : 'chart' }}" id="{{ $response_for_chart['name'] }}"></div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        @if (!$loop->last)
            <hr>
        @endif
    @endforeach
</div>

@push('script')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('assets/js/custom/pages/response-summary.js') }}"></script>
    <script>
        google.charts.load('current', {'packages':['corechart']});

        var data_for_chart = {!! json_encode($data_for_chart) !!};

        if (typeof data_for_chart === 'object' && data_for_chart instanceof Array && data_for_chart.length) {
            google.charts.setOnLoadCallback(function () {
                drawCharts(data_for_chart);
            });
        }

        $(function () {
            // Resize chart on sidebar width change and window resize
            $(window).on('resize', function () {
                drawCharts(data_for_chart);
            });
        });
    </script>
@endpush
