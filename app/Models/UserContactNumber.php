<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserContactNumber extends Model
{
    use SoftDeletes;

    protected $table = 'user_contact_numbers';

}
