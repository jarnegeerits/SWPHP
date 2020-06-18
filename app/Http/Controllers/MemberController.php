<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Membership;
use App\User;
use App\Car;
class MemberController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getMembers() {
        // haalt alle memberships van de user op
        $ownMemberships = Membership::where('userId', Auth::user()->id)->get();
        foreach ($ownMemberships as $ownMembership) {
            $userCars[] = Car::where('id', $ownMembership->carId)->first();
            $memberSearch = Membership::where('carId', $ownMembership->carId)->get();
            foreach ($memberSearch as $currentMembership){
                $allMemberships[] = Membership::where('userId', $currentMembership->userId)->first();
                $allUsers[] = User::where('id',$currentMembership['userId'])->first();
            }
        }
        // $nameMembers = User::where('id', $otherMembers->userId)->get();
        // $nameMembers;
        return view('members', [
            'ownCars' => $userCars,
            'allMemberships' => $allMemberships,
            'allUsers' => $allUsers,
        ]);
    }
}
