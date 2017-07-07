<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobOrder;
use App\Models\Productions;
use App\Models\ProductionsItems;
use App\Models\ProductionSuppliers;

class ProductionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = JobOrder::orderBy($sortCol, $sortDir);
        } else {
            $query = JobOrder::orderBy('id', 'asc');
        }

        $query->join('job_order_clients', 'job_order_clients.job_order_id', '=', 'job_orders.id')
            ->join('clients', 'job_order_clients.client_id', '=', 'clients.id')
            ->join('user_profiles', 'user_profiles.user_id', '=', 'job_orders.user_id')
            ->leftJoin('job_order_animation_details', 'job_order_animation_details.job_order_id', '=', 'job_orders.id')
            ->groupBy('job_orders.id', 'user_profiles.last_name', 'user_profiles.first_name')
            ->select('job_orders.*', \DB::raw("GROUP_CONCAT(clients.`company` separator ', ') as company"),
                \DB::raw("GROUP_CONCAT(job_order_clients.`brands` separator ', ') as brands"),
                \DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as created_by'));

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, JobOrder::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
        \Log::info($query->toSql());
        // Get the data
        $jobOrders = $query->paginate($perPage);

        return response()->json($jobOrders, 200);
    }

    public function update_details( $JoId, Request $request ){
        $input = $request->all();

        $filename = '';
        if ($request->hasFile('visuals')) {
            $filename = uniqid() . '.png';

            $request->file('visuals')->storeAs('productions', $filename);
        }

        $products = ProductionsItems::find($input['production_id']);

        $products->description = nl2br( $input['description']);
        $products->visuals = $filename;
        $products->sizes = $input['sizes'];
        $products->qty = $input['qty'];
        $products->details = nl2br( $input['details']);
        if( $products->save() ){
            return response()->json($products, 200);
        }else{
            return false;
        }
    }

    public function save_details( $JoId, Request $request ){

        $input = $request->all();

        $input['job_order_id'] = $JoId;

        $filename = '';
        if ($request->hasFile('visuals')) {
            $filename = uniqid() . '.png';

            $request->file('visuals')->storeAs('productions', $filename);
        }

        $production_id = 0;

        $jo = Productions::where('job_order_no', '=', $JoId)->get();

        if( count($jo) <= 0 ){
            $production_id = $this->productionSave($JoId);
        }else{
            $production_id = $JoId;
        }

        $response = $this->productionItemSave( $production_id, $input, $filename );

        return $response;
    }

    private function productionSave( $joId ){
        $storeProductions = new Productions();
        $storeProductions->job_order_no = $joId;
        if( $storeProductions->save() ){
            return $storeProductions->id;
        }else{
            return false;
        }
    }

    private function productionItemSave( $prodId, $values, $filename ){

        $storeProductionsItems = new ProductionsItems();
        $storeProductionsItems->production_id = $prodId;
        $storeProductionsItems->type = $values['production_type'];
        $storeProductionsItems->description = nl2br($values['description']);
        $storeProductionsItems->visuals = $filename;
        $storeProductionsItems->sizes = $values['sizes'];
        $storeProductionsItems->qty = $values['qty'];
        $storeProductionsItems->details = nl2br($values['details']);
        if( $storeProductionsItems->save() ){
            return response()->json($storeProductionsItems, 200);
        }else{
            return false;
        }
    }

    public function delete_details( $JoId, Request $request ){

        $input = $request->all();
        $production = ProductionsItems::find($input['production_id']);

        $production->delete();
    }

    public function save_costing( Request $request ){

        $input = $request->all();

//        dd($input['job_order_no']);

        $storeProductionSuppliers = new ProductionSuppliers();
        $storeProductionSuppliers->job_order_no    = $input['job_order_no'];
        $storeProductionSuppliers->production_type = $input['production_type'];
        $storeProductionSuppliers->company_name    = $input['company_name'];
        $storeProductionSuppliers->point_person    = $input['point_person'];
        $storeProductionSuppliers->contact         = $input['contact'];

        if( $storeProductionSuppliers->save() ){
            return response()->json($storeProductionSuppliers, 200);
        }else{
            return false;
        }
    }

    public function delete_costing( Request $request ){

        $input = $request->all();
        $production = ProductionSuppliers::find($input['costing_id']);

        $production->delete();
    }
}
