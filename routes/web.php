<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return view('welcome'); })->name('home');

Route::namespace('Form')->group(function () {
    Route::get('form/{form}/view', 'FormController@viewForm')->name('forms.view');
    Route::post('form/{form}/submit', 'ResponseController@store')->name('forms.responses.store');
});

// Authentication Routes...
Route::namespace('Auth')->group(function () {
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register.show');
    Route::post('register', 'RegisterController@register')->name('register');

    //Login Routes
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');

    Route::post('logout', 'LoginController@logout')->name('logout');

    //User Email Verification Route
    Route::get('email/verify/{token}', 'VerificationController@verify');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
});

//Dashboard Routes
Route::middleware(['auth', 'verified'])->namespace('Form')->group(function () {
    //Form Routes
    Route::get('forms', 'FormController@index')->name('forms.index');
    Route::get('forms/create', 'FormController@create')->name('forms.create');
    Route::post('forms', 'FormController@store')->name('forms.store');
    Route::get('forms/{form}', 'FormController@show')->name('forms.show');
    Route::get('forms/{form}/edit', 'FormController@edit')->name('forms.edit');
    Route::put('forms/{form}', 'FormController@update')->name('forms.update');
    Route::delete('forms/{form}', 'FormController@destroy')->name('forms.destroy');

    Route::post('forms/{form}/draft', 'FormController@draftForm')->name('forms.draft');
    Route::get('forms/{form}/preview', 'FormController@previewForm')->name('forms.preview');
    Route::post('forms/{form}/open', 'FormController@openFormForResponse')->name('forms.open');
    Route::post('forms/{form}/close', 'FormController@closeFormToResponse')->name('forms.close');

    //Form Field Routes
    Route::post('form/{form}/fields/add', 'FieldController@store')->name('forms.fields.store');
    Route::post('form/{form}/fields/delete', 'FieldController@destroy')->name('forms.fields.destroy');

    //Form Response Routes
    Route::get('form/{form}/responses', 'ResponseController@index')->name('forms.responses.index');
    Route::post('form/{form}/responses', 'ResponseController@store')->name('forms.responses.store');
    Route::get('form/{form}/responses/{response}', 'ResponseController@show')->name('forms.responses.show');
});
