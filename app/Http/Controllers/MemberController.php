<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getMembers() {
        $carMembership = Membership::where('userId', Auth::user()->id)->first();
        $otherMembers = Membership::where('carId', $carMembership->carId)->get();
        return view('members', ['member'=>$otherMembers]);
               
}
}
