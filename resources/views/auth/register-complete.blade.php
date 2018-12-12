@extends('layouts.auth')

@section('title', 'Create an Account')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-body">
                <div class="text-center">
                    <div class="icon-object border-success text-success"><i class="icon-checkmark3"></i></div>
                    <h5 class="content-group-lg">Congratulations {{ $user->first_name }}</h5>
                    <p class="content-group">
                        An account has been created for you and an email has been sent to the email address you provided. Please check it and follow the instructions contained in it.
                    </p>

                    <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
                </div>
            </div>
        </div>
    </div>
@endsection
