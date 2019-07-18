<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Session;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        if(!Auth::user()->permissions->where('permission_id', env('P_ADMIN'))->isEmpty() || !Auth::user()->permissions->where('permission_id', env("P_REGULAR"))->isEmpty())
            return view('pages.dashboard');
        else {
            return redirect('unauth');
        }
    }


}
