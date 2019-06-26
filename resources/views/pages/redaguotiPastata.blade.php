@extends('layout.app')

@section('content')

<div class="container">
    <!-- Form OPEN -->
    {!! Form::open(['action' => ['PastataiController@update', $pastatas->id], 'method' => 'POST']) !!}

    <h5 class="text-center" style="padding-top: 20px">Redaguoti pastatą</h5>

    @include('inc.messages')
        
    <div class="row d-flex justify-content-center" style="padding-right: 250px;">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('kadastronr', 'Kadastrinis Nr.') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('kadastronr', $pastatas->kadastronr, ['class' => 'form-control', 'placeholder' => 'Kadastrinis Nr.', 'style' => 'margin-bottom: 2px']) }} <br/>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('kodas', 'Kodas') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('kodas', $pastatas->kodas, ['class' => 'form-control', 'placeholder' => 'Kodas', 'style' => 'margin-bottom: 2px']) }}<br/>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('pavadinimas', 'Pavadinimas') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('pavadinimas', $pastatas->pavadinimas, ['class' => 'form-control', 'placeholder' => 'Pavadinimas', 'style' => 'margin-bottom: 2px']) }}<br/>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('adresas', 'Adresas') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('adresas', $pastatas->adresas, ['class' => 'form-control', 'placeholder' => 'Adresas', 'style' => 'margin-bottom: 2px']) }}<br/>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('aukstai', 'Aukštai') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::number('aukstai', $pastatas->aukstai, ['min' => 1, 'max' => 16, 'class' => 'form-control', 'placeholder' => 'Aukštai', 'style' => 'margin-bottom: 2px', 'style' => 'width:50%;']) }}<br/>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 text-right">       
                    {{ Form::label('padaliniai', 'Padaliniai') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('padaliniai', $pastatas->padaliniai, ['class' => 'form-control', 'placeholder' => 'Padaliniai', 'style' => 'margin-bottom: 2px']) }}<br/>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('startdate', 'Pradžia') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::date('startdate', $pastatas->startdate, ['class' => 'form-control', 'style' => 'margin-bottom: 2px']) }}<br/>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('enddate', 'Pabaiga') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::date('enddate', $pastatas->endate, ['class' => 'form-control', 'style' => 'margin-bottom: 2px']) }}<br/>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('miestas', 'Miestas') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{Form::select('miestas', ['Kaunas' => 'Kaunas', 'Vilnius' => 'Vilnius', 'Klaipėda' => 'Klaipėda'], $pastatas->miestas,
                        [
                        'class' => 'form-control',
                        'placeholder' => 'Pasirinkti Miestą',
                        'style' => 'margin-bottom: 2px'
                        ])
                    }}<br/>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('busena', 'Būsena') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{Form::select('busena',['Aktyvus (-i)' => 'Aktyvus (-i)', 'Remontuojamas (-a)' => 'Remontuojamas (-a)', 'Kraustymas' => 'Kraustymas', 'Panaikintas (-a)' => 'Panaikintas (-a)'], $pastatas->busena,
                        [
                        'class' => 'form-control',
                        'placeholder' => 'Pasirinkti Būsena',
                        'style' => 'margin-bottom: 2px'
                        ])
                    }}<br/>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('Darbo laikas') }}<br/>
                </div>
                <div class="col-md-3 text-left">
                    {{ Form::time('p_s', \Carbon\Carbon::createFromFormat('H:i', $pastatas->darbo_laikas_p_s ?? '08:00', 'Europe/Vilnius'), ['class' => 'form-control']) }}
                </div>
                <div class="col-md-3 text-left">
                    {{ Form::time('p_e', \Carbon\Carbon::createFromFormat('H:i', $pastatas->darbo_laikas_p_e  ?? '17:00', 'Europe/Vilnius'), ['class' => 'form-control', 'style' => 'margin-bottom: 2px']) }}<br/>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('Darbo laikas Š') }}<br/>
                </div>
                <div class="col-md-3 text-left">
                    {{ Form::time('ses_s', \Carbon\Carbon::createFromFormat('H:i', $pastatas->darbo_laikas_ses_s  ?? '08:00', 'Europe/Vilnius'), ['class' => 'form-control']) }}
                </div>
                <div class="col-md-3 text-left">
                    {{ Form::time('ses_e', \Carbon\Carbon::createFromFormat('H:i', $pastatas->darbo_laikas_ses_e ?? '17:00', 'Europe/Vilnius'), ['class' => 'form-control', 'style' => 'margin-bottom: 2px']) }}<br/>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('Darbo laikas S') }}<br/>
                    </div>
                <div class="col-md-3 text-left">
                    {{ Form::time('sek_s', \Carbon\Carbon::createFromFormat('H:i', $pastatas->darbo_laikas_sek_s  ?? '08:00', 'Europe/Vilnius'), ['class' => 'form-control']) }}
                </div>
                 <div class="col-md-3 text-left">
                    {{ Form::time('sek_e', \Carbon\Carbon::createFromFormat('H:i', $pastatas->darbo_laikas_sek_e ?? '17:00', 'Europe/Vilnius'), ['class' => 'form-control', 'style' => 'margin-bottom: 2px']) }}<br/>
                </div> 
            </div>
        </div>
    </div>
    <hr/>
    <div style="padding-bottom: 20px">
        <a class="btn btn-light" href="/pastatai">Grįžti atgal</a>
        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::submit('Redaguoti', ['class' => 'btn btn-secondary']) }}
    </div>
  
    <!-- Form CLOSE -->
    {!! Form::close() !!}
</div>
@endsection