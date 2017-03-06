@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    CMTUVA<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/cmtuva"><i class="fa fa-dashboard"></i> CMTUVA Department</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-laptop"></i> Plans List
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}


            <div class="col-md-12">
                <plan-jo-table></plan-jo-table>
            </div>
        </div>

    </div>

@endsection
