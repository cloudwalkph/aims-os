@extends('layouts.admin')

@section('content')
    <div class="container" style="width: 100%;">
        <div class="row">
            <div class="col-sm-6">
                <label id="projectName" style="width: 100% text-align: left;">Project Name: {{$jos->project_name}}</label>
            </div>
            <div class="col-sm-6">
                <label id="lblJOID" style="width: 100% text-align: left;" >JO Numbers: {{$jos->job_order_no}}</label>
            </div>
        </div>
        <div class="row" style="margin-left: 84%;">
            <div class="col-sm-6">
                <a class="btn btn-info" href="/validate">Done</a>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-primary" href="/validate/create_project/{{$jos->job_order_no}}">Back</a>
                <!-- <Button id="backbtn" type="button" class="btn btn-info" style="margin-left: 300px;">Back</Button>-->
            </div>

        </div>

        <!--        //start form //-->
        <form id="test" method="post" class="text-center">
            <div class="row" style="margin-top: 15px;">
                <div class="col-sm-4">
                    <label id="lblJOID" style="width: 100%">Pre-Event</label>
                </div>
                <div class="col-sm-4">
                    <label id="lblJOID" style="width: 100%">Event Proper</label>
                </div>
                <div class="col-sm-4">
                    <label id="lblJOID" style="width: 100%">Post Event</label>
                </div>
            </div>

            <div class="row" style="margin-top: 15px;">
                <div class="col-sm-2">
                    <label id="lblJOID" style="width: 100%">Deadline:</label>
                </div>
                <div class="col-sm-2">
                    <input type="date" class="fullwidth dateSelector" name="inp_ActivationsDate" id="inp_ActivationsDate">
                </div>
                <div class="col-sm-2">
                    <label id="lblJOID" style="width: 100%">Deadline:</label>
                </div>
                <div class="col-sm-2">
                    <input type="date" class="fullwidth dateSelector" name="inp_ActivationsDate" id="inp_ActivationsDate">
                </div>
                <div class="col-sm-2">
                    <label id="lblJOID" style="width: 100%">Deadline:</label>
                </div>
                <div class="col-sm-2">
                    <input type="date" class="fullwidth dateSelector" name="inp_ActivationsDate" id="inp_ActivationsDate">
                </div>
            </div>

            <div class="row" style="margin-top: 15px;">
                <div class="col-sm-4">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Rater</th>
                            <th>Ratee</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Mark</td>
                            <td>Otto</td>
                        </tr>
                        <tr>
                            <td>Jacob</td>
                            <td>Thornton</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-4">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Rater</th>
                            <th>Ratee</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Mark</td>
                            <td>Otto</td>
                        </tr>
                        <tr>
                            <td>Jacob</td>
                            <td>Thornton</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-4">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Rater</th>
                            <th>Ratee</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Mark</td>
                            <td>Otto</td>
                        </tr>
                        <tr>
                            <td>Jacob</td>
                            <td>Thornton</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <!--        //end form//-->
    </div>
@endsection