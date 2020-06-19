<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Membership;
use App\User;
use App\Car;
use RealRashid\SweetAlert\Facades\Alert;

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
                $almostMemberships = Membership::where('userId', $currentMembership->userId)->get();
                $allMemberships[] = $almostMemberships->where('carId', $currentMembership->carId)->first();
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
    public function editMember(Request $request) {
        error_log("function reached");
    }
    public function removeMember(Request $request) {
        $disabledMembership = Membership::where('id', $request->membershipId)->first();
        error_log('function reached');
        if ($disabledMembership->debt == 0) {
            $disabledMembership->delete();
            Alert::success('', 'Member has been removed!');
            return redirect('/members/get');
        } else {
            Alert::error('Error', 'Debt must be 0 before removal');
            return redirect('/members/get');
        }
    }
}
