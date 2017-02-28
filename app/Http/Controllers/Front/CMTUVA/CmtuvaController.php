<?php

namespace App\Http\Controllers\Front\CMTUVA;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;

class CmtuvaController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        config(['app.name' => 'CMTUVA | AIMS']);

        return view('cmtuva.main');
    }

    public function schedules()
    {
        config(['app.name' => 'CMTUVA SCHEDULES | AIMS']);

        return view('cmtuva.schedules');
    }

    public function venues()
    {
        config(['app.name' => 'CMTUVA VENUES | AIMS']);

        return view('cmtuva.venue');
    }

    public function importVenues(Request $request)
    {
        if (! $request->hasFile('excel')) {
            return response()->json(['error' => 'You are not uploading anything']);
        }

        $file = $request->file('excel');

        \Excel::load($file, function($reader) {

            $results = $reader->get();
            \Log::info($results);
            \DB::transaction(function() use ($results) {
                foreach ($results as $venues) {
                    foreach ($venues as $venue) {
                        if (! (isset($venue['category']) && $venue['category'])) {
                            continue;
                        }

                        $data = $this->buildVenueData($venue);

                        Venue::create($data);
                    }
                }
            });
        });

        return redirect()->back();
    }

    private function buildVenueData($venue) {
        $data = [
            'category' => $venue['category'],
            'subcategory'   => $venue['subcategory'],
            'area'      => $venue['area'],
            'sub_area'  => $venue['sub_area'],
            'venue'     => $venue['venue'],
            'street'    => $venue['street'],
            'lsm'       => $venue['lsm'],
            'rate'      => $venue['min_rate'],
            'rate_max'  => $venue['max_rate'],
            'eft'               => isset($venue['est_combined']) && $venue['est_combined'] ? $venue['est_combined'] : 0,
            'eft_male'          => isset($venue['est_male']) && $venue['est_male'] ? $venue['est_male'] : 0,
            'eft_female'        => isset($venue['est_female']) && $venue['est_female'] ? $venue['est_female'] : 0,
            'target_hits'       => isset($venue['target_hits']) && $venue['target_hits'] ? $venue['target_hits'] : 0,
            'actual_hits'       => isset($venue['actual_hits_male']) && $venue['actual_hits_male'] ? $venue['actual_hits_male'] : 0,
            'actual_hits_f'     => isset($venue['actual_hits_female']) && $venue['actual_hits_female'] ? $venue['actual_hits_female'] : 0,
            'actual_dry_m'      => isset($venue['dry_sampling_male']) && $venue['dry_sampling_male'] ? $venue['dry_sampling_male'] : 0,
            'actual_dry_f'      => isset($venue['dry_sampling_female']) && $venue['dry_sampling_female'] ? $venue['dry_sampling_female'] : 0,
            'actual_exper_m'    => isset($venue['experiential_sampling_male']) && $venue['experiential_sampling_male'] ? $venue['experiential_sampling_male'] : 0,
            'actual_exper_f'    => isset($venue['experiential_sampling_female']) && $venue['experiential_sampling_female'] ? $venue['experiential_sampling_female'] : 0,
            'contact_person'    => isset($venue['name']) && $venue['name'] ? $venue['name'] : '',
            'contact_number'    => isset($venue['email']) && $venue['email'] ? $venue['email'] : '',
            'contact_email'     => isset($venue['contact_no']) && $venue['contact_no'] ? $venue['contact_no'] : '',
            'remarks'           => isset($venue['remarks']) && $venue['remarks'] ? $venue['remarks'] : ''
        ];

        return $data;
    }

    public function plans()
    {
        config(['app.name' => 'CMTUVA PLANS | AIMS']);

        return view('cmtuva.plans.index');
    }

    public function planDetails()
    {
        config(['app.name' => 'CMTUVA PLANS DETAILS | AIMS']);

        return view('cmtuva.plans.details');
    }
}
