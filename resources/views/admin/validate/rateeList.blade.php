@extends('layouts.app')

@section('content')
    {{--{{ $results }}--}}
    <div class="container-fluid dashboard">
        <div class="row">
            <main class="col-md-12">

                <div class="row">
                    <div class="col-md-6">
                        <h1>Validate - Ratee's List</h1>
                    </div>
                    <div class="col-md-2 col-md-offset-4 text-right">
                        <a href="/evaluate/{{ $jno }}" class="btn btn-success"><i class="glyphicon glyphicon-chevron-left"></i>Events</a>
                    </div>
                </div>
                <form class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    {{--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>--}}
                </form>
                <div class="table-responsive">
                    <table class="vuetable table table-bordered table-striped table-hover" style="margin-top: 15px;">
                        <thead>
                        <tr>
                            <th class="vuetable-th-slug sortable">Employee Name</th>
                            <th class="vuetable-th-slug sortable">Departments</th>
                            <th class="vuetable-th-slug sortable">Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        ?>
                        @foreach( $results as $result)
                            <tr>
                                    @if( $result['exist'] == 0 )

                                        <td>
                                            <a href="/evaluate/{{ $jno }}/{{ $category }}/{{ $result['deptid'] }}/{{ $result['userid'] }}">{{ $result['name'] }}</a>
                                        </td>
                                        <td>{{ $result['department'] }}</td>
                                        <td>Pending</td>

                                    @elseif( $result['exist'] == 1 )
                                        <td>
                                            {{ $result['name'] }}
                                        </td>
                                        <td>{{ $result['department'] }}</td>
                                        <td>Done</td>

                                    @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

@endsection