<?php

namespace App\Http\Controllers\Front\Validate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailValidationController extends Controller
{

    public function index( $uid = null )
    {
        return view('admin/validate/email');
    }
}
