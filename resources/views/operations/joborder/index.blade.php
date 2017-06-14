@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Operations<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/operations"><i class="fa fa-dashboard"></i> Operations Department</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file-text-o"></i> Job Order Lists
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">
                <operations-jo-table></operations-jo-table>
            </div>

        </div>
    </div>
@endsection
