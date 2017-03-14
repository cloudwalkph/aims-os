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

        <div id="chart"></div>

        <div class="row" style="margin-top: 10px;">
            <div class="col-sm-offset-2 col-sm-1" style="margin-left: 187px;">
                <label>Ratee:</label>
            </div>
            <div class="col-sm-3">
                <select class="fullwidth" name="selRateeSummary" id="selRateeSummary" alt="ratee" style="width: 100%;">
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
            <table class="vuetable table table-bordered table-striped table-hover" role="grid" style="margin-top: 30px;">
                <thead>
                <tr>
                    <th width="920">Questions</th>
                    <th>Rate</th>
                </tr>
                </thead>
                <tbody id="summaryTbody">

                {{--@foreach($questions as $question)--}}

                    {{--<tr id="eventRow{{$question -> _id}}">--}}
                        {{--<td>{{$question -> qname}}</td>--}}
                        {{--<td>--}}
                            {{--{{ rand(60, 100).'%' }}--}}
                        {{--</td>--}}
                    {{--</tr>--}}

                {{--@endforeach--}}

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
            bindto: '#chart',
            data: {
                columns: [
                    ['Pre-event', 30, 20, 100, 100, 15, 50],
                    ['Event Proper', 30, 100, 40, 20, 50, 15],
                    ['Post-event', 50, 80, 90, 75, 99, 95]
                ],
                type: 'bar',
            },
            bar: {
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
    <script !src="">
        function loadQuestions( deptID ) {

            axios.get('{{ URL::to('/questions/getquestionswithresult') }}', {
                params: {
                    deptID: deptID,
                }
            })
                .then(function (response) {
                    $('#summaryTbody').empty();
                    $('#summaryTbody').append(response.data.question_string);
                })
                .catch(function (error) {
                    console.log(error);
                });

        }

        $('#selRateeSummary').on('change', function () {
            var deptName = $(this).val();
            axios.get('{{ URL::to('/users/getusers') }}', {
                params: {
                    dept: deptName,
                }
            })
                .then(function (response) {
                    $('#selRateeEmp').empty();
                    $('select#selRateeEmp').append(response.data.optionList);

//                    loadQuestions( response.data.department );
                })
                .catch(function (error) {
                    console.log(error);
                });
        });

        $('#selRateeEmp').on('change', function () {
            var deptName = $('#selRateeSummary').val();
            axios.get('{{ URL::to('/users/getusers') }}', {
                params: {
                    dept: deptName,
                }
            })
                .then(function (response) {
                    loadQuestions( response.data.department );
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
    </script>
@endsection