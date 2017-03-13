@extends('layouts.admin')

@section('c3scripts')
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

@endsection

@section('content')

    <link href="{{ asset('css/c3.css') }}" rel="stylesheet" type="text/css" style="width: 100%">

    <div class="container" style="width: 100%">
        {{--<div class="row" >--}}
            {{--<div class="col-sm-6">--}}
                {{--<button style="width: 70%;" type="button" class="btn btn-warning categorybtn">Category Details</button>--}}
            {{--</div>--}}
            {{--<div class="col-sm-6">--}}
                {{--<button style="width: 70%;" type="button" class="btn btn-warning departmentbtn">Department Details</button>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div id="chart"></div>

        <div class="row" style="margin-top: 10px;">
            <div class="col-sm-offset-2 col-sm-1" style="margin-left: 187px;">
                <label>Ratee:</label>
            </div>
            <div class="col-sm-3">
                <select class="fullwidth" name="selRatee" id="selRatee" alt="ratee" style="width: 100%;">
                    <option value="" disabled selected>Department</option>

                    @foreach( $departments as $department)

                        <option value="{{ $department->slug }}">{{ $department->name }}</option>

                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <select class="fullwidth" name="selRateeEmp" id="selRateeEmp" style="width: 100%;">
                    <option value="" disabled selected>Select</option>
                </select>
            </div>
        </div>

        <div class="row">
            <table class="table table-striped" role="grid">
                <thead>
                <tr>
                    <th width="920">Employee Rate</th>
                </tr>
                </thead>
                <tbody>

                @foreach($questions as $question)

                    <tr id="eventRow{{$question -> _id}}">
                        <td>{{$question -> qname}}</td>
                        <td>
                            <a href="#" class="btn btn-danger btn-rounded btn-ripple deleteButtonEvent" alt="{{$question -> _id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection