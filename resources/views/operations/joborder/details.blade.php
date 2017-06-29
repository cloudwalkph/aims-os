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
                                <button class="btn btn-default" onclick="frames['frame'].print();">
                                    <i class="fa fa-print fa-lg"></i> Print
                                </button> &nbsp;
                                <button type="button" class="btn btn-primary"
                                        data-toggle="modal" data-target="#assignPM">
                                    <i class="fa fa-plus"></i> Assign Project Manager
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

                @if (session('status'))
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('status') }}
                    </div>
                @endif

                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($assigned as $user)
                            <tr>
                                <td>{{ $user->user_name }}</td>
                                <td>{{ $user->department }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-remove"></i> Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @include('components.jo_details')

        </div>
    </div>

    <div class="modal fade" id="assignPM" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Project Manager</h4>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <div class="row">
                            {{ csrf_field() }}

                            <div class="col-md-12 form-group">
                                <label class="control-label" for="user_id">Users</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ ucwords($user->profile->full_name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <iframe src="/ae/jo/details/{{ $jo->id }}/preview" name="frame" id="joFrame" style="width: 0; height: 0"></iframe>
@endsection
