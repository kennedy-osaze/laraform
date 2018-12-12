@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

<form id="password-reset" method="post" action="{{ route('password.request') }}" autocomplete="off">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-body">
                <div class="text-center">
                    <div class="icon-object border-warning text-warning"><i class="icon-reset"></i></div>
                    <h5 class="content-group">Password Reset <small class="display-block">Go ahead to reset your password</small></h5>
                </div>

                <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" class="form-control" id="email" name="email" value="{{ $email || old('email') }}" placeholder="Email Address" required>
                    <div class="form-control-feedback">
                        <i class="icon-mail5 text-muted"></i>
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your new password" required>
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter password" required>
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn bg-success btn-block">Reset Password <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
    </div>
</form>

@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/validation/validate.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/custom/pages/validation.js') }}"></script>
    <script src="{{ asset('assets/js/custom/pages/auth-passwords-reset.js') }}"></script>
@endsection
