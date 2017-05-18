<h3>Release Tracking</h3>

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
                    <th>Date</th>
                    <th>Products on Hand</th>
                    <th>Disposed</th>
                    <th>Returned</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>Thu Dec 22 2016</td>
                    <td>100</td>
                    <td>90</td>
                    <td>10</td>
                    <td>Approved</td>
                </tr>
                <tr>
                    <td>Sat Dec 24 2016</td>
                    <td>110</td>
                    <td>100</td>
                    <td>10</td>
                    <td>Approved</td>
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
                    <th>Date</th>
                    <th>Products on Hand</th>
                    <th>Disposed</th>
                    <th>Returned</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>May 13, 2017</td>
                    <td>200</td>
                    <td>150</td>
                    <td>50</td>
                    <td>Approved</td>
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
