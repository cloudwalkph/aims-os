<div class="modal fade" id="createProjectAttachments" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Project Attachments</h4>
            </div>
            <form method="POST" action="/operations/job-orders/{{ $jo->id }}/project-attachments" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        {{ csrf_field() }}
                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="reference_for">Reference For</label>
                            <select name="reference_for" id="reference_for" class="form-control">
                                <option value="Ocular Deck">Ocular Deck</option>
                                <option value="Setup Deck">Setup Deck</option>
                                <option value="Report Template">Report Template</option>
                                <option value="Execution Deck">Execution Deck</option>
                            </select>
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="file_name">Project attachment</label>
                            <input type="file" name="file" placeholder="Project attachment" class="form-control" />
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