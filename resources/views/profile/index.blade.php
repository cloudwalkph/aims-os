@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    {{ Auth::user()->department->name }}<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/{{Auth::user()->department->slug}}"><i class="fa fa-dashboard"></i> {{ Auth::user()->department->slug }} Department</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-id-card"></i> Profile
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">
                <div class="container" style="margin-top: 20px">
                    @include('profile.password')
                </div>
            </div>

        </div>
    </div>
@endsection
