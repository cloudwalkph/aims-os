@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="container-fluid">
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
                    <li class="active">
                        <i class="fa fa-file-text-o"></i> Job Order Lists
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">
                <production-jo-table></production-jo-table>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script !src="">
        $(document).ready(function(){
            $('#josTable').DataTable();
        });
    </script>
@endsection
