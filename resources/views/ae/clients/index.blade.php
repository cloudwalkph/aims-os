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

                <clients-table></clients-table>
            </div>


        </div>
    </div>
@endsection
