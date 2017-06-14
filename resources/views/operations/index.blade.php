@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Operations<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Operations Department
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/operations/inventory">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-cubes"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Inventory</label>
                            </div>
                            <div class="options">
                                <a href="/operations/inventory" class="btn btn-primary btn-lg">View more...</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/operations/production">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Production</label>
                            </div>
                            <div class="options">
                                <a href="/operations/production" class="btn btn-primary btn-lg">View more...</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/operations/setup">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-wrench"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Setup</label>
                            </div>
                            <div class="options">
                                <a href="/operations/setup" class="btn btn-primary btn-lg">View more...</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/operations/activations">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-sitemap"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Activations</label>
                            </div>
                            <div class="options">
                                <a href="/operations/activations" class="btn btn-primary btn-lg">View more...</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
