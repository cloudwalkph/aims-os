<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manpower;
use App\Models\ManpowerFile;
use App\Models\JobOrder;
use App\Models\ManpowerAssignTypes;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Carbon\Carbon;
use App\Traits\FilterTrait;
use Image;

class ManpowerController extends Controller
{
    use FilterTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($joNumber, Request $request)
    {
        $jo = JobOrder::where('job_order_no', $joNumber)->first();

        if($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            
            $manpower = Manpower::with('manpowerType')
                ->with('agency')
                ->with(array(
                    'manpowerAssignType' => function($q) use($sortCol) {
                        if($sortCol == 'manpower_assign_type'){
                            $q->orderBy('manpower_type_id', $sortDir);    
                        }  
                    },
                    'manpowerAssignType.manpowerType'
                ))
                ->whereNotIn('id', function($q) { // filter by selected manpower event date
                    
                    $q->select('manpower_id')
                    ->whereNull('deleted_at')
                    ->whereIn('job_order_id', function($j) { // filter by even date
                        $j->select('job_order_id')
                        ->whereDate('event_date', '=', Carbon::today()->toDateString())
                        ->from('job_order_manpower_events');
                    })
                    ->from('job_order_selected_manpowers');
                })
                ->whereIn('id', function($m) use($jo) { // filter by manpower needed
                    $m->select('manpower_id')
                    ->whereIn('manpower_type_id',function($q) use($jo) {
                        $q->select('manpower_type_id')
                        ->where('job_order_id',$jo->id)
                        ->whereNull('deleted_at')
                        ->from('job_order_manpowers');
                    })
                    ->whereNull('deleted_at')
                    ->from('manpower_assign_types');
                    
                });
                if($sortCol != 'manpower_assign_type')
                {
                    $manpower->orderBy($sortCol, $sortDir);    
                }
                
        }else
        {
            $manpower = Manpower::with('manpowerType')
                ->with('agency')
                ->with('ManpowerAssignType.manpowerType')
                ->whereNotIn('id', function($q) { // filter by selected manpower
                    
                    $q->select('manpower_id')
                    ->whereNull('deleted_at')
                    ->whereIn('job_order_id', function($j) { // filter by even date
                        $j->select('job_order_id')
                        ->whereDate('event_date', '=', Carbon::today()->toDateString())
                        ->from('job_order_manpower_events');
                    })
                    ->from('job_order_selected_manpowers');
                })
                ->whereIn('id', function($m) use($jo) { // filter by manpower needed
                    $m->select('manpower_id')
                    ->whereIn('manpower_type_id',function($q) use($jo) {
                        $q->select('manpower_type_id')
                        ->where('job_order_id',$jo->id)
                        ->whereNull('deleted_at')
                        ->from('job_order_manpowers');
                    })
                    ->whereNull('deleted_at')
                    ->from('manpower_assign_types');
                    
                });
        }

        // Filter
        if ($request->has('filter')) {
            $this->filter($manpower, $request, Manpower::$filterable);
        }

        // Filter Selections
        if($request->has('filterSelections')) {
            $selections = $request->get('filterSelections');
            
            foreach ($selections as $key=>$filterVal)
            {
                if($filterVal)
                    if($key == 'birthdate') // filter by age
                    {
                        $minAge = 1;
                        $maxAge = $filterVal;
                        
                        $minDate = Carbon::today()->subYears($maxAge + 1)->endOfDay();
                        $maxDate = Carbon::today()->subYears($minAge);
                        
                        $manpower->whereBetween($key, [$minDate, $maxDate]);  

                        // \Log::info($minDate.'>'.$maxDate);
                        // \Log::info($manpower->toSql());
                    }else if($key == 'manpower_type_id')// filter manpower_type_id
                    {
                        // $manpower->where($key, $filterVal); 
                        $manpower->whereIn('id', function($q) use($key, $filterVal) {
                            $q->select('manpower_id')
                            ->where($key,$filterVal)
                            ->whereNull('deleted_at')
                            ->from('manpower_assign_types');
                        });   
                    }else // filter selection
                    {
                        $manpower->where($key, $filterVal);    
                    }
            }
        }

        $data = $this->parseData($manpower->paginate());
        // \Log::info($data);
        return response()->json($data, 200);
    }

    public function getManpower() {
        $manpower = Manpower::with('ManpowerAssignType.manpowerType')->with('agency')->where('setup_only', 0)->orderBy('id','DESC')->paginate();
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
        
        $manpower = Manpower::create($data);
        if(isset($input['manpower_type_id']))
        {
            foreach($input['manpower_type_id'] as $manpowerType)
            {
                $datas = [
                    'manpower_id' => $manpower['id'],
                    'manpower_type_id' => $manpowerType
                ];

                $assignType = ManpowerAssignTypes::create($datas);
            }
        }
        
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
        
        if(isset($input['manpower_type_id']))
        {

            $type = ManpowerAssignTypes::where('manpower_id',$id)->delete();
            foreach($input['manpower_type_id'] as $manpowerType)
            {
                $datas = [
                    'manpower_id' => $id,
                    'manpower_type_id' => $manpowerType
                ];

                $assignType = ManpowerAssignTypes::create($datas);    
                
                
            }
        }

        $file = $this->upload($request, $id, 'profile_picture');
        $files = $this->multiUpload($request, $id, 'documents');

        // $manpower = $this->parseData($manpower->paginate());
        return response()->json($result, 200);
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
