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

                        @foreach( $jos as $jo)
                        <tr>
                            <td>{{$jo->job_order_no}}</td>
                            <td><input class="" alt="28" placeholder="Contract No.">{{$jo->contract_no}}</td>
                            <td>
                                <ul class="no-bullet">
                                    <li style="font-size:12px">Advertising, Acti Advertising</li>
                                </ul>
                            </td>
                            <td>{{$jo->project_name}}</td>
                            <td>Von Cruz</td>
                            <td>Dove</td>
                            <td><button class="btn btn-primary tiny btnCE" data-toggle="modal" data-target="#modalCE" value="{{ $jo->job_order_no }}">CE</button></td>
                            <td><button class="btn btn-primary tiny" data-toggle="modal" data-target="#modalDO" alt="28">Do</button></td>
                            <td class="" align="center" style="text-align: center;"><input alt="28" type="date" placeholder="Date"> <label style="font-size:10px;">press enter to save</label></td>
                            <td class="" align="center" style="text-align: center;"><button class="btn btn-primary" alt="28" data-toggle="modal" data-target="#modalInvoice">Invoice</button></td>
                            <td>
                                <button class="btn btn-primary" alt="28" value="Paid" style="" data-toggle="modal" data-target="#modalPD">Unpaid</button>
                            </td>
                            <td>
                                <button class="btn btn-primary" value="" alt="28" style="" data-toggle="modal" data-target="#modalRemarks">Remarks</button>
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
                <form action="/accounting/check" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" id="joID" name="joID" value="">
                    <input type="hidden" id="ceType" name="ceType" value="ce">
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
