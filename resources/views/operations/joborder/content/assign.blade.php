@extends('operations.joborder.details')

@section('jo-details-content')
    <div class="row">
        <div class="col-md-12 text-right" style="padding-bottom: 20px">
            <button type="button" class="btn btn-primary"
                    data-toggle="modal" data-target="#assignPM">
                <i class="fa fa-plus"></i> Assign Project Manager
            </button>
        </div>

        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('status') }}
                </div>
            @endif

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($assigned as $user)
                    <tr>
                        <td>{{ $user->user_name }}</td>
                        <td>{{ $user->department }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <button type="button" class="btn btn-danger"><i class="fa fa-remove"></i> Remove</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="assignPM" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Project Manager</h4>
                </div>
                <form method="POST" action="">
                    <div class="modal-body">
                        <div class="row">
                            {{ csrf_field() }}

                            <div class="col-md-12 form-group">
                                <label class="control-label" for="user_id">Users</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ ucwords($user->profile->full_name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection