@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
	                Human Resources<small> Department</small>
	            </h1>
	            <ol class="breadcrumb">
	                <li class="active">
	                    <a href="/hr"><i class="fa fa-dashboard"></i> HR Department</a>
	                </li>
	                <li class="active">
	                    <i class="fa fa-dashboard"></i> Vehicle Request
	                </li>
	            </ol>
            </div>
            {{-- breadcrumb end --}}

            <hr-vehicle-request></hr-vehicle-request>
        </div>
    </div>
@endsection
