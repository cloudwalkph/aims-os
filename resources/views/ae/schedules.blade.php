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
                    Accounting Executive<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> AE Department
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}


            <scheduler></scheduler>
        </div>
    </div>
@endsection
