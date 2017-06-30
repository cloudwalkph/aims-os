<div class="modal fade" id="createEventSchedule" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Event Schedule</h4>
            </div>
            <form method="POST" action="/ae/jo/details/{{ $jo->job_order_no }}/event-details/schedules" id="animationForm">
                <div class="modal-body">
                    <div class="row">
                        {{ csrf_field() }}

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="jo_datetime">Date</label>
                            <input type="date" name="jo_datetime" required placeholder="Particulars" class="form-control" />
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="venue">Venue</label>
                            {{--<input type="text" name="venue" required placeholder="Target Activity" class="form-control" />--}}
                            <select name="venue_id" id="venue" class="form-control">
                                <option value="0" disabled selected>Select a venue</option>
                                @foreach($venues as $venue)
                                    <option value="{{ $venue->id }}">{{ $venue->category }} : {{ $venue->subcategory }} : {{ $venue->venue }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="remarks">Remarks</label>
                            <textarea name="remarks" id="remarks" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveAnimationDetail">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>