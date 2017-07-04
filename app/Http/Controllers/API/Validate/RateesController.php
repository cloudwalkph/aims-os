<?php
namespace App\Http\Controllers\API\Validate;

use App\Http\Controllers\Controller;
use App\Repositories\Validate\RateesRepository;
use Illuminate\Http\Request;

class RateesController extends Controller {

    /**
     * @var RateesRepository
     */
    protected $ratee;

    /**
     * RateesController constructor.
     * @param $ratee
     */
    public function __construct(RateesRepository $ratee)
    {
        $this->ratee = $ratee;
    }


    public function getRatees(Request $request, $jobOrderId, $validateType)
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['unauthorize', 401]);
        }

        $ratees = $this->ratee->getRatees($jobOrderId, $user->department_id, $validateType);

        return response()->json($ratees, 200);
    }
}