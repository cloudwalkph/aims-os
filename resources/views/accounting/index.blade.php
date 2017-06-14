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

            <div class="col-md-12" style="margin-bottom: 10px;">
                <div class="col-md-3 div30days">30 days</div>
                <div class="col-md-3 div45days">45 days</div>
                <div class="col-md-3 div60days">60 days</div>
                <div class="col-md-3 text-center emergency">More than 120 days</div>
            </div>

            <div class="col-md-12">
                <table id="accounting_table" class="table table-striped display" style="margin-top: 30px">
                    <thead>
                    <tr>
                        <th width="150">Job Order No.</th>
                        <th width="400">AE Assigned</th>
                        <th width="200">Project Name</th>
                        {{--<th width="200">Client</th>--}}
                        <th width="150">Brand</th>
                        <th width="150">CE</th>
                        <th width="150">DO No. / PO</th>
                        <th width="150">Transmittal</th>
                        <th width="150">Invoice No.</th>
                        <th width="150">Paid</th>
                        <th width="150">Remarks</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th width="150">Job Order No.</th>
                        <th width="400">AE Assigned</th>
                        <th width="200">Project Name</th>
                        {{--<th width="200">Client</th>--}}
                        <th width="150">Brand</th>
                        <th width="150">CE</th>
                        <th width="150">DO No. / PO</th>
                        <th width="150">Transmittal</th>
                        <th width="150">Invoice No.</th>
                        <th width="150">Paid</th>
                        <th width="150">Remarks</th>
                    </tr>
                    </tfoot>

                    <tbody id="tbody_accounts">
                        @foreach( $results as $jo)
                        <tr>
                            <td>{{$jo['joId']}}</td>
                            <td>
                                {{$jo['assigned']}}
                            </td>
                            <td>{{$jo['projName']}}</td>
                            {{--<td>{{$jo['contact']}}</td>--}}
                            <td>
                                {{ $jo['brands'] }}
                            </td>

                            @if( $jo['ceNo'] != null )

                                <td>
                                    <a href="{{ $jo['ceFile']  }}">{{ $jo['ceNo'] }}</a>
                                </td>

                            @else

                                @if( $dptid != 8 )
                                    <td><button class="btn btn-primary tiny btnForDocUpload" data-toggle="modal" data-target="#modalDoc" value="{{$jo['joId']}}" alt="ce">CE</button></td>
                                @else
                                    <td> </td>
                                @endif

                            @endif

                            @if( $jo['doNo'] != null )

                                <td>
                                    <a href="{{ $jo['doFile']  }}">{{ $jo['doNo'] }}</a>
                                </td>

                            @else

                                @if( $dptid != 8 )
                                    <td><button class="btn btn-primary tiny btnForDocUpload" data-toggle="modal" data-target="#modalDoc" value="{{$jo['joId']}}" alt="do">Do</button></td>
                                @else
                                    <td> </td>
                                @endif

                            @endif

                            @if( $jo['transmittal'] != null )

                                <?=$jo['transmittal']?>

                            @else

                                <td class="" align="center" style="text-align: center;">

                                    <form action="/accounting/check" method="post">

                                        {{ csrf_field() }}
                                        <input type="hidden" name="joID" value="{{$jo['joId']}}">
                                        <input type="hidden" id="docType" name="docType" value="transmittal">

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


                                @if( $dptid == 8 )
                                    <td>
                                        <button class="btn btn-primary btnForPdUpload" data-toggle="modal" data-target="#modalPD" value="{{$jo['joId']}}" alt="payment">Unpaid</button>
                                    </td>
                                @else
                                    <td> </td>
                                @endif

                            @endif

                            <td style="text-align: center;">
                                @if( $jo['remarks'] != null )
                                    <button type="button" class="btn btn-info btnRemarks" style="width:60%;" data-toggle="modal" data-target="#remarksModal" title="{{ $jo['remarksFull'] }}">
                                        {{ $jo['remarks'].'...' }}
                                    </button>
                                    <button class="btnForRemarks" value="{{$jo['joId']}}" data-toggle="modal" data-target="#modalRemarks"><icon class="glyphicon glyphicon-pencil"></icon></button>
                                @else
                                    <button class="btnForRemarks" value="{{$jo['joId']}}" data-toggle="modal" data-target="#modalRemarks"><icon class="glyphicon glyphicon-plus"></icon></button>
                                @endif



                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--modal--}}

    <div class="modal fade" id="remarksModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 id="modal-title" class="modal-title">Remarks</h4>
                </div>
                <div class="modal-body">
                    <p id="textForRemarks"></p>
                </div>
            </div>
        </div>
    </div>

    {{--CE--}}
    <div class="modal fade" id="modalDoc" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="/accounting/check" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id="joID" name="joID" value="">
                    <input type="hidden" id="documentsType" name="docType" value="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 id="modal-title" class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="doc_number" id="ce_number" class="form-control">
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

    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script>

        $('.btnForDocUpload').on('click', function(){
            var jid = $(this).val();
            var doc = $(this).attr('alt');

            if( doc == 'ce' ){

                $('#modal-title').text('Upload CE');
                $('#ce_number').attr("placeholder", "CE number");

            }else if( doc == 'do' ){

                $('#modal-title').text('Upload DO');
                $('#ce_number').attr("placeholder", "DO number");

            }else if( doc == 'invoice' ){

                $('#modal-title').text('Upload Invoice');
                $('#ce_number').attr("placeholder", "Invoice number");

            }

            $('#joID').val(jid);
            $('#documentsType').val(doc);
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

        $(document).ready(function() {

            $('#accounting_table tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            var table = $('#accounting_table').DataTable({
//                "bFilter": false,
                initComplete: function ()
                {
                    var r = $('#accounting_table tfoot tr');
                    r.find('th').each(function(){
                        $(this).css('padding', 8);
                    });
                    $('#accounting_table thead').append(r);
                },
            }).columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );

        } );

        $('.btnRemarks').on('click', function () {
            var remarkText = $(this).attr('title');

            console.log(remarkText);

            $('p#textForRemarks').val('');

            $('p#textForRemarks').text(remarkText);
        });

    </script>



    <style>

        .dataTables_filter{
            float: right;
        }

    </style>
@endsection
