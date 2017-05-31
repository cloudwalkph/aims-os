<h3>Product List</h3>

<div class="row">
  <div class="col-sm-12">
      <table class="table table-striped table-bordered">
          <thead>
              <tr>
                  <th>Job Order Number</th>
                  <th>Project Name</th>
                  <th>Item Name</th>
                  <th>Expected Quantity</th>
                  <th>Products on Hand</th>
                  <th>Disposed</th>
              </tr>
          </thead>

          <tbody>
@foreach($products as $product)
              <tr>
                  <td>{{$product->jobOrder->job_order_no}}</td>
                  <td>{{$product->jobOrder->project_name}}</td>
                  <td>{{$product->item_name}}</td>
                  <td>{{$product->expected_quantity}}</td>
                  <td>{{$product->products_on_hand}}</td>
                  <td>{{$product->total_disposed}}</td>
              </tr>
@endforeach
          </tbody>
      </table>
  </div>
</div>
