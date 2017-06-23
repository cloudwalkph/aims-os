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
                        <i class="fa fa-file-text-o"></i> Project Monitor Lists
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Job Order #</th>
                            <th>Project Title</th>
                            <th>Event Date</th>
                            <th>Project Manager</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>5261237</td>
                            <td>Project Quantum</td>
                            <td>June 01, 2017</td>
                            <td>Jane Doe</td>
                            <td>Pre-event</td>
                            <td>Please give us 2 setup team leader</td>
                            <td>
                                <button type="button" class="btn btn-primary"><i class="fa fa-search"></i> View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
