<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class JobOrderDiscussion extends Model
{
    protected $guarded = ['id'];

    public static $rules = [
        'message'   => 'required|min:5'
    ];

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
