<?php

namespace App\Http\Controllers;

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
        // @include('sweetalert::alert');
        // alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.');
        return view('home');

    }
    public function cars() {
        return view('cars');
    }
    public function members() {
        return view('members');
    }
}
