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
        config(['app.name' => 'Accounting | AIMS']);

        $results = array();

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
            $doNumber = '';
            $transmittal = '';
            $invoiceNo = '';
            $invoiceFile = '';
            $paidDate = '';
            $paidFile = '';

            if( $accounting ){

                $ceNo = $accounting->ceNumber;
                $ceFile = $accounting->ceFile;
                $doFile = $accounting->do_file;
                $doNumber = $accounting->do_number;
                $transmittal = $accounting->transmittalDate;
                $invoiceNo = $accounting->invoiceNumber;
                $invoiceFile = $accounting->invoiceFile;
                $paidDate = $accounting->paidDate;
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

            $contractList = '';
            $contractArray = json_decode($jo->contract_no);
            if( isset( $contractArray ) ){
                foreach ( json_decode($jo->contract_no) as $contract ){
                    $contractList .= $contract.'<br>' ;
                }

            }
//            dd($contractList);

            $jobArray = array(
                'joId' => $jo->job_order_no,
                'coNo' => $contractList,
                'assigned' => $userProfile->last_name.', '.$userProfile->first_name,
                'projName' => $jo->project_name,
                'contact' => $client->contact_person,
                'brands' => $strBrands,
                'ceNo' => $ceNo,
                'ceFile' => $ceFile,
                'doNo' => $doNumber,
                'doFile' => $doFile,
                'transmittal' => $transmittal,
                'invoiceNo' => $invoiceNo,
                'invoiceFile' => $invoiceFile,
                'paidDate' => $paidDate,
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
            $storeAccounts->ceNumber = $request['doc_number'];
            $storeAccounts->ceFile = $file;
            $storeAccounts->ceDateUpdated = date("Y-m-d H:i:s");
        } elseif ( $request['docType'] == 'do' ) {
            $storeAccounts->do_number = $request['doc_number'];
            $storeAccounts->do_file = $file;
            $storeAccounts->do_date_updated = date("Y-m-d H:i:s");
        } elseif ( $request['docType'] == 'invoice' ) {
            $storeAccounts->invoiceNumber = $request['doc_number'];
            $storeAccounts->invoiceFile = $file;
            $storeAccounts->invoiceDateUpdated = date("Y-m-d H:i:s");
        } elseif ( $request['docType'] == 'payment' ) {
            $storeAccounts->paidNumber = $request['doc_number'];
            $storeAccounts->paidFile = $file;
            $storeAccounts->paidDateUpdated = date("Y-m-d H:i:s");
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

        if( $request['docType'] == 'ce' ){
            $accounting->ceNumber = $request['doc_number'];
            $accounting->ceFile = $file;
            $accounting->ceDateUpdated = date("Y-m-d H:i:s");
        } elseif ( $request['docType'] == 'do' ) {
            $accounting->do_number = $request['doc_number'];
            $accounting->do_file = $file;
            $accounting->do_date_updated = date("Y-m-d H:i:s");
        } elseif ( $request['docType'] == 'invoice' ) {
            $accounting->invoiceNumber = $request['doc_number'];
            $accounting->invoiceFile = $file;
            $accounting->invoiceDateUpdated = date("Y-m-d H:i:s");
        } elseif ( $request['docType'] == 'payment' ) {
            $accounting->paidDate = $request['doc_number'];
            $accounting->paidFile = $file;
            $accounting->paidDateUpdated = date("Y-m-d H:i:s");
        } elseif ( $request['docType'] == 'remarks' ) {
            $accounting->remarks = $request['accountingRemarks'];
        }

        if( $accounting->save() ){
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

        $destinationPath = 'uploads';
        $filePath = null;

        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $filePath = '/'.$destinationPath.'/'.$file->getClientOriginalName();

            $file->move($destinationPath,$file->getClientOriginalName());

        }

        $checker = Accounting::where( 'job_order_no', $request->input('joID') )->count();

        if( $checker <= 0 ){

            $retVal = AccountingController::store( $request->input(), $filePath );
            if( $retVal == true ){

                $redirect->to('/accounting')->send();
            }

        }else{

            $retVal = AccountingController::update( $request->input(), $request->input('joID'), $filePath );
            if( $retVal == true ){

                $redirect->to('/accounting')->send();
            }

        }

    }

    public function cono( Request $request, Redirector $redirect ){

        $conoArray = array();

        $jo = JobOrder::where('job_order_no', $request->input('joID'))->first();

        if ( $jo->contract_no != null ){

            $conoArray = json_decode( $jo->contract_no );

            if( !in_array( $request->input('cono'), $conoArray ) ){

                array_push( $conoArray, $request->input('cono') );

            }

            $jo->contract_no = json_encode($conoArray);

        } else {

            array_push( $conoArray, $request->input('cono') );

            $jo->contract_no = json_encode($conoArray);

        }

        if( $jo->save() ){

            $redirect->to('/accounting')->send();

        }else{

            return false;

        }

    }

    public function transmittal(){
        
    }

}
