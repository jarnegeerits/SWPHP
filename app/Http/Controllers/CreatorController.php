<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Membership;
use App\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CreatorController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    public function newCar(Request $request) {
        $newCar = new Car();
        $newCar->brand = $request->carBrand;
        $newCar->model = $request->carModel;
        $newCar->fuelCap = $request->carFuelCap;
        $newCar->currentFuel = $request->carCurrentFuel;
        $newCar->fuelUnit = $request->carFuelUnit;
        $newCar->currentPoss = Auth::user()->id;
        $newCar->save();
        return redirect('/home');
    }
    public function newMembership() {

    }
}
