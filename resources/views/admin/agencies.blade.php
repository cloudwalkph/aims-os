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
                    <i class="fa fa-book"></i> Agencies List
                </li>
            </ol>
        </div>
        {{-- breadcrumb end --}}

        <div class="col-md-12">
            <button type="button" class="btn btn-primary pull-right btn-create"
                    data-toggle="modal" data-target="#agencyModal">
                <i class="fa fa-plus fa-lg"></i> Create Agency
            </button>

            <admin-agencies-table></admin-agencies-table>
        </div>

    </div>

@endsection

