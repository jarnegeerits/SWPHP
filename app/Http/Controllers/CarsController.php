<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Membership;
use App\User;
use App\Car;
use RealRashid\SweetAlert\Facades\Alert;
class CarsController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function cars() {
        // Zoekt welke memberships bij de huidige user hoort
        $ownMemberships = Membership::where('userId', Auth::user()->id)->get();
        foreach ($ownMemberships as $ownMembership) {
            $cars[] = Car::where('id', $ownMembership->carId)->first();
            $memberSearch = Membership::where('carId', $ownMembership->carId)->get();
            foreach ($memberSearch as $currentMembership){
                $almostMemberships = Membership::where('userId', $currentMembership->userId)->get();
                $allMemberships[] = $almostMemberships->where('carId', $currentMembership->carId)->first();
                $allUsers[] = User::where('id',$currentMembership['userId'])->first();
                $allUsers = array_unique($allUsers);
            }
        }
        return view('cars', [
            'yourCars'=>$cars,
            'memberships'=>$allMemberships,
            'members'=>$allUsers,
            ]);
    }
    public function editCar(Request $request) {
        $editCar = Car::where('id', $request->carId)->first();
        $editCar->brand = $request->carBrand;
        $editCar->model = $request->carModel;
        $editCar->fuelCap = $request->carFuelCap;
        $editCar->currentFuel = $request->carCurrentFuel;
        $editCar->currentPoss = $request->carCurrentPoss;
        $editCar->save();
        toast('Edit Complete!','success');
        return redirect('/cars');
    }
    public function removeCar(Request $request) {
        $removeCar = Car::where('id', $request->carId)->first();
        $removeMemberships = Membership::where('carId', $removeCar->id)->get();
        $removeCar->delete();
        foreach ($removeMemberships as $removeMembership) {
            $removeMembership->delete();
        }
        Alert::success('', 'Car removed!');
        return redirect('/cars');
    }
}
