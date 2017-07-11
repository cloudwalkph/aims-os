<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manpower;
use App\Models\JobOrder;
use App\Models\JobOrderManpower;
use App\Models\JobOrderSelectedManpower;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Models\ManpowerFile;
use Carbon\Carbon;
use App\Traits\FilterTrait;

class SetupController extends Controller
{
    use FilterTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manpower = Manpower::with('manpowerType')->with('agency')->where('setup_only', 1)->orderBy('id','DESC')->paginate();
        $data = $this->parseData($manpower);
        return response()->json($data, 200);
    }

    public function getJoOrderList() {
        $joManpower = JobOrderManpower::with('manpowerType')
                        ->with('jobOrder')
                        ->where('manpower_type_id', 1);

        return response()->json($joManpower->paginate(), 200);
    }

    public function getJoOrderManpowerByJoId($joId) {
        $joManpower = JobOrderManpower::with('jobOrder.user.profile')
                        ->where('manpower_type_id', 1)
                        ->where('job_order_id', $joId);

        return response()->json($joManpower->first(), 200);
    }

    public function getManpowerListBySetup($joId, Request $request) {
        $manpower = Manpower::with('agency')
                    ->where('manpower_type_id',1)
                    ->whereNotIn('id', function($q) use ($joId) { // filter by selected manpower event date
                    
                        $q->select('manpower_id')
                        ->whereNull('deleted_at')
                        ->where('job_order_id',$joId)
                        ->from('job_order_selected_manpowers');
                    })
                    ->where('setup_only',1);

        if ($request->has('filter')) {
            $this->filter($manpower, $request, Manpower::$filterable);
        }

        $data = $this->parseData($manpower->paginate());

        return response()->json($data, 200);
    }

    public function getManpowerBySelectedSetup($joId) {
        
        $joSelectedManpower = JobOrderSelectedManpower::with('jobOrder')
            ->with('venue')
            ->with(array('manpower.manpowerType' => function($q) { // where type only setup
                $q->where('id',1);
            }))
            ->where('job_order_id', $joId)
            ->where('manpower_type_required', 1)
            ->paginate();
        
        return response()->json($joSelectedManpower, 200);
    }

    public function addManpowerToJo(Request $request, $joId) {
        $input = $request->all();
        
        $data = [
            'job_order_id' => $joId,
            'manpower_id' => $input['id'],
            'manpower_type_required' => 1,
            'venue_id' => 0
        ];
        
        $joManpower = JobOrderManpower::where('job_order_id', $joId)->where('manpower_type_id', 1)->first();

        $manpowerNeeded = JobOrderSelectedManpower::where('job_order_id', $joId)->where('manpower_type_required',1)->where('buffer',0)->get();
        if($joManpower->manpower_needed <= count($manpowerNeeded))
        {
            $data['buffer'] = 1;
        }

        $query = JobOrderSelectedManpower::create($data);
        return $data;
        
    }

    public function changeVenue(Request $request, $selectedId) {
        $input = $request->all();
        
        $data = [
            'venue_id' => $input['venue_id']
        ];
        $query = JobOrderSelectedManpower::where('id', $selectedId)->update($data);
        return response()->json($query, 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $data = [
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'agency_id' => $input['agency_id'],
            'email' => $input['email'],
            'contact_number' => $input['contact_number'],
            'fb_link' => $input['fb_link'],
            'city' => $input['city'],
            'violations' => $input['violations'],
            'birthdate' => $input['birthdate'],
            'hired_date' => $input['hired_date'],
            'rate' => $input['rate'],
            'setup_only' => 1,
            'manpower_type_id' => 1
        ];

        $manpower = Manpower::create($data);

        $file = $this->upload($request, $manpower['id'], 'profile_picture');
        $files = $this->multiUpload($request, $manpower['id'], 'documents');

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;

        return response()->json($manpower->paginate($perPage), 200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $data = [
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'agency_id' => $input['agency_id'],
            'email' => $input['email'],
            'contact_number' => $input['contact_number'],
            'fb_link' => $input['fb_link'],
            'city' => $input['city'],
            'violations' => $input['violations'],
            'birthdate' => $input['birthdate'],
            'hired_date' => $input['hired_date'],
            'rate' => $input['rate']
        ];
        
        $result = Manpower::where('id', $id)->update($data);

        $file = $this->upload($request, $id, 'profile_picture');
        $files = $this->multiUpload($request, $id, 'documents');

        // $manpower = $this->parseData($manpower->paginate());
        return response()->json($result, 200);
    }

    private function parseData($manpower) {
        
        foreach($manpower as $d)
        {
            $d['name'] = $d['first_name'].' '.$d['middle_name'].' '.$d['last_name'];
        }
        return $manpower;
    }

    public function multiUpload($request, $manpowerId, $inputName) {
        if(!$request->hasFile($inputName))
        {
            return '';
        }

        $images = $request->file($inputName);
        foreach($images as $image)
        {
            $filename = $this->processImage($image);
            
            if($filename)
            {
                $data = [
                    'manpower_id'       => $manpowerId,
                    'url'               => 'images/'. $filename . '.' . $image->getClientOriginalExtension(),
                    'type'              => 'file'
                ];

                $manpowerFile = ManpowerFile::create($data);
            }
        }
    }

    public function upload($request, $manpowerId, $inputName) {
        if(!$request->hasFile($inputName))
        {
            return '';
        }

        $image = $request->file($inputName);

        $filename = $this->processImage($image);

        if($filename == false)
        {
            return 'permission error';
        }

        $data = [
            'manpower_id'       => $manpowerId,
            'url'               => 'images/'. $filename . '.' . $image->getClientOriginalExtension(),
            'type'              => 'picture'
        ];

        $d = [
            'profile_picture' => 'images/'. $filename . '.' . $image->getClientOriginalExtension()
        ];

        $manpowerFile = ManpowerFile::create($data);
        $power = Manpower::where('id', $manpowerId)->update($d);

    }

    protected function processImage(UploadedFile $image) {
        $filename = Carbon::now()->timestamp.'-'.uniqid();
        $extName = $image->getClientOriginalExtension();
        $destination = public_path() . '/images/';

        try {
            $image->move($destination, $filename.'.'.$extName);
            return $filename;
            
        } catch (NotWritableException $e) {
            echo $e->getMessage();
            return false;
        }

        return $filename;
    }

    public function delete($id)
    {
        $manpower = Manpower::where('id', $id)->delete();

        if (! $manpower) {
            return response()->json([], 400);
        }

        return response()->json($manpower, 200);
    }
}
