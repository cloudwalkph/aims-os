<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manpower;
use App\models\ManpowerFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Carbon\Carbon;
use Image;

class ManpowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manpower = Manpower::with('manpowerType')->with('agency')->paginate();
        $data = $this->parseData($manpower);
        return response()->json($data, 200);
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
        $input = $request->all();
        $data = [
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'manpower_type_id' => $input['manpower_type_id'],
            'agency_id' => $input['agency_id'],
            'email' => $input['email'],
            'contact_number' => $input['contact_number'],
            'fb_link' => $input['fb_link'],
            'city' => $input['city'],
            'violations' => $input['violations'],
            'birthdate' => $input['birthdate'],
            'hired_date' => $input['hired_date']
        ];
        
        $manpower = Manpower::create($data);
        
        $file = $this->upload($request, $manpower['id'], 'profile_picture');
        $files = $this->multiUpload($request, $manpower['id'], 'documents');

        // $manpower = $this->parseData($manpower->paginate());
        return response()->json($manpower->paginate(), 200);
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

    private function parseData($manpower) {
        
        foreach($manpower as $d)
        {
            $d['name'] = $d['first_name'].' '.$d['middle_name'].' '.$d['last_name'];
        }
        return $manpower;
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
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $data = [
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'manpower_type_id' => $input['manpower_type_id'],
            'agency_id' => $input['agency_id'],
            'email' => $input['email'],
            'contact_number' => $input['contact_number'],
            'fb_link' => $input['fb_link'],
            'city' => $input['city'],
            'violations' => $input['violations'],
            'birthdate' => $input['birthdate'],
            'hired_date' => $input['hired_date']
        ];
        
        $manpowerId = Manpower::where('id', $id)->update($data);
        
        $file = $this->upload($request, $manpowerId, 'profile_picture');
        $files = $this->multiUpload($request, $manpowerId, 'documents');

        // $manpower = $this->parseData($manpower->paginate());
        return response()->json($manpowerId, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $manpower = Manpower::where('id', $id)->delete();

        if (! $manpower) {
            return response()->json([], 400);
        }

        return response()->json($manpower, 200);
    }
}
