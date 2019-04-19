<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $current_user = auth()->user();
        return view('profile', compact('current_user'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|min:3|max:100',
            'last_name' => 'required|string|min:3|max:100',
        ], [
            'first_name.required' => 'Your first name is required',
            'last_name.required' => 'Your last name is required'
        ]);

        $current_user = auth()->user();

        $current_user->first_name = $request->first_name;
        $current_user->last_name = $request->last_name;
        $current_user->save();

        session()->flash('index', [
            'status' => 'success',
            'message' => 'Your profile has been updated successfully.'
        ]);

        return redirect()->route('profile.index');
    }
}
