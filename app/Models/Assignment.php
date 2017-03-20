<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\JobOrder;
use App\Models\UserProfile;

class Assignment extends Model
{
    use SoftDeletes;

    protected $table = 'assignments';
    protected $guarded = ['id'];

    static function loadRatees( $jid = null ){

        $returnArr = array();

        $jo_results = JobOrder::where('job_order_no', '=', $jid)->firstOrFail();
        $assigned_users = Assignment::where('job_order_id', '=', $jo_results->id)->get();

        foreach ( $assigned_users as $assigned_user){
            $user_profile = UserProfile::where('user_id', '=', $assigned_user->id)->first();
            dd($user_profile->user_id);
            $returnArr[$user_profile->user_id] = $user_profile->last_name.', '.$user_profile->first_name;
        }
        dd(json_decode($returnArr));
    }
}
