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
                    <li>
                        <a href="/operations"><i class="fa fa-dashboard"></i> Operations Department</a>
                    </li>
                    <li>
                        <a href="/operations/job-orders"><i class="fa fa-file-text-o"></i> Job Order Lists</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-list-ul"></i> Job Order Details
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                            <span class="pull-right">
                                <button type="button" class="btn btn-default">
                                    <i class="fa fa-file-text"></i> Upload Attachments
                                </button> &nbsp;
                                <button class="btn btn-default" onclick="frames['frame'].print();">
                                    <i class="fa fa-print fa-lg"></i> Print
                                </button>

                            </span>

                        <h5> <b>Project Name: {{ $jo->project_name }}</b> </h5>
                        <h5> <b>Job Order Number: {{ $jo->job_order_no }}</b> </h5>
                        <h5> <strong>Date Created: {{ \Carbon\Carbon::createFromTimestamp(strtotime($jo->created_at))->toFormattedDateString() }}</strong> </h5>

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="col-md-12 col-xs-12">
                                    <h5><strong>Client:</strong> {{ $jo->clients->implode('client.company', ', ') }}</h5>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <h5><strong>AE Name:</strong> {{ $jo->user->profile->full_name }}</h5>
                                </div>

                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="col-md-12 col-xs-12">
                                    <h5><strong>Project Type:</strong> {{ $jo->project_type }}</h5>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <h5><strong>Brand:</strong> {{ collect($brands)->implode(', ') }}</h5>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="col-md-12 col-xs-12">
                                    <h5><strong>D.O. Number:</strong>{{ isset($jo->do_contract_no) ? $jo->do_contract_no : 'N/A' }}</h5>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="col-md-12 col-xs-12">
                                    <h5><strong>Invoice Number:</strong> N/A</h5>
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <h5><strong>Paid Date:</strong>N/A</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-pills">
                        <li class="{{ Request::is('*/'.$jo->job_order_no) ? 'active' : '' }}"><a href="/activations/job-orders/{{ $jo->job_order_no }}">Job Order Details</a></li>
                        <li class="{{ Request::is('*/discussions') ? 'active' : '' }}"><a href="/activations/job-orders/{{ $jo->job_order_no }}/discussions">Discussions</a></li>
                    </ul>
                    <hr>
                    @yield('jo-details-content')
                </div>
            </div>
        </div>
    </div>

    <iframe src="/ae/jo/details/{{ $jo->id }}/preview" name="frame" id="joFrame" style="width: 0; height: 0"></iframe>
@endsection
