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
                    <li>
                        <a href="/cmtuva"><i class="fa fa-dashboard"></i> CMTUVA Department</a>
                    </li>
                    <li>
                        <a href="/cmtuva/plans"><i class="fa fa-laptop"></i> Plans List</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-list"></i> Plan Details
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <input type="hidden" name="job_order_id" id="jobOrderId" value="{{ $jo->id }}">
                        <h5>Job Order Number: {{ $jo->job_order_no }}</h5>
                        <h5>Project Name: {{ $jo->project_name }}</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 30px">
                <plan-animation-table></plan-animation-table>
            </div>

            <div class="col-md-12">
                <hr/>
            </div>

            <div class="box box-info">
                <div class="box-body">
                    <div class="col-md-2 hide">
                        <div class="form-group">
                            <div class="col-sm-12">

                                {{--populate venues--}}
                                <select class="form-control" name="venues">
                                    <option value="">Venue</option>
                                </select>
                                {{--populate venues--}}

                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 hide">
                        <div class="form-group">
                            <div class="col-sm-12">

                                {{--populate venues--}}
                                <select class="form-control" name="venues">
                                    <option value="">Area</option>
                                </select>
                                {{--populate venues--}}

                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 hide">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select class="form-control">
                                    <option>Estimated Foot Traffic</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 hide">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select class="form-control">
                                    <option>Actual Hits</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 hide">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select class="form-control">
                                    <option>LSM</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <venues-selection-table></venues-selection-table>
                </div>
            </div>

        </div>
    </div>

    <iframe src="/cmtuva/plans/{{$jo->id}}/preview" name="frame" id="joFrame" style="width: 0; height: 0"></iframe>

@endsection
