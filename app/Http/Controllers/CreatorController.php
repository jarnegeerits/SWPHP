<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Membership;
use App\User;
use Carbon\Traits\Timestamp;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CreatorController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function constructNewCar() {
        return view('new.newCar');
    }
    public function postNewCar(Request $request) {
        $newCar = new Car();
        $newCar->brand = $request->carBrand;
        $newCar->model = $request->carModel;
        $newCar->fuelCap = $request->carFuelCap;
        $newCar->currentFuel = $request->carCurrentFuel;
        $newCar->fuelUnit = $request->carFuelUnit;
        $newCar->currentPoss = Auth::user()->id;
        $newCar->save();
        toast('Getting everything ready!','info');
        return $this->postNewMembership();
    }
    public function postNewMembership() {
        $newMemberCar = Car::where('currentPoss', Auth::user()->id)->first();
        $newMembership = new Membership();
        $newMembership->carId = $newMemberCar->id;
        $newMembership->userId = Auth::user()->id;
        $newMembership->debt = 0;
        $newMembership->debtUnit = "€";
        $newMembership->lastRefuelAmount = 0;
        $newMembership->save();
        Alert::success('All done', 'Lets get started!');
        return redirect('/home');
    }

    public function constructJoinCar() {
        return view('new.joinCar');
    }

    public function postJoinCar(Request $request) {
        $newJoinHost = User::where('email', $request->carJoin)->first();
        $newJoinHostMembership = Membership::where('userId', $newJoinHost->id)->first();
        $newJoinUserMembership = new Membership();
        $newJoinUserMembership->carId = $newJoinHostMembership->carId;
        $newJoinUserMembership->userId = Auth::user()->id;
        $newJoinUserMembership->debt = 0;
        $newJoinUserMembership->debtUnit = "€";
        $newJoinUserMembership->lastRefuelAmount = 0;
        $newJoinUserMembership->save();

        Alert::success('A new member has arrived!');
        return redirect('/home');


    }

}





