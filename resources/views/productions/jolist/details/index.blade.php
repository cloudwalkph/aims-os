@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <input type="hidden" name="job_order_id" id="jobOrderId" value="{{ $jo->id }}">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Productions<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/productions"><i class="fa fa-dashboard"></i> Productions Department</a>
                    </li>
                    <li>
                        <a href="/productions/jo"><i class="fa fa-file-text-o"></i> Job Order Lists</a>
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
                                </button>
                            </span>

                        <h5> <b>Job Order Number: {{ $jo->job_order_no }}</b> </h5>
                        <h5> <b>Project Name: {{ $jo->project_name }}</b> </h5>
                        <h5> <strong>Deadline: {{ \Carbon\Carbon::createFromTimestamp(strtotime($jo->created_at))->toFormattedDateString() }}</strong> </h5>

                    </div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>

            <div class="row productions">
                <div class="col-md-12 col-xs-12" style="padding-top: 10px;">
                    <div class="col-md-10 col-md-offset-1 vr">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tarpaulin" data-toggle="tab">Print (Tarpaulin)</a></li>
                                <li><a href="#stickers" data-toggle="tab">Print (Stickers)</a></li>
                                <li><a href="#offset" data-toggle="tab">Print (Offset and or Digital)</a></li>
                                <li><a href="#booth" data-toggle="tab">Booth</a></li>
                                <li><a href="#photowall" data-toggle="tab">Photowalls and Panels</a></li>
                                <li><a href="#shirts" data-toggle="tab">Shirts</a></li>
                                <li><a href="#staging" data-toggle="tab">Event Staging Requirements</a></li>
                            </ul>
                            <div class="tab-content">
                                @include('productions.jolist.details.print.tarpaulin.index')
                                @include('productions.jolist.details.print.stickers.index')
                                @include('productions.jolist.details.print.offset.index')
                                @include('productions.jolist.details.booth.index')
                                @include('productions.jolist.details.photowall.index')
                                @include('productions.jolist.details.shirts.index')
                                @include('productions.jolist.details.staging.index')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.tabledit.min.js') }}"></script>
    <script>
        $('#tbl-tarpaulin').Tabledit({
//            url: 'example.php',
            columns: {
                identifier: [0, 'id'],
                editable: [
                    [1, 'visual', 'file'],
                    [2, 'size'],
                    [3, 'qty', 'number'],
                    [4, 'details']
                ]
            }
        });
        $('#tbl-stickers').Tabledit({
//            url: 'example.php',
            columns: {
                identifier: [0, 'id'],
                editable: [
                    [1, 'description', 'textarea', {row:4}],
                    [2, 'visual', 'file'],
                    [3, 'size'],
                    [4, 'qty', 'number']
                ]
            }
        });

        $('#tbl-offset').Tabledit({
//            url: 'example.php',
            columns: {
                identifier: [0, 'id'],
                editable: [
                    [1, 'description'],
                    [2, 'visual', 'file'],
                    [3, 'size'],
                    [4, 'qty', 'number'],
                    [5, 'details']
                ]
            }
        });

        $('#tbl-booth').Tabledit({
//            url: 'example.php',
            columns: {
                identifier: [0, 'id'],
                editable: [
                    [1, 'description'],
                    [2, 'visual', 'file'],
                    [3, 'qty', 'number'],
                    [4, 'materials']
                ]
            }
        });

        $('#tbl-photowall, #tbl-shirts').Tabledit({
//            url: 'example.php',
            columns: {
                identifier: [0, 'id'],
                editable: [
                    [1, 'description'],
                    [2, 'visual'],
                    [3, 'qty'],
                    [4, 'materials']
                ]
            }
        });

        $('#tbl-costing').Tabledit({
//            url: 'example.php',
            columns: {
                identifier: [0, 'id'],
                editable: [
                    [3, 'cpu'],
                    [4, 'qty'],
                    [5, 'total-cost']
                ]
            }
        });
    </script>
@endsection
