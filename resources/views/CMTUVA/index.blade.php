@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    CMTUVA<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> CMTUVA Department
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/cmtuva/schedules">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Calendar</label>
                            </div>
                            <div class="options">
                                <a href="/cmtuva/schedules" class="btn btn-primary btn-lg">Schedules</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/cmtuva/venues">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Venues List</label>
                            </div>
                            <div class="options">
                                <a href="/cmtuva/venues" class="btn btn-primary btn-lg">Add Venue</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/cmtuva/plans">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Plans List</label>
                            </div>
                            <div class="options">
                                <a href="/cmtuva/plans" class="btn btn-primary btn-lg">Create Plans</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection
