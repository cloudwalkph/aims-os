<div class="modal fade" id="createProjectAttachments" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Project Attachments</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="/ae/jo/{{ $jo->id }}/project-attachments" enctype="multipart/form-data">
                    <div>

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="reference_for">Reference For</label>
                            <select name="reference_for" id="reference_for">
                                <option value="Working Cost Estimate">Working Cost Estimate</option>
                                <option value="Working Deck">Working Deck</option>
                                <option value="Working Checklist">Working Checklist</option>
                            </select>
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="file_name">Project attachment</label>
                            <input type="file" name="file" placeholder="Project attachment" class="form-control" />
                        </div>

                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>