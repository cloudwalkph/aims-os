@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Activations<small> Job Orders</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/operations"><i class="fa fa-dashboard"></i> Operations Department</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-sitemap"></i> Activations Job Order Lists
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->profile->full_name }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <button type="button" class="btn btn-default"><i class="fa fa-search"></i> View</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
