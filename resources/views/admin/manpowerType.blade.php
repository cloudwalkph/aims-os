@extends('layouts.admin')

@section('content')
    <div class="col-md-12">
        <h1 class="pull-left table-title">Manpower Type List</h1>

        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary pull-right btn-create"
                        data-toggle="modal" data-target="#typeModal">
                    <i class="fa fa-plus fa-lg"></i> Create Manpower Type
                </button>

                <admin-manpower-types-table></admin-manpower-types-table>
            </div>
        </div>

    </div>

@endsection

