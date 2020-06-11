<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;

class LandingController extends Controller
{
    public function landingLoad() {
        return view('landing');
    }
}
