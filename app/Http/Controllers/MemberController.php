<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Membership;
use App\User;
class MemberController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getMembers() {
        $carMembership = Membership::where('userId', Auth::user()->id)->first();
        $otherMembers = Membership::where('carId', $carMembership->carId)->get();
        $nameMembers = User::where('id', $carMembership->userId)->get();

        return View('members')
        ->with('members', $otherMembers)
        ->with('users', $nameMembers);
    }
}


