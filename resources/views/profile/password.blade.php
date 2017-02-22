<div class="panel panel-default">
    <div class="panel-heading text-center">
        <h2>RESET PASSWORD</h2>
    </div>
    <form method="POST" action="/api/v1/users/change-password">
        <div class="panel-body">
            <div class="row">

                <div class="form-group">
                    <label for="current_password" class="col-md-12">Current Password</label>
                    <div class="col-md-12">
                        <input id="current_password" type="password" class="form-control"
                               name="current_password" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="new_password" class="col-md-12">New Password</label>
                    <div class="col-md-12">
                        <input id="new_password" type="password" class="form-control"
                               name="new_password" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="verify_password" class="col-md-12">Verify Password</label>
                    <div class="col-md-12">
                        <input id="verify_password" type="password" class="form-control"
                               name="verify_password" required>
                    </div>
                </div>

            </div>
        </div>
        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </div>
    </form>
</div>