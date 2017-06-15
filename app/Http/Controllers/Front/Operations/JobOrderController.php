<?php

namespace App\Http\Controllers\Front\Operations;

use App\Http\Controllers\Controller;
use App\Models\JobOrder;
use App\Models\JobOrderAddUser;
use App\User;
use Illuminate\Http\Request;

class JobOrderController extends Controller
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
        config(['app.name' => 'Operations | AIMS']);

        return view('operations.joborder.index');
    }

    public function show($joId)
    {
        config(['app.name' => 'Operations | AIMS']);

        $assigned = \DB::table('job_order_add_users')->join('users', 'users.id', '=', 'job_order_add_users.user_id')
            ->join('user_profiles', 'user_profiles.user_id', '=', 'job_order_add_users.user_id')
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->select('job_order_add_users.*', 'departments.name as department',
                \DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as user_name'))
            ->where('users.department_id', '=', '1')->get();

        $users = User::where('department_id', '=', 1)->get();

        return view('operations.joborder.details', compact('joId', 'users', 'assigned'));
    }

    public function assign(Request $request, $joId)
    {
        $input = $request->all();
        $jo = JobOrder::where('job_order_no', '=', $joId)->first();

        $data = [
            'job_order_id'  => $jo->id,
            'user_id'       => $input['user_id']
        ];

        $user = JobOrderAddUser::create($data);

        return redirect()->back();
    }
}
