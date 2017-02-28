<?php

namespace App\Http\Controllers\Front\Accounting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Accounting;
use App\Models\JobOrder;

class AccountingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        config(['app.name' => 'Accounting | AIMS']);

        $jos = JobOrder::all();

//        dd($jos);

//        return $tasks;

        return view('accounting.index', compact('jos'));
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
    public function store($request)
    {
        $storeAccounts = new Accounting();

        if( $request['ceType'] == 'ce' ){
            $storeAccounts->job_order_no = $request['joID'];
            $storeAccounts->ceNumber = $request['ce_number'];
            $storeAccounts->ceFile = $request['ce_file'];
            $storeAccounts->ceDateUpdated = date("Y-m-d H:i:s");
        }


        if( $storeAccounts->save() ){
            return Redirect('/accounting/');
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
    public function update($request, $id)
    {
        $accounting = Accounting::where('job_order_no', $id)->first();
        if( $request['ceType'] == 'ce' ){
            $accounting->ceNumber = $request['ce_number'];
            $accounting->ceFile = $request['ce_file'];
            $accounting->ceDateUpdated = date("Y-m-d H:i:s");
        }

        if( $accounting->save() ){
            return Redirect('/accounting/');
//            echo 'updated';
        }else{
            echo 'no changes';
        }
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

    public function check(Request $request){

        $checker = Accounting::where( 'job_order_no', $request->input('joID') )->count();

        if( $checker <= 0 ){

            AccountingController::store( $request->input() );

        }else{

            AccountingController::update( $request->input(), $request->input('joID') );

        }

    }
}
