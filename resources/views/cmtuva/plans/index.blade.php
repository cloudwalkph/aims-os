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
                    <li class="active">
                        <i class="fa fa-laptop"></i> Plans List
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}


            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Job Order Number</th>
                        <th>Project Name</th>
                        <th>Total Traffic Count</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td><a href="/cmtuva/plans/20011111">20011111</a></td>
                        <td>Project Test</td>
                        <td>10000</td>
                        <td>Pending</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
