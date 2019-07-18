<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pastatas;
use App\Assign;
use Auth;

class AssignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', \App\User::class);

        //$users = User::orderBy('id', 'desc')->paginate(25);
        $pastatai = Pastatas::pluck('pavadinimas', 'id');
        $users = User::whereHas('permissions', function ($query) {
            $query->where('permission_id', '=', env('P_REGULAR'));
        })->orderBy('id', 'desc')->paginate(25);

        //$user = User::find(30);
        //dd(Auth::user()->pastatai);
        //dd(Auth::user());
        //echo '<h1>'.Auth::user()->id.'</h1>';
        
        return view('users.vartotojai', compact('users', 'pastatai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function assign(Request $request, $id)
    {
        $this->authorize('view', \App\User::class);

        $user = User::whereHas('permissions', function ($query) {
            $query->where('permission_id', '=', env('P_REGULAR'));
        })->find($id);

        foreach($user->pastatai as $pastatas)
        {
            if($pastatas->id == $request->input('pastatai_id'))
            {
                return back()->withError('Šiam vatotojui jau yra priskirtas pasirinktas pastatas!');
            }
        }

        $user->pastatai()->attach($request->input('pastatai_id'));

        return redirect('/vartotojai', )->with('success', 'Sėkmingai priskirtas pastatas!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pastato_id, $user_id)
    {
        // 
    }

    public function detach($pastato_id, $user_id)
    {
        $pastatas = Pastatas::find($pastato_id);
        $user = User::find($user_id);
        $user->pastatai()->detach($pastatas);
        return redirect('/vartotojai')->with('success', 'Pastatas ištrintas');
    }
}
