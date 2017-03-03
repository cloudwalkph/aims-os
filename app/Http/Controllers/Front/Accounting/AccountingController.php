<?php

namespace App\Http\Controllers\Front\Accounting;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use App\Models\Accounting;
use App\Models\JobOrder;
use App\Models\UserProfile;
use App\Models\JobOrderClient;
use App\Models\Client;

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
        $results = array();
        config(['app.name' => 'Accounting | AIMS']);

        $jos = JobOrder::all();

        foreach ( $jos as $jo ){
//            where('job_order_no', $id)->first()

            $userProfile = UserProfile::where('user_id', $jo->user_id)->first();

            $orderClient = JobOrderClient::where('job_order_id', $jo->id)->first();

            $client = Client::where('id', $orderClient->client_id)->first();

            $accounting = Accounting::where('job_order_no',$jo->job_order_no)->first();

//            dd($accounting);

            $ceNo = '';
            $ceFile = '';
            $doFile = '';
            $transmittal = '';
            $invoiceNo = '';
            $invoiceFile = '';
            $paidNo = '';
            $paidFile = '';

            if( $accounting ){

                $ceNo = $accounting->ceNumber;
                $ceFile = $accounting->ceFile;
                $doFile = $accounting->do_file;
                $transmittal = $accounting->transmittalDate;
                $invoiceNo = $accounting->invoiceNumber;
                $invoiceFile = $accounting->invoiceFile;
                $paidNo = $accounting->paidNumber;
                $paidFile = $accounting->paidFile;

            }

            $strBrands = '';
            $i = 1;
            $t = count($orderClient->brands);
            foreach ($orderClient->brands as $brand) {
                if( $i != $t ){
                    $strBrands .= $brand->name.', ';
                }else{
                    $strBrands .= $brand->name;
                }
                $i++;
            }

            $jobArray = array(
                'joId' => $jo->job_order_no,
                'coNo' => $jo->contract_no,
                'assigned' => $userProfile->last_name.', '.$userProfile->first_name,
                'projName' => $jo->project_name,
                'contact' => $client->contact_person,
                'brands' => $strBrands,
                'ceNo' => $ceNo,
                'ceFile' => $ceFile,
                'doNo' => $jo -> do_contract_no,
                'doFile' => $doFile,
                'transmittal' => $transmittal,
                'invoiceNo' => $invoiceNo,
                'invoiceFile' => $invoiceFile,
                'paidNo' => $paidNo,
                'paidFile' => $paidFile,
            );

            array_push( $results, $jobArray );
//            dd($results);
        }

        return view('accounting.index', compact('results'));
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
    public function store($request, $file)
    {
        $storeAccounts = new Accounting();

        $storeAccounts->job_order_no = $request['joID'];

        if( $request['docType'] == 'ce' ){
            $storeAccounts->ceNumber = $request['ce_number'];
            $storeAccounts->ceFile = $file;
            $storeAccounts->ceDateUpdated = date("Y-m-d H:i:s");
        } elseif ( $request['docType'] == 'do' ){
//            $storeAccounts->ceNumber = $request['do_number'];
//            $storeAccounts->ceFile = $file;
//            $storeAccounts->ceDateUpdated = date("Y-m-d H:i:s");
        }


        if( $storeAccounts->save() ){
            return true;
        }else{
            return false;
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
    public function update($request, $id, $file)
    {
        $accounting = Accounting::where('job_order_no', $id)->first();
        if( $request['ceType'] == 'ce' ){
            $accounting->ceNumber = $request['ce_number'];
            $accounting->ceFile = $file;
            $accounting->ceDateUpdated = date("Y-m-d H:i:s");
        }

        if( $accounting->save() ){
//            Redirect('/accounting/');
            return true;
        }else{
            return false;
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

    public function check(Request $request, Redirector $redirect){

        if (! $request->hasFile('ce_file')) {

            return redirect()->back();

        }

        $file = $request->file('ce_file');

        $destinationPath = 'uploads';

        $checker = Accounting::where( 'job_order_no', $request->input('joID') )->count();

        if( $checker <= 0 ){

            $file->move($destinationPath,$file->getClientOriginalName());

            $retVal = AccountingController::store( $request->input(), '/'.$destinationPath.'/'.$file->getClientOriginalName() );
            if( $retVal == true ){

                $redirect->to('/accounting')->send();
            }

        }else{

            $file->move($destinationPath,$file->getClientOriginalName());

            $retVal = AccountingController::update( $request->input(), $request->input('joID'), '/'.$destinationPath.'/'.$file->getClientOriginalName() );
            if( $retVal == true ){

                $redirect->to('/accounting')->send();
            }

        }

    }
}
