<?php

namespace App\Exports;

use App\Form;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class FormResponseExport implements FromView
{
    public $form;

    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    public function view(): View
    {
        $responses = $this->form->responses()->has('fieldResponses')->get(['id', 'created_at']);
        $fields = $this->form->fields()->with('responses')->get();

        return view('exports.response', compact('fields', 'responses'));
    }
}
