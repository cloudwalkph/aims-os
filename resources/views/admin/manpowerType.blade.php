@extends('layouts.admin')

@section('content')
    <div class="row">
        {{-- breadcrumb start --}}
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin<small> Department</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="/admin"><i class="fa fa-dashboard"></i> Admin Department</a>
                </li>
                <li class="active">
                    <i class="fa fa-wrench"></i> Manpower Types List
                </li>
            </ol>
        </div>
        {{-- breadcrumb end --}}

        <div class="col-md-12">
            <button type="button" class="btn btn-primary pull-right btn-create"
                    data-toggle="modal" data-target="#typeModal">
                <i class="fa fa-plus fa-lg"></i> Create Manpower Type
            </button>

            <admin-manpower-types-table></admin-manpower-types-table>
        </div>

    </div>

@endsection

