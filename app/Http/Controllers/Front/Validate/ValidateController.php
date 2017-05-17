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
        return view('admin/Validate/summary_result', compact('jno', 'jos'));
    }

    function getEventScores($jno = '', $eventCategory = 'all')
    {
      $query = Department::select('departments.id as dept_id', 'slug', 'name')
        ->leftJoin(DB::raw('(SELECT job_order_no, category, department_id, AVG(score) AS avg_score FROM validate_results WHERE category = "pre" AND job_order_no = "'.$jno.'" GROUP BY job_order_no, category, department_id) AS preEvent'),
          function($q){
            $q->on('departments.id', '=', 'preEvent.department_id');
          })
        ->addSelect(DB::raw('IFNULL(preEvent.avg_score, 0) AS pre_avg_score'))
        ->leftJoin(DB::raw('(SELECT job_order_no, category, department_id, AVG(score) AS avg_score FROM validate_results WHERE category = "prop" AND job_order_no = "'.$jno.'" GROUP BY job_order_no, category, department_id) AS propEvent'),
          function($q){
            $q->on('departments.id', '=', 'propEvent.department_id');
          })
        ->addSelect(DB::raw('IFNULL(propEvent.avg_score, 0) AS prop_avg_score'))
        ->leftJoin(DB::raw('(SELECT job_order_no, category, department_id, AVG(score) AS avg_score FROM validate_results WHERE category = "post" AND job_order_no = "'.$jno.'" GROUP BY job_order_no, category, department_id) AS postEvent'),
          function($q){
            $q->on('departments.id', '=', 'postEvent.department_id');
          })
        ->addSelect(DB::raw('IFNULL(postEvent.avg_score, 0) AS post_avg_score'))
        ->orderBy('dept_id');
      $eventData = $query->get();

        $eventArray['cols'] = array(
            array(
                'id' => 'events',
                'label' => 'Events',
                'type' => 'string',
            ),
        );

            // $zero['c'] = array(
            //     array(
            //         'v' => 'Start'
            //     )
            // );
            if($eventCategory == 'all' || $eventCategory == 'pre') {
              $preEvent['c'] = array(
                  array(
                      'v' => 'Pre-Event',
                  )
              );
            }
            if($eventCategory == 'all' || $eventCategory == 'prop') {
              $propEvent['c'] = array(
                  array(
                      'v' => 'Event Proper',
                  )
              );
            }
            if($eventCategory == 'all' || $eventCategory == 'post') {
              $postEvent['c'] = array(
                  array(
                      'v' => 'Post-Event',
                  )
              );
            }

        foreach($eventData as $data) {
            $eventArray['cols'][$data['dept_id']] = array(
                'id' => $data['dept_id'],
                'label' => $data['name'],
                'type' => 'number',
            );

            // $zero['c'][$data['dept_id']] = array(
            //     'v' => 0,
            //     'f' => 0,
            // );
            $preEvent['c'][$data['dept_id']] = array(
              'v' => ($data['pre_avg_score'] / 100),
              'f' => round($data['pre_avg_score'], 2),
            );
            $propEvent['c'][$data['dept_id']] = array(
              'v' => ($data['prop_avg_score'] / 100),
              'f' => round($data['prop_avg_score'], 2),
            );
            $postEvent['c'][$data['dept_id']] = array(
              'v' => ($data['post_avg_score'] / 100),
              'f' => round($data['post_avg_score'], 2),
            );
        }

        // $eventArray['rows'][] = $zero;
        if($eventCategory == 'all' || $eventCategory == 'pre') {
          $eventArray['rows'][] = $preEvent;
        }
        if($eventCategory == 'all' || $eventCategory == 'prop') {
          $eventArray['rows'][] = $propEvent;
        }
        if($eventCategory == 'all' || $eventCategory == 'post') {
          $eventArray['rows'][] = $postEvent;
        }

        $jsonPreEvent = json_encode($eventArray);

        echo $jsonPreEvent;
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
