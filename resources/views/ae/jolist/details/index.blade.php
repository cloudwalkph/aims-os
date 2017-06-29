@extends('layouts.app')

@section('scripts')
    <script>
        //Save or update data
        function eventSave() {
            var list = {};
            var joId = $('#jobOrderId').val();
            var formData = document.getElementsByClassName('eventDataField');
            for(var i = 0; i< formData.length;i++){
                list[formData[i].name]= formData[i].value;
            }
            list['_token'] = $('#eventDetails').find('input[name=_token]' ).val();
            list['when'] = moment(list['when']).format("YYYY-MM-DD HH:mm")
            //used to determine the http verb to use [add=POST], [update=PUT]
            var type = 'POST'; //for creating new resource

            let url = `/api/v1/job-orders/${joId}/details`;
            axios.post(url, list).then(function(res) {
                $('#joFrame').attr('src',`/ae/jo/details/${joId}/preview`); 
                toastr.success('Successfully saved event details', 'Success')
            }).catch(function(error) {
                toastr.error('Failed in saving event details', 'Error')
            });
        }

        function momSave() {
            var list = {};
            var joId = $('#jobOrderId').val();
            var formData = document.getElementsByClassName('dataField');

            for(var i = 0; i< formData.length;i++){
                list[formData[i].name]= formData[i].value;
            }
            list['date_and_time'] = moment(list['date_and_time']).format("YYYY-MM-DD HH:mm")
            console.log(list)
//            list['_token'] = $('#momForm').find('input[name=_token]' ).val();
            //used to determine the http verb to use [add=POST], [update=PUT]

            let url = `/api/v1/job-orders/${joId}/mom`;
            axios.post(url, list).then(function(res) {
                $('#joFrame').attr('src',`/ae/jo/details/${joId}/preview`); 
                toastr.success('Successfully saved mom details', 'Success');
            }).catch(function(error) {
                toastr.error('Failed in saving mom details', 'Error');
            });
        }
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <input type="hidden" name="job_order_id" id="jobOrderId" value="{{ $jo->id }}">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Accounts Executive<small> Department</small>
                    @if(Auth()->user()->department->slug != "ae")
                        <a href="/{{ Auth()->user()->department->slug }}" class="btn btn-default pull-right">
                            <i class="fa fa-home"></i> Go back</a>
                    @endif
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
                                <button class="btn btn-default" onclick="frames['frame'].print();">
                                    <i class="fa fa-print fa-lg"></i> Print
                                </button> &nbsp;
                                <button class="btn btn-primary">
                                    <i class="fa fa-check fa-lg"></i> Complete JO
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

            <div class="col-md-12 col-xs-12" style="padding-top: 10px;">
                <div class="col-md-2">
                    <div>
                        <label for="exampleInputEmail1">Add AE</label>
                        <add-ae-job-order></add-ae-job-order>
                    </div>
                    <div class="added-ae" style="margin-top: 20px">
                        <p>{{ $jo->user->profile->full_name }}</p>
                        @foreach($aes as $ae)
                            <p>{{ $ae->user->profile->getFullNameAttribute() }}</p>
                        @endforeach
                    </div>
                    <hr/>
                    <div class="update-history" style="display: none">
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
                            <li class="hide"><a href="#client-attachments" data-toggle="tab">Client Attachments</a></li>
                            <li><a href="#project-status" data-toggle="tab">Project Status</a></li>
                            <li><a href="#request-forms" data-toggle="tab">Request Forms</a></li>
                            <li><a href="#discussions" data-toggle="tab">Discussions</a></li>
                        </ul>
                        <div class="tab-content">
                            @include('ae.jolist.details.mom.index')
                            @include('ae.jolist.details.event.index')
                            @include('ae.jolist.details.project.index')
                            @include('ae.jolist.details.client.index')
                            @include('ae.jolist.details.status.index')
                            @include('ae.jolist.details.requests.index')
                            @include('ae.jolist.details.discussion.index')
                        </div>
                    </div>
                </div>
            </div>


        </div>

        {{--<iframe src="/ae/jo/details/{{ $jo->id }}/meal" name="frameMeal" id="mealFrame" style="width: 0; height: 0"></iframe>--}}
        {{--<iframe src="/ae/jo/details/{{ $jo->id }}/preview" name="frame" id="joFrame" style="width: 0; height: 0"></iframe>--}}
        {{--<iframe src="/ae/jo/details/{{ $jo->id }}/manpower" name="frameManpower" id="manpowerFrame" style="width: 0; height: 0"></iframe>--}}
        {{--<iframe src="/ae/jo/details/{{ $jo->id }}/vehicle" name="frameVehicle" id="vehicleFrame" style="width: 0; height: 0"></iframe>--}}
    </div>
@endsection
