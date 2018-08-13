<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Entry;
use App\Media;
use App\User;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance
     * 
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application entries area
     * 
     * @return  Illuminate\Http\Response
     */
    public function edit(){
        $entries = Entry::all();
        $mine = DB::table('entries')->where('author', Auth::user()->username);
        $current_count = $mine->count();
        return view('admin.entries', ["entries" => $entries, "mine"=>$mine, "mine_count" => $current_count]);
    }

    /**
     * Show the application media area
     * 
     * @return Illuminate\Http\Response
     */
    public function upload(){
        $media = Media::all();
        return view('admin.media', ['media' => $media]);
    }

    /**
     * Show the application users area
     * 
     * @return Illuminate\Http\Response
     */
    public function users(){
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

}
