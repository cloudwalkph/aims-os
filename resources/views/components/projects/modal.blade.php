<div class="modal fade" id="ongoingModal" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <form id="clientForm" method="POST">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Creatives to JO</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="job_order_id">Job Order Number</label>
                            <select name="job_order_id" id="job_order_id" class="form-control">
                                <option value="" disabled selected>Select a job order</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project['job_order_id'] }}">{{ $project['job_order_no'] }} : {{ $project['project_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label">Remarks</label>
                            <input type="text" name="description" id="remarks"
                                placeholder="Remarks" class="form-control" />
                        </div>
                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label">Deadline</label>
                            <input type="text" name="deadline" id="deadline"
                                placeholder="Deadline" class="form-control" />
                        </div>
                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="user_id">Users</label>
                            <select name="user_id" id="job_order_id" class="form-control">
                                <option value="" disabled selected>Select a department member</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->profile->full_name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>