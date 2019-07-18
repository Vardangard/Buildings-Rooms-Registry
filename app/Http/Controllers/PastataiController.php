<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pastatas;
use DB; 
use App\User; 
use Auth;

class PastataiController extends Controller
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
        /*$users = User::whereHas('permissions', function ($query) {
            $query->where('permission_id', '=', env("P_ADMIN"));
        })->get();*/

        //dd($users);
        //dd(env("P_REGULAR"));

        $this->authorize('viewAny', \App\Pastatas::class);

        
        $pastatai = Pastatas::orderBy('id', 'desc')->get();
        $kadastrai = Pastatas::pluck('kadastronr', 'kadastronr');
        $kodai = Pastatas::pluck('kodas', 'kodas');
        $pavadinimai = Pastatas::pluck('pavadinimas', 'pavadinimas');
        $adresai = Pastatas::pluck('adresas', 'adresas');
        return view('pages.pastatai', compact('kadastrai', 'kodai', 'pavadinimai', 'adresai'))->with('pastatai', $pastatai);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', \App\Pastatas::class);

        $this->validate($request, [
            'kadastronr' => 'required|max:30',
            'kodas' => 'required',
            'pavadinimas' => 'required',
            'adresas' => 'required',
            'aukstai' => 'required',
            'miestas' => 'required',
            'busena' => 'required', 
            'startdate' => 'required|date|before_or_equal:today',
            'enddate' => 'date|after_or_equal:startdate|nullable'
        ]);

       
        try {

            $pastatas = new Pastatas;
            $pastatas->kadastronr = $request->input('kadastronr');
            $pastatas->kodas = $request->input('kodas');
            $pastatas->pavadinimas = $request->input('pavadinimas');
            $pastatas->adresas = $request->input('adresas');
            $pastatas->aukstai = $request->input('aukstai');
            $pastatas->padaliniai = $request->input('padaliniai');
            $pastatas->miestas = $request->input('miestas');
            $pastatas->busena = $request->input('busena');
            $pastatas->startdate = $request->input('startdate');
            $pastatas->enddate = $request->input('enddate');
            $pastatas->darbo_laikas_p_s = $request->input('p_s');
            $pastatas->darbo_laikas_p_e = $request->input('p_e');
            $pastatas->darbo_laikas_ses_s = $request->input('ses_s');
            $pastatas->darbo_laikas_ses_e = $request->input('ses_e');
            $pastatas->darbo_laikas_sek_s = $request->input('sek_s');
            $pastatas->darbo_laikas_sek_e = $request->input('sek_e');
            $pastatas->save();

        }
        catch(\Yajra\Pdo\Oci8\Exceptions\Oci8Exception $ex)
        {
            return back()->withError('Pastatas su panašiu pavadinimu, kodu arba kadastriniu numeriu jau egzistuoja');
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            return back()->withError('Pastatas su panašiu pavadinimu, kodu arba kadastriniu numeriu jau egzistuoja');
        }

        return redirect('/pastatai')->with('success', 'Pastatas sėkmingai pridėtas');
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
        $pastatas = Pastatas::find($id);
        $this->authorize('update', $pastatas);
        return view('pages.redaguotiPastata')->with('pastatas', $pastatas);
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
            'kadastronr' => 'required|max:30',
            'kodas' => 'required|max:10',
            'pavadinimas' => 'required|max:150',
            'adresas' => 'required|max:50',
            'aukstai' => 'required',
            'padaliniai' => 'required|max:500',
            'miestas' => 'required|max:15',
            'busena' => 'required|max:30', 
            'startdate' => 'required|date|before_or_equal:today',
            'enddate' => 'date|after_or_equal:startdate|nullable'
        ]);

        try {

        $pastatas = Pastatas::find($id);
        $pastatas->kadastronr = $request->input('kadastronr');
        $pastatas->kodas = $request->input('kodas');
        $pastatas->pavadinimas = $request->input('pavadinimas');
        $pastatas->adresas = $request->input('adresas');
        $pastatas->aukstai = $request->input('aukstai');
        $pastatas->padaliniai = $request->input('padaliniai');
        $pastatas->miestas = $request->input('miestas');
        $pastatas->busena = $request->input('busena');
        $pastatas->startdate = $request->input('startdate');
        $pastatas->enddate = $request->input('enddate');
        $pastatas->darbo_laikas_p_s = $request->input('p_s');
        $pastatas->darbo_laikas_p_e = $request->input('p_e');
        $pastatas->darbo_laikas_ses_s = $request->input('ses_s');
        $pastatas->darbo_laikas_ses_e = $request->input('ses_e');
        $pastatas->darbo_laikas_sek_s = $request->input('sek_s');
        $pastatas->darbo_laikas_sek_e = $request->input('sek_e');
        $pastatas->save();
        
        } 
        catch(\Yajra\Pdo\Oci8\Exceptions\Oci8Exception $ex)
        {
            return back()->withError('Pastatas su panašiu pavadinimu, kodu arba kadastriniu numeriu jau egzistuoja');
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            return back()->withError('Pastatas su panašiu pavadinimu, kodu arba kadastriniu numeriu jau egzistuoja');
        }

        return redirect('/pastatai')->with('success', 'Pastatas sėkmingai redaguotas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pastatas = Pastatas::find($id);

        $this->authorize('delete', $pastatas);

        $pastatas->delete();
        return redirect('/pastatai')->with('success', 'Pastatas ištrintas');
    }

    public function deleteAll(Request $request) 
    {
        $ids = $request->get('ids');
        //$collection = Pastatas::find($ids);
        //$this->authorize('delete', $collection);
        $this->authorize('create', \App\Pastatas::class);
        Pastatas::destroy($ids);
        return redirect('/pastatai')->with('success', 'Pasirinkti pastatai ištrinti');
    }

    public function search(Request $request) 
    {
        $kadastronr = $request->get('kadastronr');
        $kodas = $request->get('kodas');
        $pavadinimas = $request->get('pavadinimas');
        $adresas = $request->get('adresas');
        $aukstai = $request->get('aukstai');
        $busena = $request->get('busena');
        $pastatai = DB::table('pastatas')
            ->where(function ($query) use ($kadastronr, $kodas, 
                                $pavadinimas, $adresas, $aukstai, $busena) {
                if(!empty($kadastronr)) {
                    $query->where('kadastronr', 'like', '%'.$kadastronr.'%');
                }
                if(!empty($kodas)) {
                    $query->Where('kodas', 'like', '%'.$kodas.'%');
                }
                if(!empty($pavadinimas)) {
                    $query->Where('pavadinimas', 'like', '%'.$pavadinimas.'%');
                }
                if(!empty($adresas)) {
                    $query->Where('adresas', 'like', '%'.$adresas.'%');
                }
                if(!empty($aukstai)) {
                    $query->Where('aukstai', 'like', '%'.$aukstai.'%');
                }
                if(!empty($busena)) {
                    $query->Where('busena', 'like', '%'.$busena.'%');
                }  
            })
            ->orderBy('id', 'desc')->get();
            
        //$pastatai->appends(['kadastronr' => $kadastronr, 'kodas' => $kodas,
        //                    'pavadinimas' => $pavadinimas, 'adresas' => $adresas,
        //                    'aukstai' => $aukstai, 'busena' => $busena]);
        
        $kadastrai = Pastatas::pluck('kadastronr', 'kadastronr');
        $kodai = Pastatas::pluck('kodas', 'kodas');
        $pavadinimai = Pastatas::pluck('pavadinimas', 'pavadinimas');
        $adresai = Pastatas::pluck('adresas', 'adresas');


        return view('pages.pastatai', ['pastatai' => $pastatai], compact('kadastrai', 'kodai', 'pavadinimai', 'adresai'));
    }
}
