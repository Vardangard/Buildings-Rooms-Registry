<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patalpa;
use App\Pastatas;
use App\Pertvara;
use DB;

use Exception;

class PatalposController extends Controller
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
        $pastatai = Pastatas::pluck('pavadinimas', 'id');
        #$pastatu_patalpos = Patalpa::with('pastatas')->get()->pluck('pastatas.pavadinimas', 'patalpa.id')->unique();
        $nr = Patalpa::pluck('nr', 'nr');
        $patalpos = Patalpa::orderBy('created_at', 'desc')->paginate(25);
        $pertvaros = Pertvara::all();
        return view('pages.patalpos', compact('patalpos', 'pertvaros', 'pastatai', 'nr'));
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
        $this->authorize('create', \App\Patalpa::class);

            $this->validate($request, [
                'pastatai_id' => 'required',
                'aukstas' => 'required',
                'nr' => 'required|max:50'
            ]);
        
        try{
            
        $patalpa = new Patalpa;
        $patalpa->pastatai_id = $request->input('pastatai_id');
        $patalpa->aukstas = $request->input('aukstas');
        $patalpa->pertvaros = 0;
        $patalpa->nr = $request->input('nr');
        $patalpa->save();

        } catch(\Yajra\Pdo\Oci8\Exceptions\Oci8Exception $ex)
        {
            return back()->withError($patalpa->pastatas->pavadinimas.' pastate '.$request->input('nr').' patalpos numeris jau egzistuoja');
            /*return back()->withError(' 
            ─▄▀▀▀▀▄─█──█────▄▀▀█─▄▀▀▀▀▄─█▀▀▄\n
            ─█────█─█──█────█────█────█─█──█
            ─█────█─█▀▀█────█─▄▄─█────█─█──█
            ─▀▄▄▄▄▀─█──█────▀▄▄█─▀▄▄▄▄▀─█▄▄▀
             
            ─────────▄██████▀▀▀▀▀▀▄
            ─────▄█████████▄───────▀▀▄▄
            ──▄█████████████───────────▀▀▄
            ▄██████████████─▄▀───▀▄─▀▄▄▄──▀▄
            ███████████████──▄▀─▀▄▄▄▄▄▄────█
            █████████████████▀█──▄█▄▄▄──────█
            ███████████──█▀█──▀▄─█─█─█───────█
            ████████████████───▀█─▀██▄▄──────█
            █████████████████──▄─▀█▄─────▄───█
            █████████████████▀███▀▀─▀▄────█──█
            ████████████████──────────█──▄▀──█
            ████████████████▄▀▀▀▀▀▀▄──█──────█
            ████████████████▀▀▀▀▀▀▀▄──█──────█
            ▀████████████████▀▀▀▀▀▀──────────█
            ──███████████████▀▀─────█──────▄▀
            ──▀█████████████────────█────▄▀
            ────▀████████████▄───▄▄█▀─▄█▀
            ──────▀████████████▀▀▀──▄███
            ──────████████████████████─█
            ─────████████████████████──█
            ────████████████████████───█
            ────██████████████████▄▄▄▄▄█
             
            ─────────────█─────█─█──█─█───█
            ─────────────█─────█─█──█─▀█─█▀
            ─────────────█─▄█▄─█─█▀▀█──▀█▀
            ─────────────██▀─▀██─█──█───█');*/
        
        }
        return redirect('/patalpos')->with('success', 'Patalpa pridėta');

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
        $patalpa = Patalpa::find($id);

        $this->authorize('update', $patalpa);

        $pastatai = Pastatas::pluck('pavadinimas', 'id');
        return view('pages.redaguotiPatalpa', compact('patalpa', 'pastatai'));
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
        $this->validate($request, [
            'pastatai_id' => 'required',
            'aukstas' => 'required',
            'nr' => 'required|max:50'
        ]);

        try{
            
        $patalpa = Patalpa::find($id);
        $patalpa->pastatai_id = $request->input('pastatai_id');
        $patalpa->aukstas = $request->input('aukstas');
        $patalpa->nr = $request->input('nr');
        $patalpa->save();

        } catch(\Illuminate\Database\QueryException $ex)
        {
            return back()->withError($ex);
        }

        return redirect('/patalpos')->with('success', 'Patalpa sėkmingai redaguota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patalpa = Patalpa::find($id);

        $this->authorize('delete', $patalpa);

        $patalpa->delete();
        return redirect('/patalpos')->with('success', 'Patalpa ištrinta');
    }

    public function deleteAll(Request $request) 
    {
        $ids = $request->get('ids');
        Patalpa::destroy($ids);
        return redirect('/patalpos')->with('success', 'Pasirinktos patalpos ištrintos');
    }

    public function search(Request $request) 
    {
        $pastato_id = $request->get('pastatai_id');
        $aukstas = $request->get('aukstas');
        $patalposNr = $request->get('nr');
        $pertvarosSk = $request->get('pertvaros');

        $patalpos = Patalpa::with('pastatas')->where(function ($query) use ($pastato_id, $aukstas, $patalposNr, $pertvarosSk){
            if(!empty($pastato_id)) {
                $query->where('pastatai_id', 'like', '%'.$pastato_id.'%');
            }
            if(!empty($aukstas)) {
                $query->where('aukstas', 'like', '%'.$aukstas.'%');
            }
            if(!empty($patalposNr)) {
                $query->where('nr', 'like', '%'.$patalposNr.'%');
            }
            if(!empty($pertvarosSk) || $pertvarosSk == 0) {
                $query->where('pertvaros', 'like', '%'.$pertvarosSk.'%');
            }  
        })
        ->paginate(25);

        $patalpos->appends(['pastatai_id' => $pastato_id, 'aukstas' => $aukstas, 'pertvaros' => $pertvarosSk, 'nr' => $patalposNr]);

        $pastatai = Pastatas::pluck('pavadinimas', 'id');
        $nr = Patalpa::pluck('nr', 'nr');

        return view('pages.patalpos', ['patalpos' => $patalpos], compact('pastatai', 'nr', 'patalpos'));
    }

}
