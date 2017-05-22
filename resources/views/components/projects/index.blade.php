@extends('layouts.app')

@section('scripts')
    <script>
        $(function() {
            let jobOrderId = 0;

            $('.stat-info').on('click', function() {
                window.location = $(this).data('link');
            });

            // Assign member
            $('.assign').on('click', function() {
                jobOrderId = $(this).data('jo');
                $('#job_order_id').val(jobOrderId);
            });
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Creatives<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/creatives"><i class="fa fa-dashboard"></i> Creatives Department</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-archive"></i> On-Going Projects
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">

                <button type="button" class="btn btn-primary btn-create"
                        data-toggle="modal" data-target="#ongoingModal">
                    <i class="fa fa-plus"></i> Create JOB
                </button>

                <div style="margin-top: 20px"></div>

                <div class="row">
                    <div class="stat-info stat-information col-md-2 col-sm-6 col-xs-12" data-link="/creatives/ongoing-projects">
                        <div class="stat-value">{{ $totalCount }}</div>
                        <div class="stat-title">
                            Total JOs
                        </div>
                    </div>

                    <div class="stat-info stat-success col-md-2 col-sm-6 col-xs-12" data-link="/creatives/ongoing-projects?type=assigned">
                        <div class="stat-value">{{ $assignedCount or '0'}}</div>
                        <div class="stat-title">
                            Assigned JOs
                        </div>
                    </div>

                    <div class="stat-info stat-danger col-md-2 col-sm-6 col-xs-12" data-link="/creatives/ongoing-projects?type=unassigned">
                        <div class="stat-value">{{ $totalCount - $assignedCount }}</div>
                        <div class="stat-title">
                            Unassigned JOs
                        </div>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Job Order #</th>
                            <th>Project Name</th>
                            <th>Description</th>
                            <th>Deadline</th>
                            <th>Assigned Person/s</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project['job_order_no'] }}</td>
                                <td>{{ $project['project_name'] }}</td>
                                <td>{{ $project['description'] }}</td>
                                <td>{{ $project['deadline'] }}</td>
                                <td>{{ $project['assigned_persons'] }}</td>
                                <td>
                                    <button class="btn btn-sm btn-default assign"
                                            data-toggle="modal" data-target="#ongoingModal"
                                            data-jo="{{ $project['job_order_id'] }}">

                                        <i class="fa fa-user"></i> &nbsp; Assign member
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @include('components.projects.modal')
    </div>
@endsection
