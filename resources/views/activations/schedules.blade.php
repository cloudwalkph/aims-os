@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Project Manager<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/activations"><i class="fa fa-dashboard"></i> Project Manager Department</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-calendar"></i> Schedules
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}


            <ops-scheduler></ops-scheduler>
        </div>
    </div>
@endsection
