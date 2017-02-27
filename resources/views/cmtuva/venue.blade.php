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

                    <div class="content" >

                        <table class="table table-striped" id="venueMasterList">
                            <thead>
                            <tr>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Area</th>
                                <th>Subarea</th>
                                <th>Venue</th>
                                <th>Address</th>
                                <th>LSM</th>
                                <th> Rate Min </th>
                                <th> Rate Max</th>
                                <th> EFT Combined</th>
                                <th> EFT Male</th>
                                <th> EFT Female</th>
                                <th> Actual Hits Male</th>
                                <th> Actual Hits Female</th>
                                <th> Dry Sampling - Male</th>
                                <th> Dry Sampling - Female</th>
                                <th> Experiential Sampling - Male</th>
                                <th> Experiential Sampling - Female</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Remarks</th>
                                <th>Images</th>
                                <th>Actions</th>
                            </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{--create venue modal--}}

    <div class="modal fade" id="createVenue" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Venue Form</h4>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="row">
                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Category</label>
                                <input type="text" name="category" id="category"
                                       placeholder="Category" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">SubCategory</label>
                                <input type="text" name="subcategory" id="subcategory"
                                       placeholder="SubCategory" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Venue</label>
                                <input type="text" name="venue" id="venue"
                                       placeholder="Venue" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Area</label>
                                <input type="text" name="area" id="area"
                                       placeholder="Area" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Sub Area</label>
                                <input type="text" name="sub_area" id="sub_area"
                                       placeholder="Sub Area" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Street</label>
                                <input type="text" name="street" id="street"
                                       placeholder="Street" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Rate Minimum</label>
                                <input type="number" name="rate_min" id="rate_min"
                                       placeholder="Rate Minimum" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Rate Max</label>
                                <input type="number" name="rate_max" id="rate_max"
                                       placeholder="Rate Max" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Estimated Foot Traffic</label>
                                <input type="text" name="eft" id="eft"
                                       placeholder="Estimated Foot Traffic" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">EFT Male</label>
                                <input type="number" name="eft_male" id="eft_male"
                                       placeholder="EFT Male" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">EFT Female</label>
                                <input type="number" name="eft_female" id="eft_female"
                                       placeholder="EFT Female" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Target Hits</label>
                                <input type="text" name="target_hits" id="target_hits"
                                       placeholder="Target Hits" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">Actual Hits Male</label>
                                <input type="number" name="actual_hits" id="actual_hits"
                                       placeholder="Actual Hits Male" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">Actual Hits Female</label>
                                <input type="number" name="actual_hits_f" id="actual_hits_f"
                                       placeholder="Actual Hits Female" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">Actual Dry Male</label>
                                <input type="number" name="actual_dry_m" id="actual_dry_m"
                                       placeholder="Actual Dry Male" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">Actual Dry Female</label>
                                <input type="number" name="actual_dry_f" id="actual_dry_f"
                                       placeholder="Actual Dry Female" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">Actual Exper Male</label>
                                <input type="number" name="actual_exper_m" id="actual_exper_m"
                                       placeholder="Actual Exper Male" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">Actual Exper Female</label>
                                <input type="number" name="actual_exper_f" id="actual_exper_f"
                                       placeholder="Actual Exper Female" class="form-control" />
                            </div>

                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">LSM</label>
                                <input type="number" name="lsm" id="lsm"
                                       placeholder="LSM" class="form-control" />
                            </div>

                            <div class="col-md-4 form-group text-input-container">
                                <label class="control-label">Contact Person</label>
                                <input type="text" name="contact_person" id="contact_person"
                                       placeholder="Contact Person" class="form-control" />
                            </div>

                            <div class="col-md-4 form-group text-input-container">
                                <label class="control-label">Contact Number</label>
                                <input type="text" name="contact_number" id="contact_number"
                                       placeholder="Contact Number" class="form-control" />
                            </div>

                            <div class="col-md-4 form-group text-input-container">
                                <label class="control-label">Contact Email</label>
                                <input type="email" name="contact_email" id="contact_email"
                                       placeholder="Contact Email" class="form-control" />
                            </div>

                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Remarks</label>
                                <input type="number" name="remarks" id="remarks"
                                       placeholder="Remarks" class="form-control" />
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
