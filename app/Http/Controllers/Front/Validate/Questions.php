<?php

namespace App\Http\Controllers\Front\Validate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Assignment;
use App\Models\ValidateQuestions;
use App\Models\ValidateAnswers;
use App\Models\ValidateResults;

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
        //
//        dd($request->input());

//        dd($request['q']);

        foreach ( $request['q'] as $key => $score ){

            $storeResult = new ValidateResults();

            $storeResult->job_order_no = $request['jno'];
            $storeResult->department_id = $request['deptid'];
            $storeResult->user_id = $request['ratee'];

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

    public function showQuestions( $jno, $eventCategory, $deptid, $rateeId, Request $request)
    {
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
//        echo $eventCategory.'>'.$deptid.'>'.$user->department_id;
        $questions = ValidateQuestions::where('qrater','=',$user->department_id)
            ->where('qcat','=',$eventCategory)
            ->where('qdept','=',$deptid)
            ->where('qtype','=','S')
            ->get();

        foreach ($questions as $question){

            $strQuestions = '';
            if( in_array( $question->id, array(38, 62, 120, 141, 166, 188) ) ){

                foreach( $productions as $key => $production ){
                    if( $key == 0){
                        $strQuestions = $production.'<br>';
                    }else{
                        $strQuestions .= '<input type="checkbox" value="1" name="q['.$question->id.'][]"> '.$production.'</input><br>';
                    }
                }

            }else{

                $strQuestions = $question->qname.'</b><br>';
                $answers = ValidateAnswers::where('questions_id','=',$question->id)
                    ->get();
                foreach( $answers as $answer ){

                    $strQuestions .= '
                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="radio" value="'.$answer->score.'" name="q['.$question->id.']">
                          </span>
                          <span class="input-group-addon">'.$answer->answers.'</span>
                        </div>
                    ';
                }

            }

            array_push($returnQuestions, $strQuestions);

        }
        return view('questions.question', compact('returnQuestions', 'eventCategory', 'deptid', 'rateeId', 'jno'));
    }

    public function choosecategory($jid)
    {
        return view('admin/validate/evaluate', compact('jid'));
    }

    public function chooseemployee($jno, $category, Request $request)
    {
        $user = $request->user();
        $results = [];
        $loadEmployees = Assignment::loadRatees($jno, $category, $user->department_id);

        foreach ($loadEmployees as $loadEmployee){

            $user = User::where( 'id', $loadEmployee->user_id )->first();
            $user_details = array(
                'userid' => $loadEmployee->user_id,
                'name' => $user->profile->last_name.', '.$user->profile->first_name,
                'deptid' => $user->department->id,
                'department' => $user->department->name
            );
            array_push($results , $user_details);

        }

        $json = json_encode($results);

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
