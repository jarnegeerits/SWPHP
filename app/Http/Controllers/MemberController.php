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
        $nameMembers = User::all();
        // error_log($otherMembers);
        // $nameMembers = User::where('id', $otherMembers->userId)->get();
        // error_log($otherMembers);
        // $nameMembers = new User();
        // foreach ($otherMembers as $otherMember) {
        //     $nameMembers = User::where('id', $otherMember->userId)->first();
        // }
        return view('members', [
            'carMembers' => $otherMembers,
            'allUsers' => $nameMembers,
        ]);
    }
}


