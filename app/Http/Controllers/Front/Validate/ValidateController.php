<?php

namespace App\Http\Controllers\Front\Validate;

use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Department;
use App\Models\JobOrder;
use App\Models\JobOrderClient;
use App\Models\UserProfile;
use App\Models\ValidateQuestions;
use App\Models\ValidateResults;

use DB;

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
    public function index(Request $request)
    {

        $data = $request->user()->id;
        $results = $this->loadJobOrders( $data );
        return view('admin/validate', compact('results'));
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validate_results($jno)
    {
        $jos = JobOrder::where('job_order_no', $jno)->first();

        $jsonPreEvent = $this->getEventScores($jno);
        $jsonActualEvent = $this->getEventScores($jno, 'eprop');
        $jsonPostEvent = $this->getEventScores($jno, 'post');

        return view('admin/Validate/summary_result', compact('jos', 'results', 'jsonPreEvent', 'jsonActualEvent', 'jsonPostEvent'));
    }

    function getEventScores($jno = '', $eventCategory = 'pre')
    {
        $preEventScores = ValidateResults::select('name')
        ->addSelect(DB::raw('AVG(score) as avg_score'))
        ->join('departments', 'departments.id', '=', 'validate_results.department_id')
        ->where('job_order_no', '=', $jno)
        ->where('category', '=', $eventCategory)
        ->groupBy('department_id')
        ->get();

        $preEventArray['cols'] = array(
            array(
                'id' => 'A',
                'label' => 'Department',
                'type' => 'string'
            ),
            array(
                'id' => 'B',
                'label' => 'Score',
                'type' => 'number'
            ),
        );
        $preEventArray['rows'] = array();

        foreach($preEventScores as $score) {
            $collection = array(
                'c' => array(
                    array(
                        'v' => $score->name
                    ),
                    array(
                        'v' => ($score->avg_score / 100),
                        'f' => round($score->avg_score, 2)
                    )
                )
            );
            array_push($preEventArray['rows'], $collection);
        }
        $jsonPreEvent = json_encode($preEventArray);
        
        return $jsonPreEvent;
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

    public function loadJobOrders( $uid = null )
    {
        $results = array();

        $joArrays = array();

        if( $uid != null ){
            $assignments = Assignment::where('user_id', $uid)
                ->get();


            foreach ($assignments as $assignment){

                array_push($joArrays, $assignment->job_order_id);

            }
        }else{

            $assignments = Assignment::get();
            foreach ($assignments as $assignment){

                array_push($joArrays, $assignment->job_order_id);

            }

        }

//        $jos = JobOrder::select('*')
//            ->with('user_profile')
//            ->get();

        $jos = JobOrder::whereIn( 'id', $joArrays )
            ->get();

        foreach ($jos as $jo) {
            $contact_array = [];
            $brands_array = [];
            
            foreach($jo->clients->toArray() as $client) {
                $contact_array[] = $client['client_id'];
                foreach($client['brands'] as $brand) {
                    $brands_array[] = $brand->name;
                }
            }

            $jobArray = array(
                'joId' => $jo->job_order_no,
                'assigned' => $jo->user_profile->last_name.', '.$jo->user_profile->first_name,
                'projName' => $jo->project_name,
                'contact' => implode(', ', $contact_array),
                'brands' => implode(', ', $brands_array),
                'status' => $jo->status,
                'projecttypes' => implode(', ', array_column(json_decode($jo->project_types, true), 'name'))
            );
            array_push($results, $jobArray);
        }

        return $results;
    }
}
