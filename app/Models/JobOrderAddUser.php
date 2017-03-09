<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderAddUser extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_add_users';
    protected $guarded = ['id'];

    public static $rules = [
        'job_order_id' => 'required',
        'user_id'      => 'required',
    ];

    public function jobOrder()
    {
        return $this->belongsTo('App\Models\JobOrder');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
