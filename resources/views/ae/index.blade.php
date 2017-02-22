@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Accounts Executive<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> AE Department
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/ae/schedules">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Calendar</label>
                            </div>
                            <div class="options">
                                <a href="/ae/schedules" class="btn btn-primary btn-lg">Schedules</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/ae/clients">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-address-book-o"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Client List</label>
                            </div>
                            <div class="options">
                                <a href="/ae/clients" class="btn btn-primary btn-lg">Add Clients</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/ae/jo/create">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-pencil-square-o"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Create Job Order</label>
                            </div>
                            <div class="options">
                                <a href="/ae/jo/create" class="btn btn-primary btn-lg">Create JO</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/ae/jo">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-file-text-o"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Job Orders Lists</label>
                            </div>
                            <div class="options">
                                <a href="/ae/jo" class="btn btn-primary btn-lg">View JOs</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/ae/references">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-clipboard"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Reference Lists</label>
                            </div>
                            <div class="options">
                                <a href="/ae/references" class="btn btn-primary btn-lg">Download References</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        </div>
    </div>
@endsection
