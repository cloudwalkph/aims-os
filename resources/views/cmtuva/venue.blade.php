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
                        <i class="fa fa-map-marker"></i> Venues List
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}


            <div class="col-md-12">
                <div class="col-md-12 venues">

                    <button type="button" class="btn btn-primary btn-create"
                            data-toggle="modal" data-target="#createVenue">
                        <i class="fa fa-plus"></i> Create New Venue
                    </button>
                    <button type="button" class="btn btn-default btn-create"
                            data-toggle="modal" data-target="#importVenue"
                            style="margin-left: 10px;">
                       <i class="fa fa-upload"></i> Import From Excel
                    </button>

                    <div class="content">
                        <venues-table></venues-table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{--import venue modal--}}
    <div class="modal fade" id="importVenue" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Import Venue Data</h4>
                </div>
                <div class="modal-body">

                    <form encType="multipart/form-data">
                        <div class="row">

                            {{--dropzone?--}}
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Deadline</label>
                                <input type="file" name="excel" id="excel"
                                placeholder="Excel File" class="form-control" />
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
