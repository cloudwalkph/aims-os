<div class="modal fade" id="createAnimationDetails" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Animation Details</h4>
            </div>
            <form method="POST" action="/ae/jo/{{ $jo->id }}/animation" id="animationForm">
                <div class="modal-body">
                    <div class="row">
                        {{ csrf_field() }}
                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="particular">Particulars</label>
                            <input type="text" name="particular" required placeholder="Particulars" class="form-control" />
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="target_activity">Target Activity</label>
                            <input type="text" name="target_activity" required placeholder="Target Activity" class="form-control" />
                        </div>

                        <div class="col-md-12 text-center">
                            <h4>Target Hits</h4>
                        </div>

                        <div class="col-md-4 form-group text-input-container">
                            <label class="control-label" for="target_selling">Selling</label>
                            <input type="number" name="target_selling" required placeholder="Selling" class="form-control" />
                        </div>

                        <div class="col-md-4 form-group text-input-container">
                            <label class="control-label" for="target_flyering">Flyering</label>
                            <input type="number" name="target_flyering" required placeholder="Flyering" class="form-control" />
                        </div>

                        <div class="col-md-4 form-group text-input-container">
                            <label class="control-label" for="target_survey">Survey</label>
                            <input type="number" name="target_survey" required placeholder="Survey" class="form-control" />
                        </div>

                        <div class="col-md-4 form-group text-input-container">
                            <label class="control-label" for="target_experiment">Experiment</label>
                            <input type="number" name="target_experiment" required placeholder="Experiment" class="form-control" />
                        </div>

                        <div class="col-md-4 form-group text-input-container">
                            <label class="control-label" for="target_others">Others</label>
                            <input type="number" name="target_others" required placeholder="Others" class="form-control" />
                        </div>

                        <div class="col-md-12">
                            <hr/>
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="target_duration">Target Duration</label>
                            <input type="number" name="target_duration" required placeholder="Target Duration" class="form-control" />
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="target_areas">Areas</label>
                            <input type="number" name="target_areas" required placeholder="Areas" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveAnimationDetail">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>