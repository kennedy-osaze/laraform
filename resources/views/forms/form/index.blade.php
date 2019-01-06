@section('title', 'My Forms')

@extends('layouts.app')

@section('content')

    <div class="panel panel-flat border-left-xlg border-left-primary">
        <div class="panel-heading">
            <h4 class="panel-title text-semibold">My Forms</h4>
            <div class="heading-elements">
                <a href="{{ route('forms.create') }}" class="btn btn-success heading-btn">Create a Form</a>
            </div>
        </div>
    </div>

    @include('partials.alert', ['name' => 'index'])

    <div class="panel panel-flat">
        @if ($forms->isEmpty())
            <div class="panel-body text-center">
                <div class="mt-30 mb-30">
                    <h6 class="text-semibold">You are yet to create any form</h6>
                </div>
            </div>
        @else
            <table class="table datatable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Form Title</th>
                        <th class="text-center">Date Created</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $symbols = App\Form::getStatusSymbols() @endphp
                    @foreach ($forms as $form)
                        @php
                            $symbol = $symbols[$form->status];
                            $role_symbol = ($form->user_id === $current_user->id) ? ['role' => 'Owner', 'color' => 'success'] : ['role' => 'Collaborator', 'color' => 'primary'];
                        @endphp
                        <tr>
                            <td></td>
                            <td>{{ $form->title }}</td>
                            <td class="text-center">{{ $form->created_at->format('jS F, Y') }}</td>
                            <td class="text-center"><span class="label label-flat border-{{ $role_symbol['color'] }} text-{{ $role_symbol['color'] }}-600">{{ $role_symbol['role'] }}</span></td>
                            <td class="text-center"><span class="label bg-{{ $symbol['color'] }}">{{ $symbol['label'] }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('forms.show', $form->code) }}" class="btn btn-xs btn-default mb-5">View</a>
                                <a href="{{ route('forms.edit', $form->code) }}" class="btn btn-xs btn-primary mb-5 position-right">Edit</a>
                                <a href="{{ route('forms.destroy', $form->code) }}" class="btn btn-xs btn-danger mb-5 position-right" data-id="{{ $form->code }}" data-method="delete" data-item="form" data-ajax="true">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

@section('plugin-scripts')
	<script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/custom/pages/datatable.js') }}"></script>
    <script>
        $(function() {
            $('.datatable').DataTable({
                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                columnDefs: [
                    {
                        className: 'control',
                        orderable: false,
                        targets:   0
                    },
                    {
                        orderable: false,
                        targets: [-1]
                    },
                    { responsivePriority: 1, targets: 0 },
                ],
            });

            // Enable Select2 select for the length option
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity,
                width: 'auto'
            });
        });
    </script>
@endsection
