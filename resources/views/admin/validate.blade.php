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
                        <tr>
                            <td><a href="/validate/create_project">JO00001</a></td>
                            <td>Lorem</td>
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
                        <tr>
                            <td><a href="/validate/create_project">JO00002</a></td>
                            <td>amet</td>
                            <td>consectetur</td>
                            <td>adipiscing</td>
                            <td>elit</td>
                            <td>elit</td>
                            <td>
                                <a href="'.base_url('events/results/'.$row->jobID).'" class="btn btn-success btn-rounded btn-ripple"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-warning btn-rounded btn-ripple editButtonEvent" alt="'.$row->jobID.'" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-danger btn-rounded btn-ripple deleteButtonEvent" alt="'.$row->jobID.'"><i class="fa fa-trash" aria-hidden="true"></i></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="/validate/create_project">JO00003</a></td>
                            <td>Integer</td>
                            <td>nec</td>
                            <td>odio</td>
                            <td>Praesent</td>
                            <td>Praesent</td>
                            <td>
                                <a href="'.base_url('events/results/'.$row->jobID).'" class="btn btn-success btn-rounded btn-ripple"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-warning btn-rounded btn-ripple editButtonEvent" alt="'.$row->jobID.'" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-danger btn-rounded btn-ripple deleteButtonEvent" alt="'.$row->jobID.'"><i class="fa fa-trash" aria-hidden="true"></i></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="/validate/create_project">JO00004</a></td>
                            <td>libero</td>
                            <td>Sed</td>
                            <td>cursus</td>
                            <td>ante</td>
                            <td>ante</td>
                            <td>
                                <a href="'.base_url('events/results/'.$row->jobID).'" class="btn btn-success btn-rounded btn-ripple"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-warning btn-rounded btn-ripple editButtonEvent" alt="'.$row->jobID.'" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-danger btn-rounded btn-ripple deleteButtonEvent" alt="'.$row->jobID.'"><i class="fa fa-trash" aria-hidden="true"></i></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="/validate/create_project">JO00005</a></td>
                            <td>dapibus</td>
                            <td>diam</td>
                            <td>Sed</td>
                            <td>nisi</td>
                            <td>nisi</td>
                            <td>
                                <a href="'.base_url('events/results/'.$row->jobID).'" class="btn btn-success btn-rounded btn-ripple"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-warning btn-rounded btn-ripple editButtonEvent" alt="'.$row->jobID.'" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-danger btn-rounded btn-ripple deleteButtonEvent" alt="'.$row->jobID.'"><i class="fa fa-trash" aria-hidden="true"></i></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="/validate/create_project">JO00006</a></td>
                            <td>Nulla</td>
                            <td>quis</td>
                            <td>sem</td>
                            <td>at</td>
                            <td>at</td>
                            <td>
                                <a href="'.base_url('events/results/'.$row->jobID).'" class="btn btn-success btn-rounded btn-ripple"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-warning btn-rounded btn-ripple editButtonEvent" alt="'.$row->jobID.'" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-danger btn-rounded btn-ripple deleteButtonEvent" alt="'.$row->jobID.'"><i class="fa fa-trash" aria-hidden="true"></i></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="/validate/create_project">JO00007</a></td>
                            <td>sagittis</td>
                            <td>ipsum</td>
                            <td>Praesent</td>
                            <td>mauris</td>
                            <td>mauris</td>
                            <td>
                                <a href="'.base_url('events/results/'.$row->jobID).'" class="btn btn-success btn-rounded btn-ripple"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-warning btn-rounded btn-ripple editButtonEvent" alt="'.$row->jobID.'" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-danger btn-rounded btn-ripple deleteButtonEvent" alt="'.$row->jobID.'"><i class="fa fa-trash" aria-hidden="true"></i></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="/validate/create_project">JO00008</a></td>
                            <td>Fusce</td>
                            <td>Fusce</td>
                            <td>nec</td>
                            <td>nec</td>
                            <td>tellus</td>
                            <td>
                                <a href="'.base_url('events/results/'.$row->jobID).'" class="btn btn-success btn-rounded btn-ripple"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-warning btn-rounded btn-ripple editButtonEvent" alt="'.$row->jobID.'" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-danger btn-rounded btn-ripple deleteButtonEvent" alt="'.$row->jobID.'"><i class="fa fa-trash" aria-hidden="true"></i></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="/validate/create_project">JO00009</a></td>
                            <td>augue</td>
                            <td>semper</td>
                            <td>porta</td>
                            <td>Mauris</td>
                            <td>Mauris</td>
                            <td>
                                <a href="'.base_url('events/results/'.$row->jobID).'" class="btn btn-success btn-rounded btn-ripple"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-warning btn-rounded btn-ripple editButtonEvent" alt="'.$row->jobID.'" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="#" class="btn btn-danger btn-rounded btn-ripple deleteButtonEvent" alt="'.$row->jobID.'"><i class="fa fa-trash" aria-hidden="true"></i></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </main> 
        </div>
    </div>
@endsection