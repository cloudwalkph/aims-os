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
                        <i class="fa fa-archive"></i> On-Going Projects
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">

                <button type="button" class="btn btn-primary btn-create"
                        data-toggle="modal" data-target="#ongoingModal">
                    <i class="fa fa-plus"></i> Create JOB
                </button>

                <ongoing-table></ongoing-table>
            </div>


        </div>
    </div>
@endsection
