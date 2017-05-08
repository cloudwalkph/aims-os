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
                    <i class="fa fa-book"></i> Job Order Lists
                </li>
            </ol>
        </div>
        {{-- breadcrumb end --}}

        <div class="col-md-12">
            <admin-jo-table></admin-jo-table>
        </div>

    </div>
@endsection
