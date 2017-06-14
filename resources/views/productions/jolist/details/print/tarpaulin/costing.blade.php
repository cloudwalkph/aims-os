@extends('layouts.app')

@section('scripts')

@endsection

@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">

                <h5> <b>Job Order Number: {{ $jo->job_order_no }}</b> </h5>
                <h5> <b>Project Name: {{ $jo->project_name }}</b> </h5>
                <h5> <strong>Deadline: {{ \Carbon\Carbon::createFromTimestamp(strtotime($jo->created_at))->toFormattedDateString() }}</strong> </h5>

            </div>
        </div>
    </div>

    <div class="col-md-12">
        <table class="table table-striped table-bordered table-costing">
            <thead>
            <tr>
                <th>#</th>
                <th>Particular (Item)</th>
                <th>Specifivations (Size, Material, etc)</th>
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
                <td>Internal</td>
                <td>Internal</td>
                <td>Internal</td>
                <td>Internal</td>
                <td>Internal</td>
                <td>Internal</td>
                <td>Internal</td>
            </tr>
            </tbody>
        </table>
    </div>


@endsection
