@extends('layouts.app')


@section('scripts')
    <script src="{{ asset('js/jquery.tabledit.min.js') }}"></script>
    <script>
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
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>1</td>
                <td>Booth</td>
                <td>Sintra, plywood</td>
                <td>100</td>
                <td>200</td>
                <td>2000</td>
                <td>Middleware</td>
                <td>2 days delivery</td>
            </tr>
            </tbody>
        </table>
    </div>


@endsection
