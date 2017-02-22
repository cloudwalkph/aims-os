<div class="tab-pane" id="project-attachments">
    <div class="form-horizontal" style="margin-top: 20px">
        <div class="box box-info">
            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-default pull-right"
                                type="button" data-toggle="modal" data-target="#createProjectAttachments">
                            <i class="fa fa-plus"></i> Add Attachments
                        </button>
                    </div>
                </div>

                @include('ae.jolist.details.project.modals.attachment')

                <table class="table table-striped table-bordered" style="margin-top: 20px">
                    <thead>
                    <tr>
                        <th> Reference For</th>
                        <th> File Name</th>
                        <th> Date Uploaded </th>
                        <th> Download</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>