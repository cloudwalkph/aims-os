<?php

namespace App\Http\Controllers\API;

use App\Models\InventoryDeliveries;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class InventoryDeliveriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = $request->user();
        $delivery_data = array(
          'user_id' => $user->id,
          'product_id' => $request->product_id,
          'delivery_quantity' => $request->delivery_quantity,
          'delivery_date' => date('Y-m-d H:i:s', strtotime($request->delivery_date)),
        );
        $delivery = InventoryDeliveries::create($delivery_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InventoryDeliveries  $inventoryDeliveries
     * @return \Illuminate\Http\Response
     */
    public function show(InventoryDeliveries $inventoryDeliveries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InventoryDeliveries  $inventoryDeliveries
     * @return \Illuminate\Http\Response
     */
    public function edit(InventoryDeliveries $inventoryDeliveries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InventoryDeliveries  $inventoryDeliveries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InventoryDeliveries $inventoryDeliveries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InventoryDeliveries  $inventoryDeliveries
     * @return \Illuminate\Http\Response
     */
    public function destroy(InventoryDeliveries $inventoryDeliveries)
    {
        //
    }
}
