<?php

namespace App\Http\Controllers\Front\Validate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ValidateQuestions;
use App\Models\ValidateAssignedQuestions;

class ValidateQuestionsController extends Controller
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

    public function showQuestions(Request $request)
    {
        $resultsToReturn = [];

        $strQuestions = '';

        $arrQuestionsID = array();

        if( $request->qids != null ){
            $arrQuestionsID = json_decode( $request->qids );
        }

        $questions = ValidateQuestions::where([
            ['tqdept', '=', $request->deptID],
            ['qcat', '=', $request->cat],
            ['qtype', '=', $request->etype]
        ])->get();

        foreach ($questions as $question ){

            array_push( $arrQuestionsID, $question->_id );

            $strQuestions .= '
                <tr id="eventRow'.$question->_id.'">
                    <td>'.$question->qname.'</td>
                    <td>
                        <a href="#" class="btn btn-danger btn-rounded btn-ripple deleteButtonEvent" alt="'.$question -> _id.'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
            ';

        }

        $resultsToReturn['question_id'] = json_encode($arrQuestionsID);
        $resultsToReturn['question_string'] = $strQuestions;
        return json_encode($resultsToReturn);
    }

    function store_questions( $jsonValue ){

        $storeQuestions = new ValidateAssignedQuestions();

        $storeQuestions->questions = $jsonValue;

        if( $storeQuestions->save() ){
            return $storeQuestions->id;
        }else{
            return false;
        }

    }

    function update_questions( $id, $jsonValue ){
        $questions = ValidateAssignedQuestions::where('id', $id)->first();
        $questions->questions = $jsonValue;

        if( $questions->save() ){
            return true;
        }else{
            return false;
        }
    }

    function showResults(Request $request){
        $resultsToReturn = [];

        $strQuestions = '';

        $questions = ValidateQuestions::where([
            ['tqdept', '=', $request->deptID]
        ])->get();

        foreach ($questions as $question ){

            $strQuestions .= '
                <tr id="eventRow'.$question->_id.'">
                    <td>'.$question->qname.'</td>
                    <td>
                        '.rand(60, 100).'%
                    </td>
                </tr>
            ';

        }
        $resultsToReturn['question_string'] = $strQuestions;
        return json_encode($resultsToReturn);
    }
}
