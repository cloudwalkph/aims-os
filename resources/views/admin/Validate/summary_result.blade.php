@extends('layouts.admin')



<link href="{{ asset('css/c3.css') }}" rel="stylesheet" type="text/css">

@section('content')
    <div class="container">
        <div class="row" >
            <div class="col-sm-6">
                <button style="width: 70%;" type="button" class="btn btn-warning categorybtn">Category Details</button>
            </div>
            <div class="col-sm-6">
                <button style="width: 70%;" type="button" class="btn btn-warning departmentbtn">Department Details</button>
            </div>
        </div>

        <div id="chart"></div>


    </div>
@endsection

<script src="{{ asset('js/d3/d3.min.js') }}"></script>
<script src="{{ asset('js/c3js-chart/c3.min.js') }}"></script>
<script src="{{ asset('js/charts-c3.js') }}"></script>
<script>
    var chart = c3.generate({
        bindto: '#chart',
        data: {
            columns: [
                ['data1', 1030, 1200, 1100, 1400, 1150, 1250],
                ['data2', 2130, 2100, 2140, 2200, 2150, 1850]
            ],
            type: 'bar',
        },
        bar: {
            zerobased: false
        }
    });
</script>