<?php

namespace App\Http\Controllers\Front\Validate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Assignment;
use App\Models\ValidateQuestion;
use App\Models\ValidateAnswers;
use App\Models\ValidateResult;
use App\Models\JobOrder;
use App\Models\Department;

use App\Repositories\Validate\JobOrdersRepository;
use App\Repositories\Validate\QuestionsRepository;
use App\Repositories\Validate\RateesRepository;

class Questions extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('questions/question');
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

    public function submitresult(Request $request)
    {
        $user = $request->user();
        $checkResults = ValidateResult::where( 'job_order_no', '=', $request['jno'] )
            ->where('category', '=', 'pre')
            ->where('department_id', '=', $request['deptid'])
            ->where('user_id', '=', $request['ratee'])
            ->where('rater_id', '=', $user->id)
            ->get();

        if( count($checkResults) > 0 && $request['category'] == 'pre' ){

            return 501;
            
        }

        if( isset($request['q']) ){

            foreach ( $request['q'] as $key => $score ){

                $storeResult = new ValidateResult();

                $storeResult->job_order_no = $request['jno'];
                $storeResult->category = $request['category'];
                $storeResult->department_id = $request['deptid'];
                $storeResult->user_id = $request['ratee'];
                $storeResult->rater_id = $user->id;

                $scoreTemp = 0;

                $storeResult->question_id = $key;

                if( is_array($score) ){
                    if( count($score) > 5){
                        $scoreTemp = 100;
                    }elseif( count($score) > 3 ){
                        $scoreTemp = 50;
                    }else{
                        $scoreTemp = 0;
                    }
                }else{
                    $scoreTemp = $score;
                }

                $storeResult->score = $scoreTemp;

                $storeResult->save();
            }
            return 201;
        }
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

    public function showQuestions( $jno, $eventCategory, $deptid, $rateeId, Request $request, QuestionsRepository $questionsRepo)
    {

        $jo_name = '';
        $dept_name = '';
        $jos = JobOrder::where('job_order_no', $jno)->first();
        $jo_name = $jos->project_name;
        $jobOrderId = $jos->id;


        $dpt = Department::where('id', $deptid)->first();
        $dept_name = $dpt->name;

        $returnQuestions = [];
        $productions = [
            'Provided Job Orders with the following attachments attachments:',
            'Project Brief (Scheme, Flow, Target Market, Target Hits, Channels and Spiels)',
            'Checklist (Products, Uniforms, Merch, Equipment and other materials)',
            'Setup Deck',
            'Timings / Schedule / Duration',
            'Permits for in - (stores / Venues c/o clients)',
            'Manpower Requirements (with detailed info like TF/rates, Quantity,',
            'Description, Meals & Transpo info., etc. ',
            'Production Deck: Merch, Booths (sizes, quantity, checklists, etc.)'
        ];

        $user = $request->user();

        // $questions = ValidateQuestion::where('qrater','=',$user->department_id)
        //     ->where('qcat','=',$eventCategory)
        //     ->where('qdept','=',$deptid)
        //     ->where('qtype','=','S')
        //     ->get();
        $questions = $questionsRepo->getQuestions($user->department_id, $deptid, $jobOrderId, $eventCategory);

        $questionCount = 1;
        $count = count($questions);
        foreach ($questions as $question){

            $strQuestions = '<label style="float: right;">Question '.$questionCount.' of '.$count.'</label> <br>';
            // if( in_array( $question->id, array(38, 62, 120, 141, 166, 188) ) ){

            //     foreach( $productions as $key => $production ){
            //         if( $key == 0){
            //             $strQuestions = $production.'<br>';
            //         }else{
            //             $strQuestions .= '<input type="checkbox" value="1" name="q['.$question->id.'][]"> '.$production.'</input><br>';
            //         }
            //     }

            // }else{

                $strQuestions .= $question->question.'</b><br>';
                // $answers = ValidateAnswers::where('questions_id','=',$question->id)
                //     ->get();
                $answers = $question->choices;
                foreach( $answers as $answer ){

                    $strQuestions .= '
                        
                        <div class="radio-btn" style="margin-top: 20px;">
                            <div class="col-xs-1">
                                <input style="height: 25px;" type="radio" value="'.$answer->point.'" name="q['.$question->id.']">
                            </div>
                            <div class="col-xs-11">
                                <label onclick>'.$answer->choice.'</label>
                            </div>
                        </div>
                        
                    ';
                }
            // }

            array_push($returnQuestions, $strQuestions);
            $questionCount++;
        }

        $categoryName = '';

        if( $eventCategory == 'pre' ){
            $categoryName = 'Pre-event';
        } elseif ( $eventCategory == 'eprop' ){
            $categoryName = 'Event Proper';
        } elseif ( $eventCategory == 'post' ){
            $categoryName = 'Post Event';
        }

        return view('questions.question', compact('returnQuestions', 'eventCategory', 'deptid', 'rateeId', 'jno', 'categoryName', 'count', 'jo_name', 'dept_name'));
    }

    public function choosecategory($jno)
    {
        return view('admin/validate/evaluate', compact('jno'));
    }

    public function chooseemployee($jno, $category, Request $request, RateesRepository $rateeRepo)
    {

        if( !$request->user()->id ){
            return redirect()->to('/login');
        }

        $userLogged = $request->user();
        $results = [];
        $jos = JobOrder::where('job_order_no', $jno)->first();
        $jobOrderId = $jos->id;
        $loadEmployees = $rateeRepo->getRatees($jobOrderId, $userLogged->department_id, $category);

        foreach ($loadEmployees as $loadEmployee){
            $checkResults = 0;

            $user_details = array(
                'userid' => $loadEmployee->id,
                'name' => $loadEmployee->profile->last_name.', '.$loadEmployee->profile->first_name,
                'deptid' => $loadEmployee->department->id,
                'department' => $loadEmployee->department->name,
                'exist' => 0
            );

            // $checkResults = ValidateResult::where( 'job_order_no', '=', $jno )
            //     ->where('category', '=', 'pre')
            //     ->where('department_id', '=', $loadEmployee->department_id)
            //     ->where('user_id', '=', $loadEmployee->id)
            //     ->where('rater_id', '=', $userLogged->id)
            //     ->get();

//            dd($jno.' '.$user->department_id.' '.$loadEmployee->user_id.' '.$userLogged->id);

            // if( count($checkResults) <= 0 || $category != 'pre'){
            //     array_push($results , $user_details);
            // }else{
            //     $user_details['exist'] = 1;
                array_push($results , $user_details);
            // }

        }

        return view('admin/validate/rateeList', compact('results','jno','category'));
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
