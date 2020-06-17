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
        // haalt alle memberships van de user op
        $ownMemberships = Membership::where('userId', Auth::user()->id)->get();
        error_log($ownMemberships);
        foreach ($ownMemberships as $ownMembership) {
            $allMemberships[] = Membership::where('carId', $ownMembership->carId)->first();
            $otherMembersId = Membership::where('carId', $ownMembership->carId)->get();
            foreach ($otherMembersId as $id){
                $allUsers[] = User::where('id',$id['userId'])->first();
            }
        }
        // $nameMembers = User::where('id', $otherMembers->userId)->get();
        // $nameMembers;
        return view('members', [
            'allMemberships' => $allMemberships,
            'allUsers' => $allUsers,
        ]);
    }
}
