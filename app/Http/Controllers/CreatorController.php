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
        $newCar->ownerId = Auth::user()->id;
        $newCar->save();
        toast('Getting everything ready!','info');
        return $this->postNewMembership($newCar);
    }
    public function postNewMembership($newCar) {
        // $newMemberCar = Car::where('currentPoss', Auth::user()->id)->first();
        $newMembership = new Membership();
        $newMembership->carId = $newCar->id;
        $newMembership->userId = Auth::user()->id;
        $newMembership->save();
        Alert::success('All done', 'Lets get started!');
        return redirect('/home');
    }

    public function constructJoinCar() {
        return view('new.joinCar');
    }
    public function joinSelector(Request $request) {
        $newJoinHost = User::where('email', $request->carJoin)->first();
        $newJoinHostMemberships = Membership::where('userId', $newJoinHost->id)->get();
        foreach ($newJoinHostMemberships as $newJoinHostMembership) {
            $newJoinHostCars[] = Car::where('Id', $newJoinHostMembership->carId)->first();
        }
        return view('new.selectCar', [
            'hostCars' => $newJoinHostCars,
        ]);
    }
    public function postJoinCar(Request $request) {
        $joinCar = Car::where('id', $request->carSelect)->first();
        $newMembership = new Membership();
        $newMembership->carId = $joinCar->id;
        $newMembership->userId = Auth::user()->id;
        $newMembership->save();
        Alert::success('Car joined!');
        return redirect('/home');
    }

}
