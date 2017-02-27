@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Creatives<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Creatives Department
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/creatives/schedules">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Calendar</label>
                            </div>
                            <div class="options">
                                <a href="/creatives/schedules" class="btn btn-primary btn-lg">Schedules</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            @if(! Auth::user()->role()->slug === 'member')
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/creatives/ongoing-projects">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-archive"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">On-Going Projects Lists</label>
                            </div>
                            <div class="options">
                                <a href="/creatives/ongoing-projects" class="btn btn-primary btn-lg">Assign Member</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/creatives/work-in-progress">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-tasks"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Work in Progress</label>
                            </div>
                            <div class="options">
                                <a href="/creatives/work-in-progress" class="btn btn-primary btn-lg">View Projects</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection
