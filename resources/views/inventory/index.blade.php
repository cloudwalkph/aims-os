@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Inventory<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Inventory Department
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="button-menu">
                    <div class="hero-widget well well-sm">
                        <div class="icon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <div class="text">
                            <label class="text-muted">Calendar</label>
                        </div>
                        <div class="options">
                            <a href="#" class="btn btn-primary btn-lg">Schedules</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="button-menu">
                    <div class="hero-widget well well-sm">
                        <div class="icon">
                            <i class="fa fa-shopping-basket"></i>
                        </div>
                        <div class="text">
                            <label class="text-muted">JO Product List</label>
                        </div>
                        <div class="options">
                            <a href="#" class="btn btn-primary btn-lg">JO Product List</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="button-menu">
                    <div class="hero-widget well well-sm">
                        <div class="icon">
                            <i class="fa fa-archive"></i>
                        </div>
                        <div class="text">
                            <label class="text-muted">On-going projects list</label>
                        </div>
                        <div class="options">
                            <a href="#" class="btn btn-primary btn-lg">View Projects</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="button-menu">
                    <div class="hero-widget well well-sm">
                        <div class="icon">
                            <i class="fa fa-tasks"></i>
                        </div>
                        <div class="text">
                            <label class="text-muted">Work in Progress</label>
                        </div>
                        <div class="options">
                            <a href="#" class="btn btn-primary btn-lg">Work in Progress</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="button-menu">
                    <div class="hero-widget well well-sm">
                        <div class="icon">
                            <i class="fa fa-th-list"></i>
                        </div>
                        <div class="text">
                            <label class="text-muted">Internal Inventory List</label>
                        </div>
                        <div class="options">
                            <a href="#" class="btn btn-primary btn-lg">Inventory List</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
