@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <input type="hidden" name="job_order_id" id="jobOrderId" value="{{ $jo->id }}">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Productions<small> Department</small>
                    @if(Auth()->user()->department->slug != "productions")
                        <a href="/{{ Auth()->user()->department->slug }}" class="btn btn-default pull-right">
                            <i class="fa fa-home"></i> Go back</a>
                    @endif
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
                                <li><a href="#offset" data-toggle="tab">Print (Offset and/or Digital)</a></li>
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
        var file;
        $( document ).ready(function() {

            $('#tarp_file, #sticker_file, #offset_file, #booth_file, #staging_file, .file_upload').on('change', function (e) {
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

            $('#tarp_description').prop('selectedIndex',0);
            $('input[name=tarp_size]').val('');
            $('input[name=tarp_quantity]').val('');
            $('input[name=tarp_details]' ).val('');
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

            $('textarea#sticker_description').val('');
            $('input[name=sticker_size]').val('');
            $('input[name=sticker_quantity]').val('');
            $('input[name=sticker_materials]' ).val('');
            $('input[name=sticker_texture]' ).prop('checked', false);
            $('input[name=sticker_rendetion]' ).prop('checked', false);
            $('input[name=sticker_others]' ).val('');
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
            var stagingDetails = '';
            var stagingMicrophones = '';
            var stagingMicrophonesEx = '';

            if( stagingFormType == 'led' ){
                stagingDetails = 'Elevation Trussing : ' + $('input[name=staging_elevation]').val() + '<br>' +
                    'Hanged Trusses : ' + $('input[name=staging_hanged]').val() + '<br>' +
                    'Others : ' + $('input[name=staging_others]').val();
            }else if( stagingFormType == 'stage' ){
                stagingDetails = 'With Roofing : ' + $('input[name=roofing]:checked').val() + '<br>' +
                    'Trusses : ' + $('input[name=trusses]:checked').val() + '<br>' +
                    'Materials to be used : ' + $('input[name=staging_details]').val();
            }else if( stagingFormType == 'tents' ){
                stagingDetails = 'With Aircon : ' + $('input[name=aircon]:checked').val() + '<br>' +
                    'Supplier : ' + $('input[name=staging_details]').val();
            }else if( stagingFormType == 'iwata' ){
                stagingDetails = 'Supplier : ' + $('input[name=staging_details]').val();
            }else if( stagingFormType == 'sound' ){
                stagingDetails = $('input[name=staging_sounds]:checked').val() + '<br>' +
                    'Supplier : ' + $('input[name=staging_details]').val();
            }else if( stagingFormType == 'microphones' ){
                stagingDetails = '';
                if( $('input#wireless').is(':checked')){
                    stagingMicrophones += 'Wireless : ' + $('input[name=qty_wireless]').val() + '<br>';
                }

                if( $('input#wired').is(':checked')){
                    stagingMicrophones += 'Wired : ' + $('input[name=qty_wired]').val() + '<br>';
                }

                if( $('input#mic_stand').is(':checked')){
                    stagingMicrophones += 'Mic Stand : ' + $('input[name=qty_mic_stand]').val() + '<br>';
                }

                if( $('input#e-wireless').is(':checked')){
                    stagingMicrophonesEx += 'Wireless : ' + $('input[name=ex_qty_wireless]').val() + '<br>';
                }

                if( $('input#e-wired').is(':checked')){
                    stagingMicrophonesEx += 'Wired : ' + $('input[name=ex_qty_wired]').val() + '<br>';
                }

                stagingDetails = 'INTERNAL <br>' + stagingMicrophones + '<br><br>' +
                    'EXTERNAL OR RENTAL : ' + stagingMicrophonesEx;
            }else if( stagingFormType == 'tables' ){
                stagingDetails = $('input[name=staging_tables]:checked').val() + '<br>' +
                    'Supplier : ' + $('input[name=staging_details]').val();
            }else{
                stagingDetails =  $('input[name=staging_details]').val();
            }

            saveProductions( jobOrderId,
                $('input[name=production_staging]').val(),
                $('#staging_description option:selected').text(),
                null,
                $('input[name=staging_quantity]').val(),
                stagingDetails
            );
        }

        String.prototype.capitalize = function() {
            return this.charAt(0).toUpperCase() + this.slice(1);
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
            var code = '';
            let url = `/api/v1/productions/${jobOrderId}/details/`;
            axios.post(url, form).then(function(res) {

                if( prodType == 'tarpaulin' ){
                    $.each(res, function(i, data){
                        code = '<tr id="'+data.type+'Row'+data.id+'"><td><span class="span'+data.type+data.id+' '+data.type+'Description'+data.id+'">'+data.description+'</span><select class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" name="'+data.type+'_description_edit'+data.id+'" id="'+data.type+'_description_edit'+data.id+'" value="'+data.description+'"><option value="">Select...</option><option value="'+data.type+'">'+data.type+' Tent Headers</option><option value="barricade">Barricade and Streamers</option><option value="boards">A Boards</option></select></td><td><a href="productions/'+data.visuals+'" class="span'+data.type+data.id+' '+data.type+'Visuals'+data.id+'" target="_blank">'+data.visuals+'</a><input class="form-control file_upload '+data.type+'Inputs'+data.id+'" style="display:none" type="file" name="'+data.type+'_file_edit'+data.id+'" id="'+data.type+'_file_edit'+data.id+'" value="productions/'+data.visuals+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Sizes'+data.id+'">'+data.sizes+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_size_edit'+data.id+'" id="tarp_size_edit'+data.id+'" placeholder="size" value="'+data.sizes+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Qty'+data.id+'">'+data.qty+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="integer" name="'+data.type+'_quantity_edit'+data.id+'" id="tarp_quantity_edit'+data.id+'" placeholder="quantity" value="'+data.qty+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Details'+data.id+'">'+data.details+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_details_edit'+data.id+'" id="tarp_details_edit'+data.id+'" placeholder="details" value="'+data.details+'"/></td><td><div id="col1"><button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important '+data.type+'Update'+data.id+'" onclick="updateProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn glyphicon glyphicon-edit '+data.type+'Edit'+data.id+'" aria-hidden="true" onclick="editProduction(\''+data.type+'\','+data.id+')"></button></div><div id="col2"><button class="btn btn-danger glyphicon glyphicon-trash '+data.type+'Trash'+data.id+'" onclick="trashProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn btn-danger hidden-not-important '+data.type+'Delete'+data.id+'" onclick="deleteProduction(\''+data.type+'\', '+data.id+')" aria-hidden="true">Delete</button></div></td></tr>';
                        return false;
                    });
                }else if( prodType == 'sticker' ){
                    $.each(res, function(i, data){
                        code = '<tr id="'+data.type+'Row'+data.id+'"><td><span class="span'+data.type+data.id+' '+data.type+'Description'+data.id+'">'+data.description+'</span><textarea class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" name="'+data.type+'_description_edit'+data.id+'" id="'+data.type+'_description_edit'+data.id+'" value="'+data.description+'" cols="20" rows="5">'+ nl2br(data.description) +'</textarea></td><td><a href="productions/'+data.visuals+'" class="span'+data.type+data.id+' '+data.type+'Visuals'+data.id+'" target="_blank">'+data.visuals+'</a><input class="form-control file_upload '+data.type+'Inputs'+data.id+'" style="display:none" type="file" name="'+data.type+'_file_edit'+data.id+'" id="'+data.type+'_file_edit'+data.id+'" value="productions/'+data.visuals+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Sizes'+data.id+'">'+data.sizes+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_size_edit'+data.id+'" id="tarp_size_edit'+data.id+'" placeholder="size" value="'+data.sizes+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Qty'+data.id+'">'+data.qty+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="integer" name="'+data.type+'_quantity_edit'+data.id+'" id="tarp_quantity_edit'+data.id+'" placeholder="quantity" value="'+data.qty+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Details'+data.id+'">'+data.details+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_details_edit'+data.id+'" id="tarp_details_edit'+data.id+'" placeholder="details" value="'+nl2br(data.details)+'"/></td><td><div id="col1"><button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important '+data.type+'Update'+data.id+'" onclick="updateProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn glyphicon glyphicon-edit '+data.type+'Edit'+data.id+'" aria-hidden="true" onclick="editProduction(\''+data.type+'\','+data.id+')"></button></div><div id="col2"><button class="btn btn-danger glyphicon glyphicon-trash '+data.type+'Trash'+data.id+'" onclick="trashProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn btn-danger hidden-not-important '+data.type+'Delete'+data.id+'" onclick="deleteProduction(\''+data.type+'\', '+data.id+')" aria-hidden="true">Delete</button></div></td></tr>';
                        return false;
                    });
                }else if( prodType == 'offset' ){
                    $.each(res, function(i, data){
                        code = '<tr id="'+data.type+'Row'+data.id+'"><td><span class="span'+data.type+data.id+' '+data.type+'Description'+data.id+'">'+data.description+'</span><input type="text" class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" name="'+data.type+'_description_edit'+data.id+'" id="'+data.type+'_description_edit'+data.id+'" value="'+data.description+'" /></td><td><a href="productions/'+data.visuals+'" class="span'+data.type+data.id+' '+data.type+'Visuals'+data.id+'" target="_blank">'+data.visuals+'</a><input class="form-control file_upload '+data.type+'Inputs'+data.id+'" style="display:none" type="file" name="'+data.type+'_file_edit'+data.id+'" id="'+data.type+'_file_edit'+data.id+'" value="productions/'+data.visuals+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Sizes'+data.id+'">'+data.sizes+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_size_edit'+data.id+'" id="tarp_size_edit'+data.id+'" placeholder="size" value="'+data.sizes+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Qty'+data.id+'">'+data.qty+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="integer" name="'+data.type+'_quantity_edit'+data.id+'" id="tarp_quantity_edit'+data.id+'" placeholder="quantity" value="'+data.qty+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Details'+data.id+'">'+data.details+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_details_edit'+data.id+'" id="tarp_details_edit'+data.id+'" placeholder="details" value="'+nl2br(data.details)+'"/></td><td><div id="col1"><button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important '+data.type+'Update'+data.id+'" onclick="updateProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn glyphicon glyphicon-edit '+data.type+'Edit'+data.id+'" aria-hidden="true" onclick="editProduction(\''+data.type+'\','+data.id+')"></button></div><div id="col2"><button class="btn btn-danger glyphicon glyphicon-trash '+data.type+'Trash'+data.id+'" onclick="trashProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn btn-danger hidden-not-important '+data.type+'Delete'+data.id+'" onclick="deleteProduction(\''+data.type+'\', '+data.id+')" aria-hidden="true">Delete</button></div></td></tr>';
                        return false;
                    });
                }else if( prodType == 'booth' || prodType == 'photowall' || prodType == 'shirts' ){
                    $.each(res, function(i, data){
                        code = '<tr id="'+data.type+'Row'+data.id+'"><td><span class="span'+data.type+data.id+' '+data.type+'Description'+data.id+'">'+data.description+'</span><input type="text" class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" name="'+data.type+'_description_edit'+data.id+'" id="'+data.type+'_description_edit'+data.id+'" value="'+data.description+'" /></td><td><a href="productions/'+data.visuals+'" class="span'+data.type+data.id+' '+data.type+'Visuals'+data.id+'" target="_blank">'+data.visuals+'</a><input class="form-control file_upload '+data.type+'Inputs'+data.id+'" style="display:none" type="file" name="'+data.type+'_file_edit'+data.id+'" id="'+data.type+'_file_edit'+data.id+'" value="productions/'+data.visuals+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Qty'+data.id+'">'+data.qty+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="integer" name="'+data.type+'_quantity_edit'+data.id+'" id="tarp_quantity_edit'+data.id+'" placeholder="quantity" value="'+data.qty+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Details'+data.id+'">'+data.details+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_details_edit'+data.id+'" id="tarp_details_edit'+data.id+'" placeholder="details" value="'+nl2br(data.details)+'"/></td><td><div id="col1"><button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important '+data.type+'Update'+data.id+'" onclick="updateProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn glyphicon glyphicon-edit '+data.type+'Edit'+data.id+'" aria-hidden="true" onclick="editProduction(\''+data.type+'\','+data.id+')"></button></div><div id="col2"><button class="btn btn-danger glyphicon glyphicon-trash '+data.type+'Trash'+data.id+'" onclick="trashProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn btn-danger hidden-not-important '+data.type+'Delete'+data.id+'" onclick="deleteProduction(\''+data.type+'\', '+data.id+')" aria-hidden="true">Delete</button></div></td></tr>';
                        return false;
                    });
                }else if( prodType == 'staging' ){
                    $.each(res, function(i, data){
                        code = '<tr id="'+data.type+'Row'+data.id+'"><td><span class="span'+data.type+data.id+' '+data.type+'Description'+data.id+'">'+data.description+'</span><select class="form-control  hidden-not-important '+data.type+'Inputs'+data.id+'" name="'+data.type+'_description_edit'+data.id+'" id="'+data.type+'_description_edit'+data.id+'" onchange="loadStagingInputsForEdit( this.value, '+data.id+' )"> <option value="none">Select...</option> <option value="led">LED</option> <option value="stage">Stage</option> <option value="tents">Tents</option> <option value="iwata">Iwata Fans</option> <option value="clothes">Black / Blue Clothes</option> <option value="wire">Wire Clips</option> <option value="sound">Sound System</option> <option value="microphones">Microphones</option> <option value="tables">Tables</option> <option value="accordions">Accordions</option> <option value="others">Others</option> </select></td><td><a href="productions/'+data.visuals+'" class="span'+data.type+data.id+' '+data.type+'Visuals'+data.id+'" target="_blank">'+data.visuals+'</a><input class="form-control file_upload '+data.type+'Inputs'+data.id+'" style="display:none" type="file" name="'+data.type+'_file_edit'+data.id+'" id="'+data.type+'_file_edit'+data.id+'" value="productions/'+data.visuals+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Qty'+data.id+'">'+data.qty+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="integer" name="'+data.type+'_quantity_edit'+data.id+'" id="tarp_quantity_edit'+data.id+'" placeholder="quantity" value="'+data.qty+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Details'+data.id+'">'+data.details+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_details_edit'+data.id+'" id="tarp_details_edit'+data.id+'" placeholder="details" value="'+data.details+'"/></td><td><div id="col1"><button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important '+data.type+'Update'+data.id+'" onclick="updateProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn glyphicon glyphicon-edit '+data.type+'Edit'+data.id+'" aria-hidden="true" onclick="editProduction(\''+data.type+'\','+data.id+')"></button></div><div id="col2"><button class="btn btn-danger glyphicon glyphicon-trash '+data.type+'Trash'+data.id+'" onclick="trashProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn btn-danger hidden-not-important '+data.type+'Delete'+data.id+'" onclick="deleteProduction(\''+data.type+'\', '+data.id+')" aria-hidden="true">Delete</button></div></td></tr>';
                        return false;
                    });
                }

                $('tbody#tbody_'+prodType).prepend(code);
                toastr.success('Successfully saved production details', 'Success')
            }).catch(function(error) {
                console.log(error);
                toastr.error('Failed in saving production details', 'Error')
            });
        }

        function nl2br (str, is_xhtml) {
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }
        
        function loadStagingInputs(elet) {
            stagingFormType = elet;

            $('td#event_staging_details').empty();

            var stagingContent = '';

            if( elet == 'led' ){
                stagingContent = '<div class="row">\n<div class="col-xs-4">\nElevation Trussing :\n</div>\n<div class="col-xs-8">\n<input class="form-control" type="text" name="staging_elevation" id="staging_elevation">\n</div>\n</div>\n<div class="row">\n<div class="col-xs-4">\nHanged Trusses :\n</div>\n<div class="col-xs-8">\n<input class="form-control" type="text" name="staging_hanged" id="staging_hanged">\n</div>\n</div>\n<div class="row">\n<div class="col-xs-4">\nOthers :\n</div>\n<div class="col-xs-8">\n<input class="form-control" type="text" name="staging_others" id="staging_others">\n</div>\n</div>';
            }else if( elet == 'stage' ){
                stagingContent = '<div class="row">\n<div class="col-xs-12">\nWith Roofing :\n</div>\n<div class="col-xs-12">\n<ul class="list-inline">\n<li>\n<label for="roofingY">\n<input id="roofingY" type="radio" name="roofing" value="Yes"> Yes\n</label>\n</li>\n<li>\n<label for="roofingN">\n<input id="roofingN" type="radio" name="roofing" value="NO"> No\n</label>\n</li>\n</ul>\n</div>\n<div class="col-xs-12">\nTrusses :\n</div>\n<div class="col-xs-12">\n<ul class="list-inline">\n<li>\n<label for="trussesY">\n<input id="trussesY" type="radio" name="trusses"> Yes\n</label>\n</li>\n<li>\n<label for="roofingN">\n<input id="trussesN" type="radio" name="trusses"> No\n</label>\n</li>\n</ul>\n</div>\n<div class="col-xs-4">Materials to be used :</div>\n<div class="col-xs-8">\n<input class="form-control" type="text" name="staging_details" id="staging_details">\n</div>\n</div>';
            }else if( elet == 'tents' ){
                stagingContent = '<div class="row">\n<div class="col-xs-12">\nWith Aircon :\n</div>\n<div class="col-xs-12">\n<ul class="list-inline">\n<li>\n<label for="airconY">\n<input id="airconY" type="radio" name="aircon"> Yes\n</label>\n</li>\n<li>\n<label for="roofingN">\n<input id="airconN" type="radio" name="aircon"> No\n</label>\n</li>\n</ul>\n</div>\n<div class="col-xs-3">Supplier :</div>\n<div class="col-xs-9">\n<input class="form-control" type="text" name="staging_details" id="staging_details">\n</div>\n</div>';
            }else if( elet == 'iwata' ){
                stagingContent = '<div class="row"><div class="col-xs-3">Supplier :</div><div class="col-xs-9"><input class="form-control" type="text" name="staging_details" id="staging_details"></div></div>';
            }else if( elet == 'sound' ){
                stagingContent = '<div class="row">\n<div class="col-xs-12">\n<label for="table_selection">\n<input type="radio" name="staging_sounds" id="table_selection" value="internal"> Internal\n</label>\n</div>\n<div class="col-xs-12">\n<label for="table_selection1">\n<input type="radio" name="staging_sounds" id="table_selection1" value="external or rental"> External or Rental\n</label>\n</div>\n<div class="col-xs-6">Supplier :</div>\n<div class="col-xs-6"><input class="form-control" type="text" name="staging_details" id="staging_details"></div>\n</div>';
            }else if( elet == 'microphones' ){
                stagingContent = '<div class="row">\n<div class="col-xs-12 text-center">INTERNAL</div>\n</div>\n<div class="row">\n<div class="col-xs-4">\n<label for="wireless">\n<input type="checkbox" id="wireless" name="staging_wireless"> Wireless\n</label>\n</div>\n<div class="col-xs-4">\n<label for="wired">\n<input type="checkbox" id="wired" name="staging_wired"> Wired\n</label>\n</div>\n<div class="col-xs-4">\n<label for="mic_stand">\n<input type="checkbox" id="mic_stand" name="staging_micstand"> Mic Stand\n</label>\n</div>\n</div>\n<div class="row">\n<div class="col-xs-1">\nQTY\n</div>\n<div class="col-xs-3">\n<input type="text" class="form-control" name="qty_wireless" id="qty_wireless">\n</div>\n<div class="col-xs-1">\nQTY\n</div>\n<div class="col-xs-3">\n<input type="text" class="form-control" name="qty_wired" id="qty_wired">\n</div>\n<div class="col-xs-1">\nQTY\n</div>\n<div class="col-xs-3">\n<input type="text" class="form-control" name="qty_mic_stand" id="qty_mic_stand">\n</div>\n</div>\n<hr>\n<div class="row">\n<div class="col-xs-12">EXTERNAL OR RENTAL</div>\n<div class="col-xs-6">\n<label for="e-wireless">\n<input type="checkbox" name="ex_wireless" id="e-wireless"> Wireless\n</label>\n</div>\n<div class="col-xs-6">\n<label for="e-wired">\n<input type="checkbox" name="ex_wired" id="e-wired"> Wired\n</label>\n</div>\n<div class="col-xs-2">\nQTY :\n</div>\n<div class="col-xs-4">\n<input type="text" class="form-control" name="ex_qty_wireless" id="ex_qty_mic_stand_wireless">\n</div>\n<div class="col-xs-2">\nQTY :\n</div>\n<div class="col-xs-4">\n<input type="text" class="form-control" name="ex_qty_wired" id="ex_qty_mic_stand_wired">\n</div>\n</div>';
            }else if( elet == 'tables' ){
                stagingContent = '<div class="row">\n<div class="col-xs-12">\n<label for="t-internal">\n<input type="radio" id="t-internal" name="staging_tables"> Internal\n</label>\n</div>\n<div class="col-xs-12">\n<label for="t-external">\n<input type="radio" id="t-external" name="staging_tables"> External\n</label>\n</div>\n<div class="col-xs-3">Supplier :</div>\n<div class="col-xs-9"><input class="form-control" type="text" name="staging_details" id="staging_details"></div>\n</div>';
            }else{
                stagingContent = '<div class="row"><div class="col-xs-12"><input class="form-control" type="text" name="staging_details" id="staging_details"></div></div>';
            }

            $('td#event_staging_details').append(stagingContent);
        }

        function loadStagingInputsForEdit(elet, productType, productID) {
            stagingFormType = elet;

            $('td#event_staging_details'+productID).empty();

            var stagingContent = '';


            if( elet == 'led' ){
                stagingContent = '<div class="row"><div class="col-xs-4">Elevation Trussing :</div><div class="col-xs-8"><input class="form-control" type="text" name="staging_elevation'+productID+''+productID+'" id="staging_elevation'+productID+'"></div></div><div class="row"><div class="col-xs-4">Hanged Trusses :</div><div class="col-xs-8"><input class="form-control" type="text" name="staging_hanged'+productID+'" id="staging_hanged'+productID+'"></div></div><div class="row"><div class="col-xs-4">Others :</div><div class="col-xs-8"><input class="form-control" type="text" name="staging_others'+productID+'" id="staging_others'+productID+'"></div></div>';
            }else if( elet == 'stage' ){
                stagingContent = '<div class="row"><div class="col-xs-12">With Roofing :</div><div class="col-xs-12"><ul class="list-inline"><li><label for="roofingY"><input id="roofingY'+productID+'" type="radio" name="roofing'+productID+'" value="Yes"> Yes</label></li><li><label for="roofingN"><input id="roofingN'+productID+'" type="radio" name="roofing'+productID+'" value="NO"> No</label></li></ul></div><div class="col-xs-12">Trusses :</div><div class="col-xs-12"><ul class="list-inline"><li><label for="trussesY"><input id="trussesY'+productID+'" type="radio" name="trusses'+productID+'"> Yes</label></li><li><label for="roofingN"><input id="trussesN'+productID+'" type="radio" name="trusses'+productID+'"> No</label></li></ul></div><div class="col-xs-4">Materials to be used :</div><div class="col-xs-8"><input class="form-control" type="text" name="staging_details'+productID+'" id="staging_details'+productID+'"></div></div>';
            }else if( elet == 'tents' ){
                stagingContent = '<div class="row"><div class="col-xs-12">With Aircon :</div><div class="col-xs-12"><ul class="list-inline"><li><label for="airconY"><input id="airconY'+productID+'" type="radio" name="aircon'+productID+'"> Yes</label></li><li><label for="roofingN"><input id="airconN'+productID+'" type="radio" name="aircon'+productID+'"> No</label></li></ul></div><div class="col-xs-3">Supplier :</div><div class="col-xs-9"><input class="form-control" type="text" name="staging_details'+productID+'" id="staging_details'+productID+'"></div></div>';
            }else if( elet == 'iwata' ){
                stagingContent = '<div class="row"><div class="col-xs-3">Supplier :</div><div class="col-xs-9"><input class="form-control" type="text" name="staging_details'+productID+'" id="staging_details'+productID+'"></div></div>';
            }else if( elet == 'sound' ){
                stagingContent = '<div class="row"><div class="col-xs-12"><label for="table_selection"><input type="radio" name="staging_sounds'+productID+'" id="table_selection'+productID+'" value="internal"> Internal</label></div><div class="col-xs-12"><label for="table_selection1"><input type="radio" name="staging_sounds'+productID+'" id="table_selection1'+productID+'" value="external or rental"> External or Rental</label></div><div class="col-xs-6">Supplier :</div><div class="col-xs-6"><input class="form-control" type="text" name="staging_details'+productID+'" id="staging_details'+productID+'"></div></div>';
            }else if( elet == 'microphones' ){
                stagingContent = '<div class="row"><div class="col-xs-12 text-center">INTERNAL</div></div><div class="row"><div class="col-xs-4"><label for="wireless"><input type="checkbox" id="wireless'+productID+'" name="staging_wireless'+productID+'"> Wireless</label></div><div class="col-xs-4"><label for="wired"><input type="checkbox" id="wired'+productID+'" name="staging_wired'+productID+'"> Wired</label></div><div class="col-xs-4"><label for="mic_stand"><input type="checkbox" id="mic_stand'+productID+'" name="staging_micstand'+productID+'"> Mic Stand</label></div></div><div class="row"><div class="col-xs-1">QTY</div><div class="col-xs-3"><input type="text" class="form-control" name="qty_wireless'+productID+'" id="qty_wireless'+productID+'"></div><div class="col-xs-1">QTY</div><div class="col-xs-3"><input type="text" class="form-control" name="qty_wired'+productID+'" id="qty_wired'+productID+'"></div><div class="col-xs-1">QTY</div><div class="col-xs-3"><input type="text" class="form-control" name="qty_mic_stand'+productID+'" id="qty_mic_stand'+productID+'"></div></div><hr><div class="row"><div class="col-xs-12">EXTERNAL OR RENTAL</div><div class="col-xs-6"><label for="e-wireless"><input type="checkbox" name="ex_wireless'+productID+'" id="e-wireless'+productID+'"> Wireless</label></div><div class="col-xs-6"><label for="e-wired"><input type="checkbox" name="ex_wired'+productID+'" id="e-wired'+productID+'"> Wired</label></div><div class="col-xs-2">QTY :</div><div class="col-xs-4"><input type="text" class="form-control" name="ex_qty_wireless'+productID+'" id="ex_qty_mic_stand_wireless'+productID+'"></div><div class="col-xs-2">QTY :</div><div class="col-xs-4"><input type="text" class="form-control" name="ex_qty_wired'+productID+'" id="ex_qty_mic_stand_wired'+productID+'"></div></div>';
            }else if( elet == 'tables' ){
                stagingContent = '<div class="row"><div class="col-xs-12"><label for="t-internal"><input type="radio" id="t-internal'+productID+'" name="staging_tables'+productID+'"> Internal</label></div><div class="col-xs-12"><label for="t-external"><input type="radio" id="t-external'+productID+'" name="staging_tables'+productID+'"> External</label></div><div class="col-xs-3">Supplier :</div><div class="col-xs-9"><input class="form-control" type="text" name="staging_details'+productID+'" id="staging_details'+productID+'"></div></div>';
            }else{
                stagingContent = '<div class="row"><div class="col-xs-12"><input class="form-control" type="text" name="staging_details'+productID+'" id="staging_details'+productID+'"></div></div>';
            }

            $('td#event_staging_details'+productID).append(stagingContent);
        }
        
        function editProduction(productionType, productionID) {
            $('.' + productionType + 'Update' + productionID).show();
            $('.' + productionType + 'Edit' + productionID).hide();
            $('.span'+ productionType + productionID).hide();
            $('.'+productionType+'Inputs' + productionID).removeClass('hidden-not-important');
            $('#'+productionType+'_file_edit'+ productionID).css('display','block');

            if( productionType == 'tarpaulin' || productionType == 'staging' ){
                $('#'+productionType+'_description_edit' + productionID + ' option:selected').text( $('.'+productionType+'Description' + productionID).text() );
            }else {
                $('#'+productionType+'_description_edit' + productionID ).text( $('.'+productionType+'Description' + productionID).text() );
            }
        }

        function updateProduction(productionType, productionID) {
            $('.' + productionType + 'Update' + productionID).hide();
            $('.' + productionType + 'Edit' + productionID).show();

            $('.span' + productionType + productionID).show();
            $('.' + productionType + 'Inputs' + productionID).addClass('hidden-not-important');
            $('#' + productionType + '_file_edit'+ productionID).css('display','none');

            var jobOrderId = $('#jobOrderId').val();
            var description = '';

            if( productionType == 'tarpaulin' ){
                description = $('#' + productionType + '_description_edit' + productionID + ' option:selected').text();
            }else if( productionType == 'sticker' ){
                description = $('textarea#' + productionType + '_description_edit' + productionID).val();
            }else{
                description = $('#' + productionType + '_description_edit' + productionID).val();
            }

            if( (description.trim() == '') || (description.trim() == null) ){
//                console.log('null');
                return;
            }

            //ajax here
            let form = new FormData();
            form.append('job_order_id', jobOrderId);
            form.append('_token', $('input[name=_token]' ).val());
            form.append('production_id', productionID);
            form.append('description', description);
            form.append('visuals', file);
            form.append('sizes', $('input[name='+ productionType +'_size_edit'+ productionID + ']').val());
            form.append('qty', $('input[name='+ productionType +'_quantity_edit'+ productionID + ']').val());
            form.append('details', $('input[name='+ productionType +'_details_edit'+ productionID + ']').val());

            let url = `/api/v1/productions/${jobOrderId}/details/update/`;
            axios.post(url, form).then(function(res) {
                var code = '';

                if( productionType == 'tarpaulin' ){
                    $.each(res, function(i, data){
                        code = '<tr id="'+data.type+'Row'+data.id+'"><td><span class="span'+data.type+data.id+' '+data.type+'Description'+data.id+'">'+data.description+'</span><select class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" name="'+data.type+'_description_edit'+data.id+'" id="'+data.type+'_description_edit'+data.id+'" value="'+data.description+'"><option value="">Select...</option><option value="'+data.type+'">'+data.type+' Tent Headers</option><option value="barricade">Barricade and Streamers</option><option value="boards">A Boards</option></select></td><td><a href="productions/'+data.visuals+'" class="span'+data.type+data.id+' '+data.type+'Visuals'+data.id+'" target="_blank">'+data.visuals+'</a><input class="form-control file_upload '+data.type+'Inputs'+data.id+'" style="display:none" type="file" name="'+data.type+'_file_edit'+data.id+'" id="'+data.type+'_file_edit'+data.id+'" value="productions/'+data.visuals+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Sizes'+data.id+'">'+data.sizes+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_size_edit'+data.id+'" id="tarp_size_edit'+data.id+'" placeholder="size" value="'+data.sizes+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Qty'+data.id+'">'+data.qty+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="integer" name="'+data.type+'_quantity_edit'+data.id+'" id="tarp_quantity_edit'+data.id+'" placeholder="quantity" value="'+data.qty+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Details'+data.id+'">'+data.details+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_details_edit'+data.id+'" id="tarp_details_edit'+data.id+'" placeholder="details" value="'+data.details+'"/></td><td><div id="col1"><button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important '+data.type+'Update'+data.id+'" onclick="updateProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn glyphicon glyphicon-edit '+data.type+'Edit'+data.id+'" aria-hidden="true" onclick="editProduction(\''+data.type+'\','+data.id+')"></button></div><div id="col2"><button class="btn btn-danger glyphicon glyphicon-trash '+data.type+'Trash'+data.id+'" onclick="trashProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn btn-danger hidden-not-important '+data.type+'Delete'+data.id+'" onclick="deleteProduction(\''+data.type+'\', '+data.id+')" aria-hidden="true">Delete</button></div></td></tr>';
                        $('#'+data.type+'Row'+data.id).replaceWith(code);
                        return false;
                    });
                }else if( productionType == 'sticker' ){
                    $.each(res, function(i, data){
                        code = '<tr id="'+data.type+'Row'+data.id+'"><td><span class="span'+data.type+data.id+' '+data.type+'Description'+data.id+'">'+data.description+'</span><textarea class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" name="'+data.type+'_description_edit'+data.id+'" id="'+data.type+'_description_edit'+data.id+'" value="'+data.description+'" cols="20" rows="5">'+ nl2br(data.description) +'</textarea></td><td><a href="productions/'+data.visuals+'" class="span'+data.type+data.id+' '+data.type+'Visuals'+data.id+'" target="_blank">'+data.visuals+'</a><input class="form-control file_upload '+data.type+'Inputs'+data.id+'" style="display:none" type="file" name="'+data.type+'_file_edit'+data.id+'" id="'+data.type+'_file_edit'+data.id+'" value="productions/'+data.visuals+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Sizes'+data.id+'">'+data.sizes+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_size_edit'+data.id+'" id="tarp_size_edit'+data.id+'" placeholder="size" value="'+data.sizes+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Qty'+data.id+'">'+data.qty+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="integer" name="'+data.type+'_quantity_edit'+data.id+'" id="tarp_quantity_edit'+data.id+'" placeholder="quantity" value="'+data.qty+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Details'+data.id+'">'+data.details+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_details_edit'+data.id+'" id="tarp_details_edit'+data.id+'" placeholder="details" value="'+nl2br(data.details)+'"/></td><td><div id="col1"><button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important '+data.type+'Update'+data.id+'" onclick="updateProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn glyphicon glyphicon-edit '+data.type+'Edit'+data.id+'" aria-hidden="true" onclick="editProduction(\''+data.type+'\','+data.id+')"></button></div><div id="col2"><button class="btn btn-danger glyphicon glyphicon-trash '+data.type+'Trash'+data.id+'" onclick="trashProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn btn-danger hidden-not-important '+data.type+'Delete'+data.id+'" onclick="deleteProduction(\''+data.type+'\', '+data.id+')" aria-hidden="true">Delete</button></div></td></tr>';
                        $('#'+data.type+'Row'+data.id).replaceWith(code);
                        return false;
                    });
                }else if( productionType == 'offset' ){
                    $.each(res, function(i, data){
                        code = '<tr id="'+data.type+'Row'+data.id+'"><td><span class="span'+data.type+data.id+' '+data.type+'Description'+data.id+'">'+data.description+'</span><input type="text" class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" name="'+data.type+'_description_edit'+data.id+'" id="'+data.type+'_description_edit'+data.id+'" value="'+data.description+'" /></td><td><a href="productions/'+data.visuals+'" class="span'+data.type+data.id+' '+data.type+'Visuals'+data.id+'" target="_blank">'+data.visuals+'</a><input class="form-control file_upload '+data.type+'Inputs'+data.id+'" style="display:none" type="file" name="'+data.type+'_file_edit'+data.id+'" id="'+data.type+'_file_edit'+data.id+'" value="productions/'+data.visuals+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Sizes'+data.id+'">'+data.sizes+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_size_edit'+data.id+'" id="tarp_size_edit'+data.id+'" placeholder="size" value="'+data.sizes+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Qty'+data.id+'">'+data.qty+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="integer" name="'+data.type+'_quantity_edit'+data.id+'" id="tarp_quantity_edit'+data.id+'" placeholder="quantity" value="'+data.qty+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Details'+data.id+'">'+data.details+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_details_edit'+data.id+'" id="tarp_details_edit'+data.id+'" placeholder="details" value="'+nl2br(data.details)+'"/></td><td><div id="col1"><button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important '+data.type+'Update'+data.id+'" onclick="updateProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn glyphicon glyphicon-edit '+data.type+'Edit'+data.id+'" aria-hidden="true" onclick="editProduction(\''+data.type+'\','+data.id+')"></button></div><div id="col2"><button class="btn btn-danger glyphicon glyphicon-trash '+data.type+'Trash'+data.id+'" onclick="trashProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn btn-danger hidden-not-important '+data.type+'Delete'+data.id+'" onclick="deleteProduction(\''+data.type+'\', '+data.id+')" aria-hidden="true">Delete</button></div></td></tr>';
                        $('#'+data.type+'Row'+data.id).replaceWith(code);
                        return false;
                    });
                }else if( productionType == 'booth' || productionType == 'photowall' || productionType == 'shirts' ){
                    $.each(res, function(i, data){
                        code = '<tr id="'+data.type+'Row'+data.id+'"><td><span class="span'+data.type+data.id+' '+data.type+'Description'+data.id+'">'+data.description+'</span><input type="text" class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" name="'+data.type+'_description_edit'+data.id+'" id="'+data.type+'_description_edit'+data.id+'" value="'+data.description+'" /></td><td><a href="productions/'+data.visuals+'" class="span'+data.type+data.id+' '+data.type+'Visuals'+data.id+'" target="_blank">'+data.visuals+'</a><input class="form-control file_upload '+data.type+'Inputs'+data.id+'" style="display:none" type="file" name="'+data.type+'_file_edit'+data.id+'" id="'+data.type+'_file_edit'+data.id+'" value="productions/'+data.visuals+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Qty'+data.id+'">'+data.qty+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="integer" name="'+data.type+'_quantity_edit'+data.id+'" id="tarp_quantity_edit'+data.id+'" placeholder="quantity" value="'+data.qty+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Details'+data.id+'">'+data.details+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_details_edit'+data.id+'" id="tarp_details_edit'+data.id+'" placeholder="details" value="'+nl2br(data.details)+'"/></td><td><div id="col1"><button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important '+data.type+'Update'+data.id+'" onclick="updateProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn glyphicon glyphicon-edit '+data.type+'Edit'+data.id+'" aria-hidden="true" onclick="editProduction(\''+data.type+'\','+data.id+')"></button></div><div id="col2"><button class="btn btn-danger glyphicon glyphicon-trash '+data.type+'Trash'+data.id+'" onclick="trashProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn btn-danger hidden-not-important '+data.type+'Delete'+data.id+'" onclick="deleteProduction(\''+data.type+'\', '+data.id+')" aria-hidden="true">Delete</button></div></td></tr>';
                        $('#'+data.type+'Row'+data.id).replaceWith(code);
                        return false;
                    });
                }else if( productionType == 'staging' ){
                    $.each(res, function(i, data){
                        code = '<tr id="'+data.type+'Row'+data.id+'"><td><span class="span'+data.type+data.id+' '+data.type+'Description'+data.id+'">'+data.description+'</span><input type="text" class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" name="'+data.type+'_description_edit'+data.id+'" id="'+data.type+'_description_edit'+data.id+'" value="'+data.description+'" /></td><td><a href="productions/'+data.visuals+'" class="span'+data.type+data.id+' '+data.type+'Visuals'+data.id+'" target="_blank">'+data.visuals+'</a><input class="form-control file_upload '+data.type+'Inputs'+data.id+'" style="display:none" type="file" name="'+data.type+'_file_edit'+data.id+'" id="'+data.type+'_file_edit'+data.id+'" value="productions/'+data.visuals+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Qty'+data.id+'">'+data.qty+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="integer" name="'+data.type+'_quantity_edit'+data.id+'" id="tarp_quantity_edit'+data.id+'" placeholder="quantity" value="'+data.qty+'"/></td><td><span class="span'+data.type+data.id+' '+data.type+'Details'+data.id+'">'+data.details+'</span><input class="form-control hidden-not-important '+data.type+'Inputs'+data.id+'" type="text" name="'+data.type+'_details_edit'+data.id+'" id="tarp_details_edit'+data.id+'" placeholder="details" value="'+data.details+'"/></td><td><div id="col1"><button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important '+data.type+'Update'+data.id+'" onclick="updateProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn glyphicon glyphicon-edit '+data.type+'Edit'+data.id+'" aria-hidden="true" onclick="editProduction(\''+data.type+'\','+data.id+')"></button></div><div id="col2"><button class="btn btn-danger glyphicon glyphicon-trash '+data.type+'Trash'+data.id+'" onclick="trashProduction(\''+data.type+'\','+data.id+')" aria-hidden="true"></button><button class="btn btn-danger hidden-not-important '+data.type+'Delete'+data.id+'" onclick="deleteProduction(\''+data.type+'\', '+data.id+')" aria-hidden="true">Delete</button></div></td></tr>';
                        $('#'+data.type+'Row'+data.id).replaceWith(code);
                        return false;
                    });
                }

                toastr.success('Successfully saved event details', 'Success')
            }).catch(function(error) {
                toastr.error('Failed in saving event details', 'Error')
            });
        }

        function trashProduction(productionType, productionID) {

            if( $('.' + productionType + 'Delete' + productionID).is(":visible") ){

                $('.' + productionType + 'Delete' + productionID).hide();
                $('.' + productionType + 'Trash' + productionID).removeClass('glyphicon-remove');
                $('.' + productionType + 'Trash' + productionID).addClass('btn-danger glyphicon-trash');

                if( !$('.' + productionType + 'Update' + productionID).is(":visible") ){
                    $('.' + productionType + 'Edit' + productionID).show();
                }
            }else{
                $('.' + productionType + 'Delete' + productionID).show();
                $('.' + productionType + 'Trash' + productionID).removeClass('btn-danger glyphicon-trash');
                $('.' + productionType + 'Trash' + productionID).addClass('glyphicon-remove');
                $('.' + productionType + 'Edit' + productionID).hide();
            }
        }
        
        function deleteProduction( productionType, productionID ) {

            trashProduction( productionType, productionID );

            let form = new FormData();
            form.append('_token', $('input[name=_token]' ).val());
            form.append('production_id', productionID);

            let url = `/api/v1/productions/${jobOrderId}/details/delete/`;
            axios.post(url, form).then(function(res) {
                $('#'+productionType+'Row'+productionID).remove();
                toastr.success('Successfully deleted', 'Success')
            }).catch(function(error) {
                toastr.error('Failed to delete', 'Error')
            });

        }

        function saveCosting( productionType, joNo) {

            let form = new FormData();
            form.append('_token', $('input[name=_token]' ).val());
            form.append('job_order_no', joNo );
            form.append('production_type', productionType );
            form.append('company_name', $('input[name='+ productionType +'_supplier]' ).val());
            form.append('point_person', $('input[name='+ productionType +'_person]' ).val());
            form.append('contact', $('input[name='+ productionType +'_contact]' ).val());

            let url = `/api/v1/productions/costing/save/`;
            axios.post(url, form).then(function(res) {

                $.each(res, function(i, data){
                    $('#tbody_'+productionType+'_supplier').prepend('<tr id="'+productionType+'RowCosting'+data.id+'"><td>'+data.company_name+'</td><td>'+data.point_person+'</td><td>'+data.contact+'</td><td><div id="col2"><button class="btn btn-danger glyphicon glyphicon-trash '+productionType+'TrashCosting'+data.id+'" onclick="trashCosting(\''+productionType+'\',\''+data.id+'\')" aria-hidden="true"></button><button class="btn btn-danger hidden-not-important '+productionType+'DeleteCosting'+data.id+'" onclick="deleteCosting(\''+productionType+'\',\''+data.id+'\')" aria-hidden="true">Delete</button></div></td></tr>');
                    return false;
                });

                $('input[name='+ productionType +'_supplier]' ).val('');
                $('input[name='+ productionType +'_person]' ).val('');
                $('input[name='+ productionType +'_contact]' ).val('');

                toastr.success('Successfully saved event details', 'Success')
            }).catch(function(error) {
                toastr.error('Failed in saving event details', 'Error')
            });
        }
        
        function trashCosting( productionType, costingID ) {
            if( $('.' + productionType + 'DeleteCosting' + costingID).is(":visible") ){
                $('.' + productionType + 'DeleteCosting' + costingID).hide();
                $('.' + productionType + 'TrashCosting' + costingID).removeClass('glyphicon-remove');
                $('.' + productionType + 'TrashCosting' + costingID).addClass('btn-danger glyphicon-trash');
            }else{
                $('.' + productionType + 'DeleteCosting' + costingID).show();
                $('.' + productionType + 'TrashCosting' + costingID).removeClass('btn-danger glyphicon-trash');
                $('.' + productionType + 'TrashCosting' + costingID).addClass('glyphicon-remove');
            }
        }

        function deleteCosting( productionType, costingID ){

            trashProduction( productionType, costingID );

            let form = new FormData();
            form.append('_token', $('input[name=_token]' ).val());
            form.append('costing_id', costingID);

            let url = `/api/v1/productions/costing/delete/`;
            axios.post(url, form).then(function(res) {
                $('#'+productionType+'RowCosting'+costingID).remove();
                toastr.success('Successfully deleted supplier', 'Success')
            }).catch(function(error) {
                toastr.error('Failed in deleting supplier', 'Error')
            });
        }
    </script>
@endsection
