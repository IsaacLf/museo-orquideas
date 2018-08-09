<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\User;
use App\Entry;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
        {
            $user = User::find(Auth::user()->id);
        }
        $entries = Entry::all();
        return view('admin.home', ["user" => $user, "entries" =>$entries]);
    }
}
