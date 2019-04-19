@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<form id="login" method="post" action="{{ route('login') }}" autocomplete="off">
    @csrf
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-body">
                <div class="text-center">
                    <h5 class="content-group-lg">Login to your account <small class="display-block">Enter your credentials</small></h5>
                </div>

                @include('partials.alert', ['name' => 'login', 'forced_alert' => ($errors->has('email')) ? ['status' => 'danger', 'message' => $errors->first('email')] : null])

                <div class="form-group has-feedback has-feedback-left">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                    <div class="form-control-feedback">
                        <i class="icon-mail5 text-muted"></i>
                    </div>
                </div>

                <div class="form-group has-feedback has-feedback-left">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>

                <div class="form-group login-options">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" name="remember" checked="checked">
                                Remember me
                            </label>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn bg-teal btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
                </div>

                <div class="content-divider text-muted form-group"><span>Don't have an account?</span></div>

                <a href="{{ route('register') }}" class="btn btn-default btn-block content-group">Create Account</a>
            </div>
        </div>
    </div>
</form>
@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/validation/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/uniform.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/custom/pages/validation.js') }}"></script>
    <script src="{{ asset('assets/js/custom/pages/auth.js') }}"></script>
@endsection
