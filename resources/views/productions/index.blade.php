@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Productions<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Productions Department
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
                            <i class="fa fa-tasks"></i>
                        </div>
                        <div class="text">
                            <label class="text-muted">Work in Progress Lists</label>
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
                            <i class="fa fa-clipboard"></i>
                        </div>
                        <div class="text">
                            <label class="text-muted">Templates</label>
                        </div>
                        <div class="options">
                            <a href="#" class="btn btn-primary btn-lg">Download Templates</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/validate">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-file-text-o"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Job Orders Lists</label>
                            </div>
                            <div class="options">
                                <a href="/productions/jo" class="btn btn-primary btn-lg">View JOs</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/validate">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-clipboard"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Validate</label>
                            </div>
                            <div class="options">
                                <a href="/validate" style="color: #fff;background-color: #2579a9;border-color: #1f648b;" class="btn btn-lg">View Lists</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection
