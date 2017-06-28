@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <input type="hidden" name="job_order_id" id="jobOrderId" value="{{ $jo->id }}">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Productions<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/productions"><i class="fa fa-dashboard"></i> Productions Department</a>
                    </li>
                    <li>
                        <a href="/productions/jo"><i class="fa fa-file-text-o"></i> Job Order Lists</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-list"></i> Job Order Details
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                            <span class="pull-right hidden">
                                <button class="btn btn-default" onclick="frames['frame'].print();">
                                    <i class="fa fa-print fa-lg"></i> Print
                                </button>
                            </span>

                        <h5> <b>Job Order Number: {{ $jo->job_order_no }}</b> </h5>
                        <h5> <b>Project Name: {{ $jo->project_name }}</b> </h5>
                        <h5> <strong>Deadline: {{ \Carbon\Carbon::createFromTimestamp(strtotime($jo->created_at))->toFormattedDateString() }}</strong> </h5>

                    </div>
                    <div class="panel-body">

                    </div>
                </div>
            </div>

            <div class="row productions">
                <div class="col-md-12 col-xs-12" style="padding-top: 10px;">
                    <div class="col-md-10 col-md-offset-1 vr">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tarpaulin" data-toggle="tab">Print (Tarpaulin)</a></li>
                                <li><a href="#stickers" data-toggle="tab">Print (Stickers)</a></li>
                                <li><a href="#offset" data-toggle="tab">Print (Offset and or Digital)</a></li>
                                <li><a href="#booth" data-toggle="tab">Booth</a></li>
                                <li><a href="#photowall" data-toggle="tab">Photowalls and Panels</a></li>
                                <li><a href="#shirts" data-toggle="tab">Shirts</a></li>
                                <li><a href="#staging" data-toggle="tab">Event Staging Requirements</a></li>
                            </ul>
                            <div class="tab-content">
                                @include('productions.jolist.details.print.tarpaulin.index')
                                @include('productions.jolist.details.print.stickers.index')
                                @include('productions.jolist.details.print.offset.index')
                                @include('productions.jolist.details.booth.index')
                                @include('productions.jolist.details.photowall.index')
                                @include('productions.jolist.details.shirts.index')
                                @include('productions.jolist.details.staging.index')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.tabledit.min.js') }}"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script>
        $('#tbl-tarpaulin').Tabledit({
//            url: 'example.php',
            columns: {
                identifier: [0, 'id'],
                editable: [
                    [1, 'visual', 'file'],
                    [2, 'size'],
                    [3, 'qty', 'number'],
                    [4, 'details']
                ]
            }
        });
        $('#tbl-stickers').Tabledit({
//            url: 'example.php',
            columns: {
                identifier: [0, 'id'],
                editable: [
                    [1, 'description', 'textarea', {row:4}],
                    [2, 'visual', 'file'],
                    [3, 'size'],
                    [4, 'qty', 'number']
                ]
            }
        });

        $('#tbl-offset').Tabledit({
//            url: 'example.php',
            columns: {
                identifier: [0, 'id'],
                editable: [
                    [1, 'description'],
                    [2, 'visual', 'file'],
                    [3, 'size'],
                    [4, 'qty', 'number'],
                    [5, 'details']
                ]
            }
        });

        $('#tbl-booth').Tabledit({
//            url: 'example.php',
            columns: {
                identifier: [0, 'id'],
                editable: [
                    [1, 'description'],
                    [2, 'visual', 'file'],
                    [3, 'qty', 'number'],
                    [4, 'materials']
                ]
            }
        });

        $('#tbl-photowall, #tbl-shirts').Tabledit({
//            url: 'example.php',
            columns: {
                identifier: [0, 'id'],
                editable: [
                    [1, 'description'],
                    [2, 'visual'],
                    [3, 'qty'],
                    [4, 'materials']
                ]
            }
        });


        var file;
        $( document ).ready(function() {

            $('#tarp_file, #sticker_file, #offset_file, #booth_file').on('change', function (e) {
                var files = e.target.files || e.dataTransfer.files;
//                console.log(files[0]);
                file = files[0];
            });

        });

        function saveTarpaulin() {
            var jobOrderId = $('#jobOrderId').val();

            saveProductions( jobOrderId,
                $('input[name=production_type]').val(),
                $('#tarp_description option:selected').text(),
                $('input[name=tarp_size]').val(),
                $('input[name=tarp_quantity]').val(),
                $('input[name=tarp_details]' ).val()
            );
        }

        function saveStickers() {
            var jobOrderId = $('#jobOrderId').val();

            var sticker_details = "Materials : " + $('input[name=sticker_materials]' ).val() + "<br>" +
                "Texture : " + $('input[name=sticker_texture]:checked' ).val() + "<br>" +
                "Rendention : " + $('input[name=sticker_rendetion]:checked' ).val() + "<br>" +
                "Others : " +$('input[name=sticker_others]' ).val();

            saveProductions( jobOrderId,
                $('input[name=production_sticker]').val(),
                $('textarea#sticker_description').val(),
                $('input[name=sticker_size]').val(),
                $('input[name=sticker_quantity]').val(),
                sticker_details
            );
        }

        function saveOffset() {
            var jobOrderId = $('#jobOrderId').val();
            saveProductions( jobOrderId,
                $('input[name=production_offset]').val(),
                $('input[name=offset_description]').val(),
                $('input[name=offset_size]').val(),
                $('input[name=offset_quantity]').val(),
                $('input[name=offset_details]').val()
            );
        }

        function saveBooth() {
            var jobOrderId = $('#jobOrderId').val();
            saveProductions( jobOrderId,
                $('input[name=production_booth]').val(),
                $('input[name=booth_description]').val(),
                null,
                $('input[name=booth_quantity]').val(),
                $('input[name=booth_details]').val()
            );
        }

        function savePhotowall() {
            var jobOrderId = $('#jobOrderId').val();
            saveProductions( jobOrderId,
                $('input[name=production_photowall]').val(),
                $('input[name=photowall_description]').val(),
                null,
                $('input[name=photowall_quantity]').val(),
                $('input[name=photowall_details]').val()
            );
        }

        function saveShirts() {
            var jobOrderId = $('#jobOrderId').val();
            saveProductions( jobOrderId,
                $('input[name=production_shirts]').val(),
                $('input[name=shirts_description]').val(),
                null,
                $('input[name=shirts_quantity]').val(),
                $('input[name=shirts_details]').val()
            );
        }

        var stagingFormType = '';
        function saveStaging() {
            var jobOrderId = $('#jobOrderId').val();

            if( stagingFormType == 'led' ){
                
            }else if( stagingFormType == 'stage' ){
            }else if( stagingFormType == 'tents' ){
            }else if( stagingFormType == 'iwata' ){
            }else if( stagingFormType == 'sound' ){
            }else if( stagingFormType == 'microphones' ){
            }else if( stagingFormType == 'tables' ){
            }else{
            }
s
            saveProductions( jobOrderId,
                $('input[name=production_staging]').val(),
                $('#staging_description option:selected').text(),
                null,
                $('input[name=staging_quantity]').val(),
                $('input[name=shirts_details]').val()
            );
        }

        function saveProductions( jobOrderId, prodType, desc, size, quantity, proDetails){
            let form = new FormData();
            form.append('job_order_id', jobOrderId);
            form.append('_token', $('input[name=_token]' ).val());
            form.append('production_type', prodType);
            form.append('description', desc);
            form.append('visuals', file);
            form.append('sizes', size);
            form.append('qty', quantity);
            form.append('details', proDetails);

            let url = `/api/v1/productions/${jobOrderId}/details/`;
            axios.post(url, form).then(function(res) {
                toastr.success('Successfully saved event details', 'Success')
            }).catch(function(error) {
                toastr.error('Failed in saving event details', 'Error')
            });
        }
        
        function loadStagingInputs(elet) {
            stagingFormType = elet;

            $('td#event_staging_details').empty();

            var stagingContent = '';
            if( elet == 'led' ){
                stagingContent = '<div class="row">\n<div class="col-xs-4">\nElevation Trussing :\n</div>\n<div class="col-xs-8">\n<input class="form-control" type="text" name="staging_elevation" id="staging_elevation">\n</div>\n</div>\n<div class="row">\n<div class="col-xs-4">\nHanged Trusses :\n</div>\n<div class="col-xs-8">\n<input class="form-control" type="text" name="staging_hanged" id="staging_hanged">\n</div>\n</div>\n<div class="row">\n<div class="col-xs-4">\nOthers :\n</div>\n<div class="col-xs-8">\n<input class="form-control" type="text" name="staging_others" id="staging_others">\n</div>\n</div>';
            }else if( elet == 'stage' ){
                stagingContent = '<div class="row">\n<div class="col-xs-12">\nWith Roofing :\n</div>\n<div class="col-xs-12">\n<ul class="list-inline">\n<li>\n<label for="roofingY">\n<input id="roofingY" type="radio" name="roofing"> Yes\n</label>\n</li>\n<li>\n<label for="roofingN">\n<input id="roofingN" type="radio" name="roofing"> No\n</label>\n</li>\n</ul>\n</div>\n<div class="col-xs-12">\nTrusses :\n</div>\n<div class="col-xs-12">\n<ul class="list-inline">\n<li>\n<label for="trussesY">\n<input id="trussesY" type="radio" name="trusses"> Yes\n</label>\n</li>\n<li>\n<label for="roofingN">\n<input id="trussesN" type="radio" name="trusses"> No\n</label>\n</li>\n</ul>\n</div>\n<div class="col-xs-4">Materials to be used :</div>\n<div class="col-xs-8">\n<input class="form-control" type="text" name="staging_details" id="staging_details">\n</div>\n</div>';
            }else if( elet == 'tents' ){
                stagingContent = '<div class="row">\n<div class="col-xs-12">\nWith Aircon :\n</div>\n<div class="col-xs-12">\n<ul class="list-inline">\n<li>\n<label for="airconY">\n<input id="airconY" type="radio" name="aircon"> Yes\n</label>\n</li>\n<li>\n<label for="roofingN">\n<input id="airconN" type="radio" name="aircon"> No\n</label>\n</li>\n</ul>\n</div>\n<div class="col-xs-6">Supplier :</div>\n<div class="col-xs-6">\n<input class="form-control" type="text" name="staging_details" id="staging_details">\n</div>\n</div>';
            }else if( elet == 'iwata' ){
                stagingContent = '<div class="row"><div class="col-xs-3">Supplier :</div><div class="col-xs-9"><input class="form-control" type="text" name="staging_details" id="staging_details"></div></div>';
            }else if( elet == 'sound' ){
                stagingContent = '<div class="row">\n<div class="col-xs-12">\n<label for="table_selection">\n<input type="radio" name="table_selection" id="table_selection"> Internal\n</label>\n</div>\n<div class="col-xs-12">\n<label for="table_selection1">\n<input type="radio" name="table_selection" id="table_selection1"> External or Rental\n</label>\n</div>\n<div class="col-xs-6">Supplier :</div>\n<div class="col-xs-6"><input class="form-control" type="text" name="staging_details" id="staging_details"></div>\n</div>';
            }else if( elet == 'microphones' ){
                stagingContent = '<div class="row">\n<div class="col-xs-12 text-center">INTERNAL</div>\n</div>\n<div class="row">\n<div class="col-xs-4">\n<label for="wireless">\n<input type="radio" id="wireless" name="staging_microphones"> Wireless\n</label>\n</div>\n<div class="col-xs-4">\n<label for="wired">\n<input type="radio" id="wired" name="staging_microphones"> Wired\n</label>\n</div>\n<div class="col-xs-4">\n<label for="mic-stand">\n<input type="radio" id="mic_stand" name="staging_microphones"> Mic Stand\n</label>\n</div>\n</div>\n<div class="row">\n<div class="col-xs-1">\nQTY\n</div>\n<div class="col-xs-3">\n<input type="text" class="form-control" name="qty_wireless" id="qty_wireless">\n</div>\n<div class="col-xs-1">\nQTY\n</div>\n<div class="col-xs-3">\n<input type="text" class="form-control" name="qty_wired" id="qty_wired">\n</div>\n<div class="col-xs-1">\nQTY\n</div>\n<div class="col-xs-3">\n<input type="text" class="form-control" name="qty_mic_stand" id="qty_mic_stand">\n</div>\n</div>\n<hr>\n<div class="row">\n<div class="col-xs-12">EXTERNAL OR RENTAL</div>\n<div class="col-xs-6">\n<label for="e-wireless">\n<input type="radio" name="ex_microphone" id="e-wireless"> Wireless\n</label>\n</div>\n<div class="col-xs-6">\n<label for="wired">\n<input type="radio" name="ex_microphone" id="e-wired"> Wired\n</label>\n</div>\n<div class="col-xs-2">\nQTY :\n</div>\n<div class="col-xs-4">\n<input type="text" class="form-control" name="ex_qty_wireless" id="ex_qty_mic_stand_wireless">\n</div>\n<div class="col-xs-2">\nQTY :\n</div>\n<div class="col-xs-4">\n<input type="text" class="form-control" name="ex_qty_wired" id="ex_qty_mic_stand_wired">\n</div>\n</div>';
            }else if( elet == 'tables' ){
                stagingContent = '<div class="row">\n<div class="col-xs-12">\n<label for="t-internal">\n<input type="radio" id="t-internal" name="staging_tables"> Internal\n</label>\n</div>\n<div class="col-xs-12">\n<label for="t-external">\n<input type="radio" id="t-external" name="staging_tables"> External\n</label>\n</div>\n<div class="col-xs-3">Supplier :</div>\n<div class="col-xs-9"><input class="form-control" type="text" name="staging_details" id="staging_details"></div>\n</div>';
            }else{
                stagingContent = '<div class="row"><div class="col-xs-12"><input class="form-control" type="text" name="staging_details" id="staging_details"></div></div>';
            }

            $('td#event_staging_details').append(stagingContent);
        }
    </script>
@endsection
