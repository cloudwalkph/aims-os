<h3>Delivery Tracking</h3>

<div class="row">
@foreach($iJob->jobOrder->products as $product)
<?php
  $balance = $product->expected_quantity;
 ?>
    <div class="col-sm-12">
        <label htmlFor="itemname" class="col-sm-4 control-label">
            Item Name: {{$product->item_name}}
        </label>
        <label htmlFor="quantity" class="col-sm-4 control-label">
            Expected Delivery Date: {{$product->expected_delivery_date}}
        </label>
        <label htmlFor="quantity" class="col-sm-4 control-label">
            Expected Quantity: {{$product->expected_quantity}}
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
              @foreach($product->deliveries as $delivery)
<?php
  $balance = $balance - $delivery->delivery_quantity;
 ?>
                <tr>
                    <td>{{date('F j, Y h:i:s a', strtotime($delivery->delivery_date))}}</td>
                    <td>{{$delivery->delivery_quantity}}</td>
                    <td>{{$balance}}</td>
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
