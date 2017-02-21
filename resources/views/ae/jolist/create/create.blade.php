@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Accounting Executive<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/ae"><i class="fa fa-dashboard"></i> AE Department</a>
                    </li>
                    <li>
                        <a href="/ae/jo"><i class="fa fa-file-text-o"></i> Job Order Lists</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-pencil-square-o"></i> Create Job Order
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">

                <form method="POST">
                    <div class="form-group">
                        <label for="project_name">Project Name</label>
                        <input type="text" class="form-control"
                               id="project_name"
                               placeholder="Project Name"
                               required/>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Select Project Type</label>
                            </div>

                            {{--populate project types start--}}
                            <div class="checkbox col-md-2">
                                <label>
                                    <input name="project_types" value="test"
                                           type="checkbox" /> Sampling
                                </label>
                            </div>
                            {{--populate project types end--}}

                        </div>
                    </div>

                    <hr/>

                    {{--client populate start--}}
                    <div>
                        <label htmlFor="exampleInputEmail1">Select Client</label>
                        <div class="input-group">
                            <select name="client_id" id="client_id" class="form-control">
                                <option value="1">John Doe</option>
                                <option value="2">Jane Doe</option>
                            </select>

                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-block col-md-2"
                                        data-toggle="modal" data-target="#createClient">
                                    <i class="fa fa-plus"></i> Create New Client
                                </button>
                            </span>
                        </div>
                    </div>
                    {{--client populate end--}}

                    <br/>

                    <hr />

                    <div>
                        <div class="form-group">
                            <input type="email" readOnly="readOnly"
                                   class="form-control" id="exampleInputEmail1"
                                   placeholder="Client Name"
                                   value="John Doe"/>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Select Brand Name</label>
                                </div>

                                {{--brand checkbox start--}}
                                <div class="checkbox col-md-2">
                                    <label>
                                        <input type="checkbox"
                                               value="test brand"/> Test Brand
                                    </label>
                                </div>
                                {{--brand checkbox end--}}

                            </div>
                        </div>

                        <button type="button"
                                class="btn btn-default">
                            <i class="fa fa-plus"></i> Add Client
                        </button>

                        <hr/>

                        <h3>Added Clients and Brands</h3>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Client</th>
                                <th>Brand</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <th>John Doe</th>
                                <th>Unilever</th>
                                <th>
                                    <button class="btn btn-danger"
                                            type="button">
                                        <i class="fa fa-trash"></i> &nbsp;
                                        Delete
                                    </button>
                                </th>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary btn-lg btn-block">Create Job Order</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection
