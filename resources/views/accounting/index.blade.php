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
                            <td><input class="" alt="28" placeholder="Contract No.">{{$jo['coNo']}}</td>
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

                                <td><button class="btn btn-primary tiny btnCE" data-toggle="modal" data-target="#modalCE" value="{{$jo['joId']}}">CE</button></td>

                            @endif

                            @if( $jo['doNo'] != null )

                                <td>
                                    <a href="{{ $jo['doFile']  }}">{{ $jo['doNo'] }}</a>
                                </td>

                            @else

                                <td><button class="btn btn-primary tiny" data-toggle="modal" data-target="#modalDO" alt="28" value="{{$jo['joId']}}">Do</button></td>

                            @endif

                            @if( $jo['transmittal'] != null )

                                <td>
                                    {{ $jo['transmittal'] }}
                                </td>

                            @else

                                <td class="" align="center" style="text-align: center;"><input alt="28" type="date" placeholder="Date" value="{{$jo['joId']}}"> <label style="font-size:10px;">press enter to save</label></td>

                            @endif

                            @if( $jo['invoiceNo'] != null )

                                <td>
                                    <a href="{{ $jo['invoiceFile']  }}">{{ $jo['invoiceNo'] }}</a>
                                </td>

                            @else

                                <td class="" align="center" style="text-align: center;"><button class="btn btn-primary" alt="28" data-toggle="modal" data-target="#modalInvoice" value="{{$jo['joId']}}">Invoice</button></td>

                            @endif

                            @if( $jo['paidNo'] != null )

                                <td>
                                    <a href="{{ $jo['paidFile']  }}">{{ $jo['paidNo'] }}</a>
                                </td>

                            @else

                                <td>
                                    <button class="btn btn-primary" alt="28" value="Paid" style="" data-toggle="modal" data-target="#modalPD" value="{{$jo['joId']}}">Unpaid</button>
                                </td>

                            @endif


                            <td>
                                <button class="btn btn-primary" value="{{$jo['joId']}}" alt="28" style="" data-toggle="modal" data-target="#modalRemarks">Remarks</button>
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
    <div class="modal fade" id="modalCE" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="/accounting/check" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id="joID" name="joID" value="">
                    <input type="hidden" id="docType" name="docType" value="ce">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Upload CE</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="ce_number" id="ce_number" class="form-control" placeholder="CE Number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="file" name="ce_file" id="ce_file" class="form-control">
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
    {{--DO--}}
    <div class="modal fade" id="modalDO" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="/accounting/check" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id="joID" name="joID" value="">
                    <input type="hidden" id="docType" name="docType" value="do">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Upload DO</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="do_number" id="do_number" class="form-control" placeholder="DO number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="file" name="doFile" id="doFile" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--EndDO--}}
    {{--Invoice--}}
    <div class="modal fade" id="modalInvoice" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Upload Invoice</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="invoice_number" id="invoice_number" class="form-control" placeholder="Invoice number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="file" name="invoiceFile" id="invoiceFile" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>
    {{--EndInvoice--}}
    {{--Payment--}}
    <div class="modal fade" id="modalPD" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Payment</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="paidDate" id="paidDate" class="form-control" placeholder="Date">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="file" name="paidFile" id="paidFile" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Paid</button>
                </div>
            </div>
        </div>
    </div>
    {{--EndPayment--}}
    {{--Remarks--}}
    <div class="modal fade" id="modalRemarks" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Remarks</h4>
                </div>
                <div class="modal-body">
                    <textarea name="accountingRemarks" id="accountingRemarks" style="width: 100%;" cols="30" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{--EndRemarks--}}
    {{--endmodal--}}

@endsection

@section('scripts')

    <script>
        $('.btnCE').on('click', function(){
            var jid = $(this).val();
            $('#joID').val(jid);
        });
    </script>
@endsection
