@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    CMTUVA<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/creatives"><i class="fa fa-dashboard"></i> CMTUVA Department</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-calendar"></i> Schedules
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}


            <scheduler></scheduler>
        </div>
    </div>
@endsection
