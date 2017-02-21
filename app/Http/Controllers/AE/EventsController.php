<?php
namespace App\Http\Controllers\AE;

use App\Http\Controllers\Controller;
use App\Traits\EventsTrait;

class EventsController extends Controller {
    use EventsTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }
}