@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
@endsection

@section('content')
    <div class="row">

        <admin-scheduler></admin-scheduler>

    </div>
@endsection