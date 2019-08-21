<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Pastatas;
use DB; 
use App\User; 
use App\Laikas;
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
        $laikai = Laikas::all();
        return view('pages.pastatai', compact('kadastrai', 'kodai', 'pavadinimai', 'adresai', 'laikai'))->with('pastatai', $pastatai);
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
            'kodas' => 'required|max:10|unique:luadm.pp_pastatai',
            'pavadinimas' => 'required|max:150',
            'adresas' => 'required|max:50',
            'aukstai' => 'required',
            'padaliniai' => 'max:500',
            'miestas' => 'required|max:15',
            'busena' => 'required|max:30', 
            'startdate' => 'date|before_or_equal:today|nullable',
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
            $pastatas->city = $request->input('miestas'); //miestas
            $pastatas->busena = $request->input('busena');
            $pastatas->startdate = $request->input('startdate');
            $pastatas->enddate = $request->input('enddate');
            $pastatas->save();

            $laikas = new Laikas;
            $laikas->pastato_id = $pastatas->id;
            $laikas->darbo_laikas_p_s = $request->input('p_s');
            $laikas->darbo_laikas_p_e = $request->input('p_e');
            $laikas->darbo_laikas_ses_s = $request->input('ses_s');
            $laikas->darbo_laikas_ses_e = $request->input('ses_e');
            $laikas->darbo_laikas_sek_s = $request->input('sek_s');
            $laikas->darbo_laikas_sek_e = $request->input('sek_e');
            //dd($laikas);
            $laikas->save();   
            
            

        }
        catch(\Yajra\Pdo\Oci8\Exceptions\Oci8Exception $ex)
        {
            return back()->withError('Pastatas su panašiu pavadinimu, kodu arba kadastriniu numeriu jau egzistuoja');
            //return back()->withError($ex);
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            return back()->withError('Pastatas su panašiu pavadinimu, kodu arba kadastriniu numeriu jau egzistuoja');
            //return back()->withError($ex);
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
        if(in_array($pastatas->id, Laikas::pluck('pastato_id')->toArray()))
            $laikas = Laikas::find($pastatas->id); //Laikas::where('pastato_id', '=', $pastatas->id)->first();
        else
            $laikas = null;
        $this->authorize('update', $pastatas);
        return view('pages.redaguotiPastata', compact('pastatas', 'laikas'));
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
            'padaliniai' => 'max:500',
            'miestas' => 'required|max:15',
            'busena' => 'required|max:30', 
            'startdate' => 'date|before_or_equal:today|nullable',
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
            $pastatas->city = $request->input('miestas'); //miestas
            $pastatas->busena = $request->input('busena');
            $pastatas->startdate = $request->input('startdate');
            $pastatas->enddate = $request->input('enddate');
            if($pastatas->updated_at == null)
                $pastatas->updated_at = Carbon::now();
            $pastatas->save();

            if(in_array($pastatas->id, Laikas::pluck('pastato_id')->toArray()))
            {
                $laikas = Laikas::find($pastatas->id);
                $laikas->darbo_laikas_p_s = $request->input('p_s');
                $laikas->darbo_laikas_p_e = $request->input('p_e');
                $laikas->darbo_laikas_ses_s = $request->input('ses_s');
                $laikas->darbo_laikas_ses_e = $request->input('ses_e');
                $laikas->darbo_laikas_sek_s = $request->input('sek_s');
                $laikas->darbo_laikas_sek_e = $request->input('sek_e');
                //dd($laikas);
                $laikas->save();   
            } else {
                $laikas = new Laikas;
                $laikas->pastato_id = $pastatas->id;
                $laikas->darbo_laikas_p_s = $request->input('p_s');
                $laikas->darbo_laikas_p_e = $request->input('p_e');
                $laikas->darbo_laikas_ses_s = $request->input('ses_s');
                $laikas->darbo_laikas_ses_e = $request->input('ses_e');
                $laikas->darbo_laikas_sek_s = $request->input('sek_s');
                $laikas->darbo_laikas_sek_e = $request->input('sek_e');
                //dd($laikas);
                $laikas->save(); 
            }
            //dd($pastatas);

        } 
        catch(\Yajra\Pdo\Oci8\Exceptions\Oci8Exception $ex)
        {
            return back()->withError('Pastatas su panašiu pavadinimu, kodu arba kadastriniu numeriu jau egzistuoja');
            //return back()->withError($ex);
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            return back()->withError('Pastatas su panašiu pavadinimu, kodu arba kadastriniu numeriu jau egzistuoja');
            //return back()->withError($ex);
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

    /*public function deleteAll(Request $request) 
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
    }*/
}
