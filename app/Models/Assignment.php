<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\JobOrder;

class Assignment extends Model
{
    use SoftDeletes;

    protected $table = 'assignments';
    protected $guarded = ['id'];

    static function loadRatees( $jid = null ){

        $jo_results = JobOrder::where('job_order_no', '=', $jid)->firstOrFail();

        $assigned_users = Assignment::where('job_order_id', '=', $jo_results->id)->get();

        return $assigned_users;

    }
}
