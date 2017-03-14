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
@section('c3scripts')
    <script !src="">
        function loadQuestions( deptID ) {
            var category = $('#qcat').val();
            var eventType = $('#eventType').val();

            if( category == null && eventType == null ){
                $('#selRatee').val('');
                $('.modal-body').text('Please select the event type and the category.');
                $('#modalAlertSelection').modal('show');
                return false;
            }

            axios.get('{{ URL::to('/questions/getquestions') }}', {
                params: {
                    deptID: deptID,
                    cat: category,
                    etype: eventType,
                    qids: question_ids
                }
            })
                .then(function (response) {
                    question_ids = response.data.question_id;
                    $('#questions_tb').empty();
                    $('#questions_tb').append(response.data.question_string);
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        $('#selRateeSummary').on('change', function () {
            alert('hello');
            var deptName = $(this).val();
            axios.get('{{ URL::to('/users/getusers') }}', {
                params: {
                    dept: deptName,
                }
            })
                .then(function (response) {
                    $('#selRateeEmp').empty();
                    $('select#selRateeEmp').append(response.data.optionList);

                    loadQuestions( response.data.department );
                })
                .catch(function (error) {
                    console.log(error);
                });
        });
    </script>
@endsection