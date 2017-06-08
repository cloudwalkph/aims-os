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
                    <li class="active">
                        <i class="fa fa-file-text-o"></i> Official Business/OB Lists
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jane Doe</td>
                            <td>Setup</td>
                            <td>June 15, 2017</td>
                            <td>pending</td>
                            <td>
                                <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Approve</button>
                                <button type="button" class="btn btn-danger"><i class="fa fa-remove"></i> Reject</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
