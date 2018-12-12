@php
    $module = $page = 'My Forms';
    $breadcrumbs[] = $page;

    $page_data = [
        'module' => ['icon' => 'icon-pencil7', 'name' => $module],
        'breadcrumbs' => $breadcrumbs
    ];

    $current_user = auth()->user();
@endphp

@section('title', $module)

@extends('layouts.app', $page_data)

@section('content')
@include('partials.alert', ['name' => 'index'])

Hello World
@endsection
