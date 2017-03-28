@extends('layouts.admin')

@section('content')

    <div class="container-fluid dashboard">
        <div class="row">
            <main class="col-md-12">
                <h1>Dashboard</h1>
                <form class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    {{--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>--}}
                </form>
                <div class="table-responsive">
                    <table class="vuetable table table-bordered table-striped table-hover" style="margin-top: 15px;">
                        <thead>
                        <tr>
                            <th class="vuetable-th-slug sortable">JO Order Number</th>
                            <th class="vuetable-th-slug sortable">Project Name</th>
                            <th class="vuetable-th-slug sortable">Project Type</th>
                            <th class="vuetable-th-slug sortable">Client Name</th>
                            <th class="vuetable-th-slug sortable">Brand</th>
                            <th class="vuetable-th-slug sortable">Status</th>
                            <th class="vuetable-th-slug sortable">Assignment</th>
                            {{--<th class="vuetable-th-slug sortable">Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $jo)

                            <tr>
                                <td><a href="/admin/validations/{{ $jo['joId'] }}"> {{ $jo['joId'] }} </a></td>
                                <td>{{ $jo['projName'] }}</td>
                                <td>{{$jo['projecttypes']}}</td>
                                <td>{{ $jo['contact'] }}</td>
                                <td>{{ $jo['brands'] }}</td>
                                <td>{{ $jo['status'] }}</td>
                                <td>{{ $jo['status'] }}</td>
                                {{--<td>--}}
                                    {{--<a href="#" class="btn btn-danger btn-rounded btn-ripple deleteButtonEvent" alt="{{ $jo['joId'] }}"><i class="fa fa-trash" aria-hidden="true"></i></a>--}}
                                {{--</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
@endsection