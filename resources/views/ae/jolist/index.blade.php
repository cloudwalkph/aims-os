@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Accounts Executive<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/ae"><i class="fa fa-dashboard"></i> AE Department</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file-text-o"></i> Job Order Lists
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">

                <a type="button" href="/ae/jo/create"
                    class="btn btn-primary btn-create">
                    <i class="fa fa-plus"></i> Create Job Order
                </a>

                <jo-table></jo-table>
            </div>

        </div>
    </div>
@endsection
