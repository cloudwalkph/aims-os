@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Accounting<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Accounting Department
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">
                <div class="col-md-3 div30days">30 days</div>
                <div class="col-md-3 div45days">45 days</div>
                <div class="col-md-3 div60days">60 days</div>
                <div class="col-md-3 text-center emergency">More than 120 days</div>
            </div>

            <div class="col-md-12">
                <table class="table table-striped" style="margin-top: 30px">
                    <thead>
                    <tr>
                        <td width="150">Job Order No.</td>
                        <td width="150">Contract Number</td>
                        <td width="400">AE Assigned</td>
                        <td width="200">Project Name</td>
                        <td width="200">Client</td>
                        <td width="150">Brand</td>
                        <td width="150">CE</td>
                        <td width="150">DO No. / PO</td>
                        <td width="150">Transmittal</td>
                        <td width="150">Invoice No.</td>
                        <td width="150">Paid</td>
                        <td width="150">Remarks</td>
                    </tr>
                    </thead>

                    <tbody id="tbody_accounts">
                        @foreach( $results as $jo)
                        <tr>
                            <td>{{$jo['joId']}}</td>
                            <td>

                                <?=$jo['coNo'] ?>

                                <form action="/accounting/cono" method="post">

                                    {{ csrf_field() }}
                                    <input type="hidden" name="joID" value="{{$jo['joId']}}">
                                    <input class="" name="cono" alt="28" placeholder="Contract No.">
                                    <button class="btn btn-primary" type="submit">Add</button>

                                </form>

                            </td>
                            <td>
                                {{$jo['assigned']}}
                            </td>
                            <td>{{$jo['projName']}}</td>
                            <td>{{$jo['contact']}}</td>
                            <td>
                                {{ $jo['brands'] }}
                            </td>

                            @if( $jo['ceNo'] != null )

                                <td>
                                    <a href="{{ $jo['ceFile']  }}">{{ $jo['ceNo'] }}</a>
                                </td>

                            @else

                                <td><button class="btn btn-primary tiny btnForDocUpload" data-toggle="modal" data-target="#modalDoc" value="{{$jo['joId']}}" alt="ce">CE</button></td>

                            @endif

                            @if( $jo['doNo'] != null )

                                <td>
                                    <a href="{{ $jo['doFile']  }}">{{ $jo['doNo'] }}</a>
                                </td>

                            @else

                                <td><button class="btn btn-primary tiny btnForDocUpload" data-toggle="modal" data-target="#modalDoc" value="{{$jo['joId']}}" alt="do">Do</button></td>

                            @endif

                            @if( $jo['transmittal'] != null )

                                <td>
                                    {{ $jo['transmittal'] }}
                                </td>

                            @else

                                <td class="" align="center" style="text-align: center;">

                                    <form action="/accounting/transmittal" method="post">

                                        {{ csrf_field() }}
                                        <input type="hidden" name="joID" value="{{$jo['joId']}}">

                                        <input type="date" placeholder="Date" name="transmittal" >

                                        <button class="btn btn-primary" type="submit">Save</button>

                                    </form>

                                </td>

                            @endif

                            @if( $jo['invoiceNo'] != null )

                                <td>
                                    <a href="{{ $jo['invoiceFile']  }}">{{ $jo['invoiceNo'] }}</a>
                                </td>

                            @else

                                <td class="" align="center" style="text-align: center;">
                                    <button class="btn btn-primary btnForDocUpload" data-toggle="modal" data-target="#modalDoc" value="{{$jo['joId']}}" alt="invoice">Invoice</button>
                                </td>

                            @endif

                            @if( $jo['paidDate'] != null )

                                <td>
                                    <a href="{{ $jo['paidFile']  }}">{{ $jo['paidDate'] }}</a>
                                </td>

                            @else

                                <td>
                                    <button class="btn btn-primary btnForPdUpload" data-toggle="modal" data-target="#modalPD" value="{{$jo['joId']}}" alt="payment">Unpaid</button>
                                </td>

                            @endif


                            <td>
                                <button class="btn btn-primary btnForRemarks" value="{{$jo['joId']}}" data-toggle="modal" data-target="#modalRemarks">Remarks</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--modal--}}

    {{--CE--}}
    <div class="modal fade" id="modalDoc" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="/accounting/check" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id="joID" name="joID" value="">
                    <input type="hidden" id="docType" name="docType" value="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Upload CE</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="doc_number" id="ce_number" class="form-control" placeholder="CE Number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="file" name="file" id="file" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--EndCE--}}

    {{--Payment--}}
    <div class="modal fade" id="modalPD" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="/accounting/check" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id="pd_joID" name="joID" value="">
                    <input type="hidden" id="pd_docType" name="docType" value="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Payment</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="date" name="doc_number" id="doc_number" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="file" name="file" id="file" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--EndPayment--}}

    {{--Remarks--}}
    <div class="modal fade" id="modalRemarks" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="/accounting/check" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id="remarks_joID" name="joID" value="">
                    <input type="hidden" id="remarks_docType" name="docType" value="remarks">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Remarks</h4>
                    </div>
                    <div class="modal-body">
                        <textarea name="accountingRemarks" id="accountingRemarks" style="width: 100%;" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--EndRemarks--}}

    {{--endmodal--}}

@endsection

@section('scripts')

    <script>
        $('.btnForDocUpload').on('click', function(){
            var jid = $(this).val();
            var doc = $(this).attr('alt');
            $('#joID').val(jid);
            $('#docType').val(doc);
        });
        $('.btnForPdUpload').on('click', function(){
            var jid = $(this).val();
            var doc = $(this).attr('alt');
            $('#pd_joID').val(jid);
            $('#pd_docType').val(doc);
        });
        $('.btnForRemarks').on('click', function(){
            var jid = $(this).val();
            $('#remarks_joID').val(jid);
        });
    </script>
@endsection
