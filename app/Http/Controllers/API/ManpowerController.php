<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manpower;

class ManpowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manpower = Manpower::with('manpowerType')->with('agency')->paginate();
        $data = $this->parseData($manpower);
        return response()->json($data, 200);
    }

    private function parseData($manpower) {
    	
    	foreach($manpower as $d)
    	{
    		$d['name'] = $d['first_name'].' '.$d['middle_name'].' '.$d['last_name'];
    	}
    	return $manpower;
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
        // return $request->file('profile_picture')->getClientOriginalExtension();
        $input = $request->all();
        $data = [
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'manpower_type_id' => $input['manpower_type_id'],
            'agency_id' => $input['agency_id'],
            'email' => $input['email'],
            'contact_number' => $input['contact_number'],
            'fb_link' => $input['fb_link'],
            'city' => $input['city'],
            'violations' => $input['violations'],
            'birthdate' => $input['birthdate'],
            'hired_date' => $input['hired_date'],
        ];

        $manpower = Manpower::create($data)->paginate();
        $manpower = $this->parseData($manpower);
        return response()->json($manpower, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $manpower = Manpower::where('id', $id)->delete();

        if (! $manpower) {
            return response()->json([], 400);
        }

        return response()->json($manpower, 200);
    }
}
