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
                    <li class="active">
                        <i class="fa fa-address-book-o"></i> Client Lists
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">

                <button type="button" class="btn btn-primary btn-create"
                        data-toggle="modal" data-target="#createClient">
                    <i class="fa fa-plus"></i> Create New Client
                </button>

                @include('ae.clients.modals.add')

                <table class="table table-striped" id="clientsList">
                    <thead>
                    <tr>
                        <th>Company</th>
                        <th>Name</th>
                        <th>Contact #</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client['company'] }}</td>
                                <td>{{ $client['contact_person'] }}</td>
                                <td>{{ $client['contact_number'] }}</td>
                                <td>{{ $client['email'] }}</td>
                                <td>
                                    <button class="btn btn-success"><i class="fa fa-edit fa-lg"></i></button>
                                    <button class="btn btn-danger"><i class="fa fa-trash fa-lg"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection
