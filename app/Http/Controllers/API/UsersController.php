<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\UserProfile;
use App\User;

class UsersController extends Controller {


    public function all()
    {
        $users = User::with('profile', 'department', 'role')->get();

        return $this->responseOK($users);
    }

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

            $userProfile = UserProfile::create($userProfileData);

            $result = User::with('profile', 'department', 'role')
                ->where('id', $user->id)->first();
        });

        if (! $result) {
            return $this->responseBadRequest(['error' => 'User not created']);
        }

        return $this->responseCreated($result);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::where('id', $request->user()->id)->first();
        if (! \Hash::check($request->get('current_password'), $user->password)) {
            return $this->responseBadRequest(['error' => 'Current Password is incorrect']);
        }

        if ($request->get('new_password') !== $request->get('verify_password')) {
            return $this->responseBadRequest(['error' => 'Password mismatch']);
        }

        User::where('id', $request->user()->id)->update([
           'password' => \Hash::make($request->get('new_password'))
        ]);

        return $this->responseOK(['message' => 'Successfully changed password']);
    }

}