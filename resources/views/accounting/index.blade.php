@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Accounting<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Accounting Department
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">
                <div class="col-md-3 div30days">30 days</div>
                <div class="col-md-3 div45days">45 days</div>
                <div class="col-md-3 div60days">60 days</div>
                <div class="col-md-3 text-center emergency">More than 120 days</div>
            </div>

            <div class="col-md-12">
                <table class="table table-striped" style="margin-top: 30px">
                    <thead>
                    <tr>
                        <th>Job Order No.</th>
                        <th>Contact #</th>
                        <th>AE Assigned</th>
                        <th>Project Name</th>
                    </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
