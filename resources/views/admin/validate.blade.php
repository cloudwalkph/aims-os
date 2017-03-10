@extends('layouts.admin')

@section('content')

    <div class="container-fluid dashboard">
        <div class="row">
            <main class="col-sm-11 offset-sm-1 col-md-11 offset-md-1 pt-3">
                <h1>Dashboard</h1>
                <form class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    {{--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>--}}
                </form>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>JO Order Number</th>
                            <th>Project Name</th>
                            <th>Project Type</th>
                            <th>Client Name</th>
                            <th>Brand</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $jo)

                            <tr>
                                <td><a href="/validate/create_project/{{ $jo['joId'] }}"> {{ $jo['joId'] }} </a></td>
                                <td>{{ $jo['projName'] }}</td>
                                <td>{{$jo['projecttypes']}}</td>
                                <td>{{ $jo['contact'] }}</td>
                                <td>{{ $jo['brands'] }}</td>
                                {{--<td>sit</td>--}}
                                <td>{{ $jo['status'] }}</td>
                                <td>
                                    <a href="/validate/summary_result" class="btn btn-success btn-rounded btn-ripple"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="#" class="btn btn-warning btn-rounded btn-ripple editButtonEvent" alt="'.$row->jobID.'" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="#" class="btn btn-danger btn-rounded btn-ripple deleteButtonEvent" alt="'.$row->jobID.'"><i class="fa fa-trash" aria-hidden="true"></i></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </main> 
        </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg" role="document" style="width: 570px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Dashboard</h4>
                        </div>
                        <div class="modal-body">
                            <form id="clientForm">
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-10 form-group text-input-container">
                                        <label class="control-label">JO Order Number</label>
                                        <input type="text" name="JO_Order_Number" placeholder="JO Order Number" class="form-control" />
                                        {{--<v-select :on-change="roleSelected" :options="roleOptions"></v-select>--}}
                                    </div>

                                    <div class="col-md-offset-1 col-md-10 form-group text-input-container">
                                        <label class="control-label">Project Name</label>
                                        <input type="text" name="Project_Name" placeholder="Project Name" class="form-control" />
                                        {{--<v-select :on-change="departmentSelected" :options="departmentOptions"></v-select>--}}
                                    </div>

                                    <div class="col-md-offset-1 col-md-10 form-group text-input-container">
                                        <label class="control-label">Project Type</label>
                                        <input type="text" name="ptype"
                                        placeholder="Project Type" class="form-control" />
                                    </div>

                                    <div class="col-md-offset-1 col-md-10 form-group text-input-container">
                                        <label class="control-label" >Client Name</label>
                                        <input type="text" name="Client_name" placeholder="Client Name" class="form-control" />
                                        {{--<v-select :on-change="genderSelected" :options="genderOptions"></v-select>--}}
                                    </div>

                                    <div class="col-md-offset-1 col-md-10 form-group text-input-container">
                                        <label class="control-label">Brand</label>
                                        <input type="text" name="brands"
                                        placeholder="Brand" class="form-control" />
                                    </div>

                                    <div class="col-md-offset-1 col-md-10 form-group text-input-container">
                                        <label class="control-label">Status</label>
                                        <input type="text" name="Status"
                                        {{--@input="inputChange" v-bind:value="Status" id="Status"--}}
                                        placeholder="Status" class="form-control" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection