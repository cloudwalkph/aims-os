<h3>Release Tracking</h3>

<div class="row">
  @foreach($iJob->jobOrder->products as $product)
    <div class="col-sm-12">
        <label htmlFor="itemname" class="col-sm-4 control-label">
            Item Name: {{$product->item_name}}
        </label>
        <label htmlFor="quantity" class="col-sm-4 control-label">
<?php
  $stockTotal = 0;
  foreach($product->deliveries as $delivery) {
    $stockTotal += $delivery->delivery_quantity;
  }
  foreach($product->releases as $release) {
    $stockTotal -= $release->dispose_quantity - $release->return_quantity;
  }
 ?>
            Current Stock on Hand: {{$stockTotal}}
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
<?php
  $releases = 0;
  $prevDate = null;
  $prevDispose = 0;
  $prevReturn = 0;
 ?>
              @foreach($product->releases as $key => $release)
<?php
  $deliveries = 0;
  $rDate = strtotime($release->release_date);
  foreach($product->deliveries as $delivery) {
    $dDate = strtotime($delivery->delivery_date);
    if ($dDate < $rDate) {
      $deliveries += $delivery->delivery_quantity;
    }
  }
  $releases = $prevDispose - $prevReturn;
  $stockOnHand = $deliveries - $releases;
  if ($prevDate < $rDate) {
    $prevDispose += $release->dispose_quantity;
    $prevReturn += $release->return_quantity;
  }
  $prevDate = $rDate;
 ?>
                <tr>
                    <td>{{date('F j, Y h:i:s a', $rDate)}}</td>
                    <td>{{$stockOnHand}}</td>
                    <td>{{$release->dispose_quantity}}</td>
                    <td>{{$release->return_quantity}}</td>
                    <td>Approved</td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
  @endforeach
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
