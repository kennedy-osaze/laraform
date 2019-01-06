<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        $user_data = [];
        if ($request->has('code')) {
            $user = User::where('email_token', $request->code)->first();
            abort_if(!$user, 404);

            $user_data = ['code' => $request->code, 'email' => $user->email];
        }

        return view('auth.register', compact('user_data'));
    }

    public function register(Request $request)
    {
        $has_code = $request->has('code');
        if ($has_code) {
            $user = User::where('email_token', $request->code)->first();
            abort_if(!$user, 404);
        }

        $this->validator($request->all(), $has_code)->validate();

        if ($has_code) {
            $this->updateUser($user, $request->all());

            auth()->login($user);

            return redirect()->route('forms.index');
        }

        $user = $this->create($request->all());
        $user->sendEmailVerificationNotification();

        return view('auth.register-complete', compact('user'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $ignore_email = false)
    {
        $rules = [
            'first_name' => ['required', 'string', 'min:3', 'max:100'],
            'last_name' => ['required', 'string', 'min:3', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        if (!$ignore_email) {
            $rules['email'] = ['required', 'string', 'email', 'max:190', 'unique:users,email,null,id,deleted_at,null'];
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => ucwords($data['first_name'], '- '),
            'last_name' => ucwords($data['last_name'], '- '),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_token' => str_random(64),
        ]);
    }

    protected function updateUser(User $user, array $data)
    {
        $user->first_name = ucwords($data['first_name'], '- ');
        $user->last_name = ucwords($data['last_name'], '- ');
        $user->password = Hash::make($data['password']);
        $user->email_token = null;

        $user->save();
    }
}
