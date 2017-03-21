<?php

namespace App\Http\Controllers\Front\Validate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobOrder;
use App\Models\JobOrderClient;
use App\Models\UserProfile;
use App\Models\Client;
use App\Models\ValidateQuestions;
use App\Models\Department;

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
        $results = $this->loadJobOrders();

        return view('admin/validate', compact('results'));
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validate_results( $id ){

        $jos = JobOrder::where('job_order_no',$id)->first();
        return view('admin/Validate/summary_result', compact('jos','results'));
    }

    public function summary_result(){
        $questions = ValidateQuestions::where('qdept','2')->get();
        $departments = Department::all();
        $employees = UserProfile::all();
        return view('admin/Validate/summary_result', compact('jos', 'questions', 'departments', 'load_questions', 'employees'));
    }

    public function summary_view($pn){
        $jos = JobOrder::where('job_order_no',$pn)->first();
        return view('admin/Validate/summary_view', compact('jos'));
    }

    public function showJoLists(){
        $results = $this->loadJobOrders();
        return view('admin/Validate/evaluateAdmin', compact('results'));
    }

    public function loadJobOrders(){
        $results = array();

        $jos = JobOrder::all();
        foreach ($jos as $jo){
            $userProfile = UserProfile::where('user_id', $jo->user_id)->first();
            $joc = JobOrderClient::where('job_order_id', $jo->id)->first();

            if(! $joc) {
                continue;
            }

            $client = Client::where('id', $joc->client_id)->first();
//            dd($client->contact_person);
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

        return $results;
    }
}
