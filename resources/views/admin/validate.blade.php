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
                        @foreach($jos as $jo)

                            <tr>
                                <td><a href="/validate/create_project"> {{$jo->job_order_no}}</a></td>
                                <td>{{$jo->job_order_no}}</td>
                                <td>ipsum</td>
                                <td>dolor</td>
                                <td>sit</td>
                                <td>sit</td>
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
    </div>
@endsection