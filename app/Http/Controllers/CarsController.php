<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Membership;
use App\User;
use App\Car;
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
        // Haalt de huidige user op
        $currentUser = User::where('id', Auth::user()->id)->first();

        // Zoekt welke memberships bij de huidige user hoort
        $memberships = Membership::where('userId', Auth::user()->id)->get();
        foreach ($memberships as $membership) {
            $cars[] = Car::where('id', $membership->carId)->first();
        }
        if (isset($memberships) == false) {
            return redirect('/newcar');
        }
        
        return view('cars', [
            'yourCars'=>$cars,
            'user'=>$currentUser,
            ]);
    }

    // public function carpic() {
    //     // Car Picture: Default bij elke auto
    //     $data = request() -> validate([
    //         'caption' => 'required',
    //         'image' => ['required', 'image'],
    //     ]);

    //     dd(request('image'));

    //     auth()->user()->cars()->create($data);

    //     dd(request()->all());
    // }
}
