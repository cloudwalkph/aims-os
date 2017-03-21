<?php

namespace App\Http\Controllers\Front\Validate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Assignment;
use App\Models\UserProfile;

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

    public function showQuestions($jid, $category, $deptid, $uid)
    {
        echo $jid.$category.$deptid.$uid;
    }

    public function choosecategory($jid)
    {
        return view('admin/validate/evaluate', compact('jid'));
    }

    public function chooseemployee($jid, $category)
    {
        $results = [];
        $loadEmployees = Assignment::loadRatees($jid);
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

        return view('admin/validate/rateeList', compact('results','jid','category'));
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
