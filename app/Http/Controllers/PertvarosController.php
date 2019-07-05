<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertvara;
use App\Patalpa;
use App\Pastatas;
use DB;

class PertvarosController extends Controller
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
    public function index(Request $request)
    {
        #$patalpos = Patalpa::pluck('nr', 'id');

        $pastatai = Pastatas::pluck('pavadinimas', 'id');
        $pastatu_patalpos = Patalpa::with('pastatas')->get()->pluck('pastatas.pavadinimas', 'patalpa.id')->unique();
        $plnr = Patalpa::pluck('nr', 'nr');
        $numeris = Pertvara::pluck('nr', 'nr');
        $pertvaros = Pertvara::orderBy('updated_at', 'desc')->paginate(25);
        return view('pages.pertvaros', compact('pertvaros', 'pastatai', 'plnr', 'numeris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', \App\Pertvara::class);
        $patalpos = DB::table('patalpas as pl')
        ->join('pastatas as pt', 'pt.id', '=', 'pl.pastatai_id')
        ->select(DB::raw("pl.id, (pt.pavadinimas || ', ' || pl.nr || ', ' || pl.aukstas ||' aukštas') as patalpa"))
        ->orderBy('patalpa','asc')
        ->pluck('patalpa','pl.id');
        //$patalpos = DB::table('patalpas')->pluck('nr', 'id');
        return view('pages.addPertvara', compact('patalpos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'patalpos_id' => 'required',
            'kvadratura' => 'required|max:6',
            'talpa' => 'required|max:8',
            'tipas' => 'required|max:30',
            'startdate' => 'required|date|before_or_equal:today',
            'enddate' => 'date|after_or_equal:today|nullable',
            'busena' => 'required',
            'pavadinimas' => 'required|max:150',
        ]);

        try{

        $pertvara = new Pertvara;
        $pertvara->patalpos_id = $request->input('patalpos_id');
        $pertvara->kvadratura = $request->input('kvadratura');
        $pertvara->talpa = $request->input('talpa');
        $pertvara->tipas = $request->input('tipas');
        $pertvara->nr = $request->input('pnr');
        $pertvara->startdate = $request->input('startdate');
        $pertvara->enddate = $request->input('enddate');
        $pertvara->telefonas = $request->input('telefonas');
        $pertvara->faksas = $request->input('faksas');
        $pertvara->busena = $request->input('busena');
        $pertvara->atsakingas = $request->input('atsakingas');
        $pertvara->multimedia = $request->input('multimedia');
        $pertvara->pc = $request->input('pc');
        $pertvara->stalas = $request->input('stalas');
        $pertvara->uztamsinimas = $request->input('uztamsinimas');
        $pertvara->garsas = $request->input('garsas');
        $pertvara->ekranas = $request->input('ekranas');
        $pertvara->internetas = $request->input('internetas');
        $pertvara->pavadinimas = $request->input('pavadinimas');
        $pertvara->projektinis = $request->input('projektinis');
        $pertvara->kondicionierius = $request->input('kondicionierius');
        $pertvara->ekr_dydis = $request->input('ekr_dydis');
        $pertvara->save();
        $patalpa = Patalpa::find($pertvara->patalpos_id);
        $patalpa->pertvaros = $patalpa->pertvaros + 1;
        $patalpa->save();

        } catch(\Illuminate\Database\QueryException $ex)
        {
            return back()->withError($pertvara->patalpa->nr.' patalpoje '.$request->input('pnr').' patalpos dalis jau egzistuoja');
        }


        return redirect('/pertvaros')->with('success', 'Patalpos dalis sėkmingai pridėta');
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
        $pertvara = Pertvara::find($id);

        $this->authorize('update', $pertvara);

        $patalpos = DB::table('patalpas as pl')
        ->join('pastatas as pt', 'pt.id', '=', 'pl.pastatai_id')
        ->select(DB::raw("pl.id, pt.pavadinimas || ', ' || pl.nr || ', ' || pl.aukstas ||' aukštas' as patalpa"))
        ->orderBy('patalpa','asc')
        ->pluck('patalpa','pl.id');
        //$patalpos = DB::table('patalpas')->pluck('nr', 'id');
        return view('pages.redaguotiPertvara', compact('pertvara', 'patalpos'));
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
            'patalpos_id' => 'required',
            'kvadratura' => 'required|max:6',
            'talpa' => 'required|max:8',
            'tipas' => 'required|max:30',
            'startdate' => 'required|date|before_or_equal:today',
            'enddate' => 'date|after_or_equal:today|nullable',
            'busena' => 'required',
            'pavadinimas' => 'required|max:50',
        ]);


        $pertvara = Pertvara::find($id);
        $pertvara->patalpos_id = $request->input('patalpos_id');
        $pertvara->kvadratura = $request->input('kvadratura');
        $pertvara->talpa = $request->input('talpa');
        $pertvara->tipas = $request->input('tipas');
        $pertvara->nr = $request->input('pnr');
        $pertvara->startdate = $request->input('startdate');
        $pertvara->enddate = $request->input('enddate');
        $pertvara->telefonas = $request->input('telefonas');
        $pertvara->faksas = $request->input('faksas');
        $pertvara->busena = $request->input('busena');
        $pertvara->atsakingas = $request->input('atsakingas');
        $pertvara->multimedia = $request->input('multimedia');
        $pertvara->pc = $request->input('pc');
        $pertvara->stalas = $request->input('stalas');
        $pertvara->uztamsinimas = $request->input('uztamsinimas');
        $pertvara->garsas = $request->input('garsas');
        $pertvara->ekranas = $request->input('ekranas');
        $pertvara->internetas = $request->input('internetas');
        $pertvara->pavadinimas = $request->input('pavadinimas');
        $pertvara->projektinis = $request->input('projektinis');
        $pertvara->kondicionierius = $request->input('kondicionierius');
        $pertvara->ekr_dydis = $request->input('ekr_dydis');
        $pertvara->save();

     

        return redirect('/pertvaros')->with('success', 'Patalpos dalis sėkmingai redaguota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pertvara = Pertvara::find($id);

        $this->authorize('delete', $pertvara);

        $patalpa = Patalpa::find($pertvara->patalpos_id);
        $patalpa->pertvaros = $patalpa->pertvaros - 1;
        $patalpa->save();
        $pertvara->delete();
        
        return redirect('/pertvaros')->with('success', 'Patalpos dalis ištrinta');
    }

    public function deleteAll(Request $request) 
    {
        $ids = $request->get('ids');
        if($ids != null)
        {
            foreach($ids as $id) 
            {
                $pertvara = Pertvara::find($id);
                
                $this->authorize('delete', $pertvara);

                $patalpa = Patalpa::find($pertvara->patalpos_id);
                $patalpa->pertvaros = $patalpa->pertvaros - 1;
                $patalpa->save();
            }
        }
        Pertvara::destroy($ids);

        return redirect('/pertvaros')->with('success', 'Ištrintos pasirinktos patalpų dalys');
    }

    public function search(Request $request) 
    {
        
        ##############################################################################################################################################
        $pastatai = Pastatas::pluck('pavadinimas', 'id');
        $pastatu_patalpos = Patalpa::with('pastatas')->get()->pluck('pastatas.pavadinimas', 'patalpa.id')->unique();
        $plnr = Patalpa::pluck('nr', 'nr');
        $numeris = Pertvara::pluck('nr', 'nr');
        $patalpos = Patalpa::all();

        $pastato_id = $request->get('pastatai_id');
        $aukstas = $request->get('aukstas');
        $patalposNr = $request->get('plnr');
        $pertvaros = $request->get('pertvaros');
        ###
        $tipas = $request->get('tipas');
        $pertvarosNr = $request->get('numeris');
        $talpa = $request->get('talpa');
        $kvadratura = $request->get('kvadratura');
        $busena = $request->get('busena');
        $multimedia = $request->get('multimedia');
        $pc = $request->get('pc');
        $irmv = $request->get('irmv');
        $uztamsinimas = $request->get('uztamsinimas');
        $garsas = $request->get('garsas');
        $stalas = $request->get('stalas');
        $ekranas = $request->get('ekranas');
        $ekr_dydis = $request->get('ekr_dydis');
        $internetas = $request->get('internetas');
        $kondicionierius = $request->get('kondicionierius');


        $pertvaros = Pertvara::whereHas('patalpa', function ($query) use ($pastato_id, $aukstas, $patalposNr, $pertvaros){
            if(!empty($pastato_id)) {
                $query->where('pastatai_id', 'like', '%'.$pastato_id.'%');
            }
            if(!empty($aukstas)) {
                $query->where('aukstas', 'like', '%'.$aukstas.'%');
            }
            if(!empty($patalposNr)) {
                $query->where('nr', 'like', '%'.$patalposNr.'%');
            }
            if(!empty($pertvaros)) {
                $query->where('pertvaros', 'like', '%'.$pertvaros.'%');
            }  
        })
        ->where(function ($query) use ($tipas, $pertvarosNr, $talpa,
                                            $kvadratura, $busena, $multimedia, $pc, $irmv, $uztamsinimas, $garsas, 
                                            $stalas, $ekranas, $ekr_dydis, $internetas, $kondicionierius) 
        {
            if(!empty($tipas)) {
                $query->where('tipas', 'like', '%'.$tipas.'%');
            }  
            if(!empty($pertvarosNr)) {
                $query->where('nr', 'like', '%'.$pertvarosNr.'%');
            }  
            if(!empty($talpa)) {
                $query->where('talpa', 'like', '%'.$talpa.'%');
            }  
            if(!empty($kvadratura)) {
                $query->where('kvadratura', 'like', '%'.$kvadratura.'%');
            }
            if(!empty($busena)) {
                $query->where('busena', 'like', '%'.$busena.'%');
            }  
            if($multimedia != 0) {
                $query->whereNotNull('multimedia');
            }  
            if($pc  != 0) {
                $query->whereNotNull('pc');
            }   
            if($irmv != 0) {
                $query->whereNotNull('irmv');
            }   
            if($uztamsinimas != 0) {
                $query->whereNotNull('uztamsinimas');
            }  
            if($garsas != 0) {
                $query->whereNotNull('garsas');
            }  
            if($stalas != 0) {
                $query->whereNotNull('stalas');
            }  
            if($ekranas != 0) {
                $query->whereNotNull('ekranas');
            }  
            if($ekr_dydis != 0) {
                $query->whereNotNull('ekr_dydis');
            }  
            if($internetas != 0) {
                $query->whereNotNull('internetas'); 
            }  
            if($kondicionierius != 0) {
                $query->whereNotNull('kondicionierius');
            }  
        })->paginate(20);
        

        return view('pages.pertvaros', ['pertvaros' => $pertvaros], compact('pastatai', 'pastatu_patalpos', 'plnr', 'numeris', 'patalpos'));
    }
}
