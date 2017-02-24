<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Traits\FilterTrait;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller {
    use FilterTrait;

    public function all()
    {
        $users = User::with('profile', 'department', 'role')->get();

        return response()->json($users, 200);
    }

    public function getByDepartment($departmentId)
    {
        $users = User::where('department_id', $departmentId)
            ->with('profile', 'department', 'role')->get();

        return response()->json($users, 200);
    }

    public function index(Request $request)
    {
        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = User::orderBy($sortCol, $sortDir);
        } else {
            $query = User::orderBy('id', 'asc');
        }

        $query->join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
            ->join('user_roles', 'user_roles.id', '=', 'users.user_role_id')
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->select('user_profiles.*', 'users.email', 'user_roles.name as user_role',
                'departments.name as department',
                \DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as full_name'));

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, User::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
        \Log::info($query->toSql());
        // Get the data
        $users = $query->paginate($perPage);

        return response()->json($users, 200);
    }
    /**
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $result = null;
        \DB::transaction(function() use ($input, &$result) {
            $userData = [
                'email'         => $input['email'],
                'user_role_id'  => $input['user_role_id'],
                'department_id' => $input['department_id'],
                'password'      => \Hash::make('password')
            ];

            $user = User::create($userData);

            $userProfileData = [
                'user_id'       => $user->id,
                'first_name'    => $input['first_name'],
                'middle_name'   => $input['middle_name'],
                'last_name'     => $input['last_name'],
                'birthdate'     => $input['birth_date'],
                'gender'        => $input['gender'],
                'street'        => $input['street'],
                'barangay'      => $input['barangay'],
                'city'          => $input['city'],
                'province'      => $input['province']
            ];

            $user->profile()->create($userProfileData);

            $result = User::with('profile', 'department', 'role')
                ->where('id', $user->id)->first();
        });


        return response()->json($result, 201);
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($userId)
    {
        $user = User::where('id', $userId)->delete();

        if (! $user) {
            return response()->json([], 400);
        }

        return response()->json($user, 200);
    }

}