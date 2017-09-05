@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                <inventory :current-user="{{ json_encode(Auth::user()) }}"></inventory>

            </div>
        </div>
    </div>
@endsection
