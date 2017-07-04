@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
	                Setup<small> Department</small>
	            </h1>
	            <ol class="breadcrumb">
	                <li class="active">
	                    <a href="/setup"><i class="fa fa-dashboard"></i> Setup Department</a>
	                </li>
	                <li class="active">
	                    <i class="fa fa-dashboard"></i> Pooling
	                </li>
	            </ol>
            </div>
            {{-- breadcrumb end --}}

            <setup-pooling></setup-pooling>

        </div>
    </div>
@endsection
