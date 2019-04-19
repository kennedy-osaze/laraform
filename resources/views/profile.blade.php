@section('title', 'My Profile')

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 mt-20">
            @include('partials.alert', ['name' => 'index'])

            <div class="panel panel-flat border-top-primary border-top-lg">
                <div class="panel-heading">
                    <h5 class="panel-title text-semibold">My Profile</h5>
                    <div class="heading-elements">
                        <a href="{{ route('forms.index') }}" class="btn btn-success heading-btn">My Forms</a>
                    </div>
                </div>

                <div class="panel-body">
                    <form id="update-profile-form" action="{{ route('profile.update') }}" method="post">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" class="form-control" name="email" value="{{ $current_user->email }}" disabled>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="first_name">First Name</label>
                                    <input type="first_name" id="first_name" class="form-control" name="first_name" value="{{ old('first_name') ?? $current_user->first_name }}" required>
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="last_name">Last Name</label>
                                    <input type="last_name" id="last_name" class="form-control" name="last_name" value="{{ old('last_name') ?? $current_user->last_name }}" required>
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" id="submit" class="btn mt-20 btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/validation/additional-methods.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/custom/pages/validation.js') }}"></script>

    <script>
        $(function() {
            $('#update-profile-form').validate({
                rules: {
                    first_name: {
                        required: true,
                        maxlength: 100,
                        minlength: 3
                    },
                    last_name: {
                        required: true,
                        maxlength: 100,
                        minlength: 3,
                    },
                },
                messages: {
                    first_name: {
                        'required': 'Your first name is required'
                    },
                    last_name: {
                        'required': 'Your last name is required'
                    },
                },
            });
        });
    </script>
@endsection
