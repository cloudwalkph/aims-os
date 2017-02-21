@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Accounting Executive<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/ae"><i class="fa fa-dashboard"></i> AE Department</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file-text-o"></i> Job Order Lists
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">

                <a type="button" href="/ae/jo/create"
                    class="btn btn-primary btn-create">
                    <i class="fa fa-plus"></i> Create Job Order
                </a>

                <div class="col-md-12 col-xs-12">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Job Order Number</th>
                            <th>Project Name</th>
                            <th>Client Name</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($jos as $jo)
                                <tr>
                                    <td>{{ $jo['job_order_no'] }}</td>
                                    <td>{{ $jo['project_name'] }}</td>
                                    <td>John Doe</td>
                                    <td>{{ $jo['status'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
