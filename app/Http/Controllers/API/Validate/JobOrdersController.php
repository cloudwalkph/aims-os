<?php
namespace App\Http\Controllers\API\Validate;

use App\Http\Controllers\Controller;
use App\Repositories\Validate\JobOrdersRepository;
use Illuminate\Http\Request;

class JobOrdersController extends Controller {

    /**
     * @var JobOrdersRepository
     */
    protected $jobOrder;

    /**
     * JobOrdersController constructor.
     */
    public function __construct(JobOrdersRepository $jobOrder)
    {
        $this->jobOrder = $jobOrder;
    }

    /**
     * Get assigned job orders to user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJobOrders(Request $request)
    {
        // Get the user
        $user = $request->user();

        $result = $this->jobOrder->getJobOrders($user);

        // Return the values
        return response()->json($result, 200);
    }
}