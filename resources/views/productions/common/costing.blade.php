@extends('layouts.app')


@section('scripts')
@endsection

@section('content')

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
            <li>
                <a href="/productions/jo/details/{{ $jo->job_order_no }}"><i class="fa fa-file-text-o"></i> {{ $jo->job_order_no }}</a>
            </li>
            <li class="active">
                <i class="fa fa-list"></i> Costing
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
                <h4>{{ ucfirst( $productiontype ) }}</h4>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <table class="table table-striped table-bordered table-costing" id="tbl-costing">
            <thead>
            <tr>
                <th>#</th>
                <th>Particular (Item)</th>
                <th>Specifications (Size, Material, etc)</th>
                <th>Cost per Unit</th>
                <th>Quantity</th>
                <th>Total Cost</th>
                <th>Supplier</th>
                <th>Remarks</th>
                <th width="150"> </th>
            </tr>
            </thead>

            <tbody id="tbody_costing">

            @foreach( $prodlist as $product_details )
                <tr>
                    <td>
                        booth{{ $product_details->id.$product_details->product_id }}
                    </td>
                    <td>
                        {{ $product_details->description }}
                    </td>
                    <td>
                        visuals : {{ $product_details->visuals }}
                        <br>
                        sizes : {{ $product_details->sizes }}
                        <br>
                        materials : {{ $product_details->details }}
                        <br>
                    </td>
                    <td></td>
                    <td>{{ $product_details->qty }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <div id="col1">
                            <button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important costingUpdate{{ $product_details->id }}" onclick="updateCosting( 'costing', {{ $product_details->id }} )" aria-hidden="true"></button>
                            <button class="btn glyphicon glyphicon-edit costingEdit{{ $product_details->id }}" aria-hidden="true" onclick="editCosting( 'costing', {{ $product_details->id }} )"></button>
                        </div>
                        <div id="col2">
                            <button class="btn btn-danger glyphicon glyphicon-trash costingTrash{{ $product_details->id }}" onclick="trashCosting( 'costing', {{ $product_details->id }} )" aria-hidden="true"></button>
                            <button class="btn btn-danger hidden-not-important costingDelete{{ $product_details->id }}" onclick="deleteCosting('costing', {{ $product_details->id }})" aria-hidden="true">Delete</button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection
