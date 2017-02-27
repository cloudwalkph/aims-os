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
                        <h5>Job Order Number: 2016345646</h5>
                        <h5>Project Name: Ponds Men Activations</h5>
                    </div>
                </div>
            </div>

            <div class="col-md-12" style="margin-top: 30px">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th rowSpan="2">Particulars</th>
                        <th rowSpan="2">Target Activity</th>
                        <th colSpan="5">Target Hits</th>
                        <th rowSpan="2">Target Duration</th>
                        <th rowSpan="2">Areas</th>
                    </tr>

                    <tr>
                        <th> Selling </th>
                        <th> Flyering</th>
                        <th> Survey</th>
                        <th> Experiment</th>
                        <th> Other</th>
                    </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <hr/>
            </div>

            <div class="box box-info">
                <div class="box-body">
                    <div class="col-md-2">
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
                    <div class="col-md-2">
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
                    <div class="col-md-12 venues" style="margin-top: 20px">
                        <table class="table table-striped" id="venueMasterList">
                            <thead>
                            <tr>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Area</th>
                                <th>Subarea</th>
                                <th>Venue</th>
                                <th>Address</th>
                                <th>LSM</th>
                                <th> Rate Min </th>
                                <th> Rate Max</th>
                                <th> EFT Combined</th>
                                <th> EFT Male</th>
                                <th> EFT Female</th>
                                <th> Actual Hits Male</th>
                                <th> Actual Hits Female</th>
                                <th> Dry Sampling - Male</th>
                                <th> Dry Sampling - Female</th>
                                <th> Experiential Sampling - Male</th>
                                <th> Experiential Sampling - Female</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Remarks</th>
                                <th>Images</th>
                            </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <h4>
                            Selected Venues
                            <i class="fa fa-print fa-lg pull-right" ></i>
                        </h4>
                    </div>

                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="selectedVenueTable">
                            <thead>
                            <tr>
                                <th>Venue</th>
                                <th>Estimated Foot Traffic</th>
                                <th>Actual Hits</th>
                                <th>Rate</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="pull-right">Total Traffic Count: 10000</h5>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary pull-right" > Save</button>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
