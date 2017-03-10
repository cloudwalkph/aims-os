<?php

namespace App\Http\Controllers\Front\Validate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ValidateQuestions;

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

    public function showQuestions(Request $request)
    {
        $strQuestions = '';
//        $questions = ValidateQuestions::all();
        $questions = ValidateQuestions::where([
            ['qdept', '=', $request->deptID],
            ['qcat', '=', $request->cat],
            ['qtype', '=', $request->etype]
        ])->get();

        foreach ($questions as $question ){

//            dd($question->qname);
            $strQuestions .= '
                <tr id="eventRow'.$question -> _id.'">
                    <td>'.$question -> qname.'</td>
                    <td>
                        <a href="#" class="btn btn-danger btn-rounded btn-ripple deleteButtonEvent" alt="'.$question -> _id.'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
            ';

        }

        return $strQuestions;
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
