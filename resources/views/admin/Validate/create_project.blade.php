@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <label id="lblJOID" style="width: 100%; text-align: left;" >JO Number: {{$jos->job_order_no}}</label>
            </div>
            <div class="col-sm-4">
                <label id="projectName" style="width: 100%; text-align: left;">Project Name: {{$jos->project_name}}</label>
            </div>
            <div class="col-sm-4">
                <label id="dCreated" style="width: 100%; text-align: left;">Date Created:{{$jos->created_at}}</label>
            </div>
        </div>
        <form id="test" method="post">
            <div class="row" style="margin-top: 15px;">
                <div class="col-sm-2">
                    <label id="lblJOID" style="width: 100%">Activation Date:</label>
                </div>
                <div class="col-sm-2">
                    <input type="date" class="fullwidth dateSelector" name="inp_ActivationsDate" id="inp_ActivationsDate" style="margin-left: -60px;">
                </div>

                <div class="col-sm-2">
                    <label id="projectName" style="width: 100%">End Date:</label>
                </div>
                <div class="col-sm-2">
                    <input type="date" class="fullwidth dateSelector" name="inp_ActivationsDate" id="inp_ActivationsDate" style="margin-left: -93px;">
                </div>
                <div class="col-sm-2">
                    <select class="btn-warning fullwidth" name="eventType" id="eventType">
                        <option value="" disabled selected>Select Event Type</option>
                        <option value="S">Small Event</option>
                        <option value="M">Medium Proper</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="btn-warning fullwidth" name="qcat" id="qcat">
                        <option value="" disabled selected>Select Event</option>
                        <option value="pre">Pre-Event</option>
                        <option value="eprop">Event Proper</option>
                        <option value="post">Post-Event</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="row" style=" margin-top: 82px;">
            <div class="col-sm-offset-2 col-sm-1" style="margin-left: 187px;">
                <label>Rater:</label>
            </div>
            <div class="col-sm-3">
                <select class="fullwidth" name="selRater" id="selRater" alt="rater">
                    <option value="" disabled selected>Department</option>

                    @foreach( $departments as $department)

                        <option value="{{ $department->slug }}">{{ $department->name }}</option>

                    @endforeach

                </select>
            </div>
            <div class="col-sm-3">
            <select class="fullwidth" name="selRaterEmp" id="selRaterEmp">
                <option value="" disabled selected>Select</option>
            </select>
        </div>
            <div class="col-sm-3">
                <label class="control-label">JO Order Number</label>
                <v-select :on-change="roleSelected" :options="roleOptions"></v-select>
            </div>
        </div>

        <div class="row" style="margin-top: 10px;">
            <div class="col-sm-offset-2 col-sm-1" style="margin-left: 187px;">
                <label>Ratee:</label>
            </div>
            <div class="col-sm-3">
                <select class="fullwidth" name="selRatee" id="selRatee" alt="ratee">
                    <option value="" disabled selected>Department</option>

                    @foreach( $departments as $department)

                        <option value="{{ $department->slug }}">{{ $department->name }}</option>

                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <select class="fullwidth" name="selRateeEmp" id="selRateeEmp">
                    <option value="" disabled selected>Select</option>
                </select>
            </div>
        </div>

        <div class="row">
            <table class="table table-striped" role="grid">
                <thead>
                <tr>
                    <th width="850">Question List</th>
                    <th>Add Question
                        <select>
                            <option value="" disabled selected>Select Question</option>
                        </select>
                    </th>
                </tr>
                </thead>
                <tbody id="questions_tb">

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
            <div class="button-group">
                <a class="btn btn-primary" href="/validate/create_project/{{$jos->job_order_no}}/summary_view">View Summary</a>
                <a class="btn btn-success" style="margin-left: 823px;">Save</a>
                <a class="btn btn-info">Done</a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAlertSelection" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Alert</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
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
                    etype: eventType
                }
            })
            .then(function (response) {
                $('#questions_tb').empty();
                $('#questions_tb').append(response.data);
            })
            .catch(function (error) {
                console.log(error);
            });
        }

        $('#selRatee').on('change', function () {
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

        $('#selRater').on('change', function () {
            axios.get('{{ URL::to('/users/getusers') }}', {
                params: {
                    dept: $(this).val()
                }
            })
            .then(function (response) {
                $('#selRaterEmp').empty();
                $('select#selRaterEmp').append(response.data.optionList);
            })
            .catch(function (error) {
                console.log(error);
            });
        });
    </script>
@endsection