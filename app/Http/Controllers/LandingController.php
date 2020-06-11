<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Alert;
use RealRashid\SweetAlert\Facades\Alert;

class LandingController extends Controller
{
    public function landingLoad() {
        // Alert::warning('Warning Title', 'Warning Message');
        return view('landing');

    }
}
