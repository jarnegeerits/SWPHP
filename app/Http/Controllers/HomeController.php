<?php

namespace App\Http\Controllers;

use App\Car;
use App\Membership;
use App\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use Alert;
use RealRashid\SweetAlert\Facades\Alert;
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

        if (isset($currentMembership) == false) {
            return redirect('/newcar');
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
        // Currency icon based on user's currency
        $currencyIcon = "fa-dollar-sign";
        switch ($currentMembership->debtUnit) {
            case "$":
                $currencyIcon = "fa-dollar-sign";
            break;
            case "€":
                $currencyIcon = "fa-euro-sign";
            break;
            case "£":
                $currencyIcon = "fa-pound-sign";
            break;
        }
        // Current poss
        $currentPoss = $currentUser->name;
        foreach ($users as $user) {
            if ($currentCar->currentPoss == $user->id) {
                $currentPoss = $user->name;
            }
        }

        // View inladen met de nodige vars
        return view('home', [
            'user' => $currentUser,
            'car' => $currentCar,
            'membership' => $currentMembership,
            'currencyIcon' => $currencyIcon,
            'fuelPercentage' => $fuelpercentage,
            'currentPoss' => $currentPoss,
            ]);
    }
    public function members() {
        // Member Management
        $users = User::all();
        $cars = Car::all();
        $memberships = Membership::all();
        // Zoekt user in db op basis van login gegevens zodat in de blade niet
        // telkens auth::user()->variabele nodig is
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
        if (isset($currentMembership) == false) {
            return redirect('/newcar');
        }
        return view('members');
    }
}
