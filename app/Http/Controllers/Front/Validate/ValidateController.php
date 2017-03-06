<?php

namespace App\Http\Controllers\Front\Validate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobOrder;
use App\Models\JobOrderClient;
use App\Models\UserProfile;
use App\Models\Client;
//use App\Models\Client;

class ValidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = array();

        $jos = JobOrder::all();
        foreach ($jos as $jo){
            $userProfile = UserProfile::where('user_id', $jo->user_id)->first();
            $joc = JobOrderClient::where('job_order_id', $jo->id)->first();

            $client = Client::where('id', $joc->client_id)->first();

            $strBrands = '';
            $i = 1;
            $t = count($joc->brands);
            foreach ($joc->brands as $brand) {
                if( $i != $t ){
                    $strBrands .= $brand->name.', ';
                }else{
                    $strBrands .= $brand->name;
                }
                $i++;
            }

            $arrProjectType = array();
            $arrProjectType = json_decode($jo->project_types);
//            dd($arrProjectType);
            $projecttypes = '';
            $project = 1;
            $types = count($arrProjectType);
            foreach ($arrProjectType as $pr) {
                if( $project != $types ){
                    $projecttypes .= $pr->name.', ';
                }else{
                    $projecttypes .= $pr->name;
                }
                $project++;
            }

            $jobArray = array(
                'joId' => $jo->job_order_no,
                'assigned' => $userProfile->last_name.', '.$userProfile->first_name,
                'projName' => $jo->project_name,
                'contact' => $client->contact_person,
                'brands' => $strBrands,
                'status' => $jo->status,
                'projecttypes' => $projecttypes
            );
            array_push($results, $jobArray);
        }
//            dd($results);
//        $joc = JobOrderClient::all();
//        dd($jos);
        return view('admin/validate', compact('results'));
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create_project( $id ){

//        echo 'hello';
        $jos = JobOrder::where('job_order_no',$id)->first();
//        dd($jos);
        return view('admin/Validate/create_project', compact('jos'));
    }

    public function summary_result(){
//        echo 'hello';
        return view('admin/Validate/summary_result');
    }

    public function summary_view($pn){
//        echo 'hello';
        $jos = JobOrder::where('job_order_no',$pn)->first();
        return view('admin/Validate/summary_view', compact('jos'));
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
    public function destroy($id)
    {
        //
    }
}
