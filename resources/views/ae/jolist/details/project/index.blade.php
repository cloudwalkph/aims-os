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
                        @foreach ($attachments as $attachment)
                            <tr>
                                <td>{{ $attachment->reference_for }}</td>
                                <td>{{ $attachment->file_name }}</td>
                                <td>{{ $attachment->created_at->toFormattedDateString() }}</td>
                                <td><a href="/ae/jo/{{ $jo->id }}/project-attachments/{{ $attachment->id }}/download" role="button" class="btn btn-primary"><i class="fa fa-download"></i> Download</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>