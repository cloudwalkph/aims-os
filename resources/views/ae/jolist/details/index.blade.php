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
                    <li>
                        <a href="/ae/jo"><i class="fa fa-file-text-o"></i> Job Order Lists</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-list"></i> Job Order Details
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                            <span class="pull-right">
                                <button class="btn btn-default">
                                    <i class="fa fa-print fa-lg"></i> Print
                                </button> &nbsp;
                                <button class="btn btn-primary">
                                    <i class="fa fa-check fa-lg"></i> Complete JO
                                </button>
                            </span>

                        <p> <b>Project Name: Project Doe</b> </p>
                        <p> <b>Job Order Number: 20160131231</b> </p>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <h5>Client: John Doe</h5>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <h5>Date Created: July 07, 2017</h5>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <h5>Contract Number 12322125643</h5>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <h5>Invoice Number: 12992981721</h5>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <h5>AE Name: John Doe</h5>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <h5>Project Type: Events</h5>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <h5>Brand: Nike</h5>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <h5>D.O. Number: 12341123123</h5>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <h5>Paid Date: Dec. 20, 2016</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xs-12" style="padding-top: 10px;">
                <div class="col-md-2">
                    <div>
                        <label for="exampleInputEmail1">Add AE</label>
                        <div class="input-group">
                            <input type="email" class="form-control col-md-10" id="exampleInputEmail1" placeholder="Add AE" />
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-block col-md-2">
                                   <i class="fa fa-plus"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="added-ae">
                        <p>Alleo Indong</p>
                        <p>Alleo Indong</p>
                    </div>
                    <hr/>
                    <div class="update-history">
                        <h4>Update History</h4>
                        <p>December 28, 2016</p>
                        <p>December 20, 2016</p>
                    </div>

                </div>

                <div class="col-md-10 vr">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#mom" data-toggle="tab">MOM</a></li>
                            <li><a href="#event-details" data-toggle="tab">Event Details</a></li>
                            <li><a href="#project-attachments" data-toggle="tab">Project Attachments</a></li>
                            <li><a href="#client-attachments" data-toggle="tab">Client Attachments</a></li>
                            <li><a href="#project-status" data-toggle="tab">Project Status</a></li>
                            <li><a href="#request-forms" data-toggle="tab">Request Forms</a></li>
                            <li><a href="#discussions" data-toggle="tab">Discussions</a></li>
                        </ul>
                        <div class="tab-content">
                            @include('ae.jolist.details.mom.index')
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
