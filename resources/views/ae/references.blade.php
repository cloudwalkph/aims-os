@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            {{-- breadcrumb start --}}
            <div class="col-lg-12">
                <h1 class="page-header">
                    Accounts Executive<small> Department</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/ae"><i class="fa fa-dashboard"></i> AE Department</a>
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
                        <th>Template Name</th>
                        <th>Reference Type</th>
                        <th class="text-center">Download Template</th>
                        <th class="text-center">Download Reference</th>
                    </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Production Template</td>
                            <td>Internal</td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Setup Template</td>
                            <td>Internal</td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Activations Template</td>
                            <td>Internal</td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>In-store Template</td>
                            <td>Internal</td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Ocular Template</td>
                            <td>Internal</td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Checklist Template</td>
                            <td>Internal</td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Minutes of the Meeting</td>
                            <td>External</td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Bid Deck</td>
                            <td>External</td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Pre-Prod and Logistics</td>
                            <td>External</td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Weekly Report</td>
                            <td>External</td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Post Evaluation (Initial)</td>
                            <td>External</td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Post Evaluation (Final)</td>
                            <td>External</td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Post Evaluation (Final one time)</td>
                            <td>External</td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary">
                                    <i class="fa fa-download fa-lg"></i> Download
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
