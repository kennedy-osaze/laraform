<?php

namespace App\Http\Controllers\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResponseController extends Controller
{
    public function index(Form $form)
    {
        dd($form);
    }

    public function store(Request $request, Form $form)
    {
        dd($form);
    }

    public function show(Form $form, $response)
    {
        dd($form);
    }
}
