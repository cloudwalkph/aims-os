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

            <div class="col-md-9">
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
                                    <a href="/validate" class="btn btn-primary btn-lg">View Lists</a>
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

            <div class="col-md-3">
                <h3>Assigned Job Orders</h3>
                <div class="row assigned-jo">
                    @foreach ($jos as $jo)
                        <div class="col-md-12 jo-item" data-toggle="modal" data-target="#{{ $jo['job_order']['job_order_no'] }}">
                            <div class="project-name">{{ $jo['job_order']['project_name'] }}</div>

                            <div class="project-body">
                                <strong>Job Order #:</strong> {{ $jo['job_order']['job_order_no'] }} <br>
                                <strong>Deadline:</strong> {{ \Carbon\Carbon::createFromTimestamp(strtotime($jo['deadline']))->toFormattedDateString() }} <br>
                                <strong>AE: </strong> {{ $jo['job_order']['user']['profile']['first_name'] }} {{ $jo['job_order']['user']['profile']['last_name'] }} <br>
                                <strong>Status: </strong> Pending
                            </div>
                        </div>

                        <div class="modal fade" id="{{ $jo['job_order']['job_order_no'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">{{ $jo['job_order']['project_name'] }} | #{{ $jo['job_order']['job_order_no'] }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div>Deadline: {{ \Carbon\Carbon::createFromTimestamp(strtotime($jo['deadline']))->toFormattedDateString() }}</div>
                                        <div class="deliverables">
                                            <h5><strong>Deliverables</strong></h5>
                                            {{ $jo['deliverables'] }}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection
