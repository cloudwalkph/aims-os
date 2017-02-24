@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Creatives<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/creatives"><i class="fa fa-dashboard"></i> Creatives Department</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-archive"></i> Work in Progress
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">
                <work-in-progress-table></work-in-progress-table>
            </div>


        </div>
    </div>
@endsection
