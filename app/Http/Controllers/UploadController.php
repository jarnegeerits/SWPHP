<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Membership;
use App\User;
use App\Car;
use RealRashid\SweetAlert\Facades\Alert;
class UploadController extends Controller
{
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
    public function interface() {
        return view('imageUpload');
    }
    public function imageUpload(Request $request) {
        $userId = Auth::user()->id;
        $carId = $request->carId;
        $currentCar = Car::where('id', $carId)->first();
        if($currentCar->ownerId == $userId) {
            $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
            $imageName = $carId.$userId.'.'.$request->image->extension();
            $request->image->move(public_path('userimgs'), $imageName);
            $currentCar->image = $imageName;
            $currentCar->save();
            Alert::success('', 'Upload complete!');
            return redirect('/cars');
        } else {
            Alert::error('Error', 'You can only change the picture of a car you own');
            return redirect('/cars');
        }
    }
}
