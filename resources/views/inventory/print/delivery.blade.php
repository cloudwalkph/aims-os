<h3>Delivery Tracking</h3>

<div class="row">

    <div class="col-sm-12">
        <label htmlFor="itemname" class="col-sm-4 control-label">
            Item Name: Ponds Men
        </label>
        <label htmlFor="quantity" class="col-sm-4 control-label">
            Expected Quantity: 2000
        </label>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Delivery Date</th>
                    <th>Delivered</th>
                    <th>Balance Needed</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>Thu Dec 22 2016</td>
                    <td>100</td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>Sat Dec 24 2016</td>
                    <td>100</td>
                    <td>0</td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="col-sm-12">
        <label htmlFor="itemname" class="col-sm-4 control-label">
            Item Name: Ponds Women
        </label>
        <label htmlFor="quantity" class="col-sm-4 control-label">
            Expected Quantity: 2000
        </label>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Delivery Date</th>
                    <th>Delivered</th>
                    <th>Balance Needed</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>Fri Dec 23 2016</td>
                    <td>200</td>
                    <td>0</td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="row">
      <div class="col-xs-offset-9 col-xs-3 text-right">
@foreach ($iJob->assignedPerson as $assigned_person)
        <br />
        <br />
        <br />
        <div class="row" style="text-decoration: overline;">
          <div style="text-decoration: overline; text-align: center;">
            <b>{{ $assigned_person->user->profile->first_name . ' ' . $assigned_person->user->profile->last_name }}</b>
          </div>
        </div>
@endforeach
      </div>
    </div>


</div>
