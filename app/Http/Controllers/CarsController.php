<?php

namespace App\Http\Controllers;

use App\Car;
use App\Membership;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        // Car Management
        $users = User::all();
        $cars = Car::all();
        $memberships = Membership::all();
        foreach ($users as $user) {
            if (Auth::user()->id == $user->id) {
                $currentUser = $user;
            }
        }
        // Zoekt welke membership bij de huidige user hoort
        foreach ($memberships as $membership) {
            if ($currentUser->id == $membership->userId) {
                $currentMembership = $membership;
            }
        }
        // Zoekt welke auto bij de huidige user hoort
        $fuelpercentage = 0;
        foreach ($cars as $car) {
            if ($currentMembership->carId == $car->id) {
                $currentCar = $car;
            }
        }
        $currentPoss = $currentUser->name;
        foreach ($users as $user) {
            if ($currentCar->currentPoss == $user->id) {
                $currentPoss = $user->name;
            }
        }
        return view('cars', [
            'user' => $currentUser,
            'car' => $currentCar,
            'membership' => $currentMembership,
            'currentPoss' => $currentPoss,
        ]);
    }
}
