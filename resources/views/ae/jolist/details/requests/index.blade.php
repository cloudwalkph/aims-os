@extends('ae.jolist.details.index')

@section('job-order-content')
<div class="tab-pane" id="request-forms">
    <div class="panel-group accordion" style="margin-top: 20px">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="manpowerForm">
                <h3 class="panel-title" data-toggle="collapse" data-parent="#accordion"
                    href="#collapseManpower" aria-expanded="true" aria-controls="collapseManpower" style="cursor: pointer;">
                    Manpower Request Form
                </h3>
            </div>
            <div id="collapseManpower" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="manpowerForm">
                <div class="panel-body">
                    <div class="col-md-12">
                        <button class="btn btn-default pull-right" id="printManpower">
                            <i class="fa fa-print fa-lg"></i> Print Manpower Requests
                        </button>
                    </div>

                    <manpower-request-form></manpower-request-form>
                    <manpower-request-table></manpower-request-table>

                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="vehicleForm">
                <h3 class="panel-title" data-toggle="collapse" data-parent="#accordion"
                    href="#collapseVehicle" aria-expanded="true" aria-controls="collapseVehicle" style="cursor: pointer;">
                    Vehicle Request Form
                </h3>
            </div>
            <div id="collapseVehicle" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="vehicleForm">
                <div class="panel-body">

                    <div class="col-md-12">
                        <button class="btn btn-default pull-right" id="printVehicle">
                            <i class="fa fa-print fa-lg"></i> Print Vehicle Requests
                        </button>
                    </div>

                    <vehicle-request-form></vehicle-request-form>
                    <vehicle-request-table></vehicle-request-table>

                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="foodForm">
                <h3 class="panel-title" data-toggle="collapse" data-parent="#accordion"
                    href="#collapseFood" aria-expanded="true" aria-controls="collapseFood" style="cursor: pointer;">
                    Meal Request Form
                </h3>
            </div>
            <div id="collapseFood" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="foodForm">
                <div class="panel-body">

                    <div class="col-md-12">
                        <button class="btn btn-default pull-right" id="printMeal">
                            <i class="fa fa-print fa-lg"></i> Print Meal Requests
                        </button>
                    </div>

                    <meal-request-form></meal-request-form>
                    <meal-request-table></meal-request-table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection