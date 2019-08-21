<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Session;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!Auth::user()->permissions->where('permission_id', env('P_ADMIN'))->isEmpty() || !Auth::user()->permissions->where('permission_id', env("P_REGULAR"))->isEmpty())
            return view('pages.dashboard')->with('wellcome', 'Sveiki prisijunge '.Auth::user()->name);
        else {
            return redirect('unauth');
        }
    }
}
