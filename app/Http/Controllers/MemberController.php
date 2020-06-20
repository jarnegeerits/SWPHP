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
        $editMembership = Membership::where('id', $request->membershipId)->first();
        $editMembership->debt = $request->memberDebt;
        $editMembership->lastRefuelAmount = $request->memberRefuel;
        if(isset($request->memberRefuelDate)) {
            $editMembership->lastRefuelDate = $request->memberRefuelDate;
        }
        $editMembership->save();
        toast('Edit Complete!','success');
        return redirect('/members/get');
    }
    public function removeMember(Request $request) {
        $disabledMembership = Membership::where('id', $request->membershipId)->first();
        if ($disabledMembership->debt == 0) {
            $disabledMembership->delete();
            toast('Member has been removed!','success');
            return redirect('/members/get');
        } else {
            Alert::error('Error', 'Debt must be 0 before removal');
            return redirect('/members/get');
        }
    }
    public function newMember(Request $request) {
        $newMember = User::where('email', $request->email)->first();
        if ($newMember->id != Auth::user()->id) {
            $newMembership = New Membership();
            $newMembership->carId = $request->carId;
            $newMembership->userId = $newMember->id;
            $newMembership->save();
            toast('Member added!','success');
            return redirect('/members/get');
        } else {
            Alert::error('', 'You cannot add yourself!');
            return redirect('/members/get');
        }

    }
}
