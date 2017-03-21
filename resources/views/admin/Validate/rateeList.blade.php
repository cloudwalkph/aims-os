@extends('layouts.app')

@section('content')
    {{--{{ $results }}--}}
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
                            <th class="vuetable-th-slug sortable">Employee Name</th>
                            <th class="vuetable-th-slug sortable">Departments</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $result)

                            <tr>
                                <td>{{ $result -> last_name.', '.$result-> first_name.' '.$result -> middle_name }}</td>
                                <td>{{}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

@endsection