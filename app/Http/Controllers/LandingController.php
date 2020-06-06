<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function landingLoad() {
        return view('landing');
    }
}
