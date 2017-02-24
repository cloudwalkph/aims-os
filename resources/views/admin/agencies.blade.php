@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <h1 class="pull-left table-title">Agency List</h1>

        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary pull-right btn-create"
                        data-toggle="modal" data-target="#agencyModal">
                    <i class="fa fa-plus fa-lg"></i> Create Agency
                </button>

                <admin-users-table></admin-users-table>
            </div>
        </div>

    </div>

@endsection

