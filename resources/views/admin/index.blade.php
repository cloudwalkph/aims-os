@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
@endsection

@section('content')
    <div class="row">
        {{-- breadcrumb start --}}
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin<small> Department</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Admin Department
                </li>
            </ol>
        </div>
        {{-- breadcrumb end --}}

        <admin-scheduler></admin-scheduler>

    </div>
@endsection