@extends('layouts.app')

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
                        <a href="/productions"><i class="fa fa-dashboard"></i> Production Department</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-clipboard"></i> Reference Lists
                    </li>
                </ol>
            </div>
            {{-- breadcrumb end --}}

            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Reference for</th>
                        <th class="text-center">Download Reference</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>Production Deck</td>
                        <td>Internal</td>
                        <td class="text-center">
                            <a href="/productions/references/production.pptx/download" role="button" class="btn btn-primary">
                                <i class="fa fa-download fa-lg"></i> Download
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Occular Inspection Template</td>
                        <td>Internal</td>
                        <td class="text-center">
                            <a href="/productions/references/ocular.pptx/download" role="button" class="btn btn-primary">
                                <i class="fa fa-download fa-lg"></i> Download
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
