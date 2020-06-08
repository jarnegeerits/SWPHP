<?php

namespace App\Http\Controllers;

use App\Car;
use App\Membership;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use RealRashid\SweetAlert\Facades\Alert;
// use UxWeb\SweetAlert\SweetAlert;

class HomeController extends Controller {
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
    public function index() {
        // Dashboard
        $users = User::all();
        $cars = Car::all();
        $memberships = Membership::all();
        // Zoekt user in db op basis van login gegevens zodat in de blade niet telkens auth::user()->variabele nodig is
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
                $fuelpercentage = ($currentCar->currentFuel / $currentCar->fuelCap * 100);
                if ($fuelpercentage > 100) {
                    $fuelpercentage = 100;
                }
            }
        }

        return view('home', [
            'user' => $currentUser,
            'car' => $currentCar,
            'membership' => $currentMembership,
            'fuelPercentage' => $fuelpercentage,
            ]);
    }
    public function cars() {
        // Car Management
        return view('cars');
    }
    public function members() {
        // Member Management
        return view('members');
    }
}
