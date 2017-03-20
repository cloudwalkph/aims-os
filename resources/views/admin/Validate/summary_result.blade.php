@extends('layouts.admin')

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

        <div class="row" >
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th >PRE-EVENT</th>
                </tr>
                </thead>
                <tbody id="chart1">
                </tbody>
            </table>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th >EVENT PROPER</th>
                </tr>
                </thead>
                <tbody id="chart2">
                </tbody>
            </table>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th >POST EVENT</th>
                </tr>
                </thead>
                <tbody id="chart3">
                </tbody>
            </table>

        </div>
    </div>
@endsection
@section('c3scripts')

    <script src="{{ asset('js/d3/d3.min.js') }}"></script>
    <script src="{{ asset('js/c3js-chart/c3.min.js') }}"></script>
    <script src="{{ asset('js/charts-c3.js') }}"></script>
    <script>
        var chart = c3.generate({
            bindto: '#chart1',
            data: {
                columns: [
                    ['Pre-event', 30, 20, 100, 100, 15, 50],
                ],
                type: 'line',
            },
            line: {
                zerobased: false
            },
            axis: {
                x: {
                    type: 'category',
                    categories: ['Account Executives', 'Accounting', 'Creatives', 'CMTUVA', 'Setup', 'Operations', 'HR']
                }
            }
        });
    </script>

    <script>
        var chart = c3.generate({
            bindto: '#chart2',
            data: {
                columns: [
                    ['Event Proper', 30, 100, 40, 20, 50, 15],
                ],
                type: 'line',
            },
            line: {
                zerobased: false
            },
            axis: {
                x: {
                    type: 'category',
                    categories: ['Account Executives', 'Accounting', 'Creatives', 'CMTUVA', 'Setup', 'Operations', 'HR']
                }
            }
        });
    </script>

    <script>
        var chart = c3.generate({
            bindto: '#chart3',
            data: {
                columns: [
                    ['Post-event', 50, 80, 90, 75, 99, 95,88,20,30]
                ],
                type: 'line',
            },
            line: {
                zerobased: false
            },
            axis: {
                x: {
                    type: 'category',
                    categories: ['Account Executives', 'Accounting', 'Creatives', 'CMTUVA', 'Setup', 'Operations', 'HR', 'Productions', 'Inventory',]
                }
            }
        });
    </script>
@endsection


