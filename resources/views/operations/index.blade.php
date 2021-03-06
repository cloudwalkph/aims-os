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
                <a href="/operations/1">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Production</label>
                            </div>
                            <div class="options">
                                <a href="/operations/1" class="btn btn-primary btn-lg">View more...</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/operations/2">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-paint-brush"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Creatives</label>
                            </div>
                            <div class="options">
                                <a href="/operations/2" class="btn btn-primary btn-lg">View more...</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/operations/3">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">CMTUVA</label>
                            </div>
                            <div class="options">
                                <a href="/operations/3" class="btn btn-primary btn-lg">View more...</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/operations/4">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-user-plus"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Human Resources</label>
                            </div>
                            <div class="options">
                                <a href="/operations/4" class="btn btn-primary btn-lg">View more...</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/operations/5">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-cubes"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Inventory</label>
                            </div>
                            <div class="options">
                                <a href="/operations/5" class="btn btn-primary btn-lg">View more...</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/operations/9">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-wrench"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Setup</label>
                            </div>
                            <div class="options">
                                <a href="/operations/9" class="btn btn-primary btn-lg">View more...</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="/operations/11">
                    <div class="button-menu">
                        <div class="hero-widget well well-sm">
                            <div class="icon">
                                <i class="fa fa-sitemap"></i>
                            </div>
                            <div class="text">
                                <label class="text-muted">Project Manager</label>
                            </div>
                            <div class="options">
                                <a href="/operations/11" class="btn btn-primary btn-lg">View more...</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
