<?php

namespace App\Http\Controllers\API;

use App\Models\InventoryReleases;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class InventoryReleasesController extends Controller
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
        $release_data = array(
          'user_id' => $user->id,
          'product_id' => $request->product_id,
          'dispose_quantity' => $request->dispose_quantity,
          'return_quantity' => $request->return_quantity,
          'release_date' => date('Y-m-d H:i:s', strtotime($request->release_date)),
        );
        $release = InventoryReleases::create($release_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InventoryReleases  $inventoryReleases
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InventoryReleases  $inventoryReleases
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InventoryReleases  $inventoryReleases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $data = [
          'dispose_quantity' => $request->dispose_quantity,
          'return_quantity' => $request->return_quantity,
      ];
      InventoryReleases::find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InventoryReleases  $inventoryReleases
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InventoryReleases::destroy($id);
    }
}
