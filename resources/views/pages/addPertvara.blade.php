@extends('layout.app')

@section('content')

<div class="container">
    <!-- Form OPEN -->
    {!! Form::open(['action' => 'PertvarosController@store', 'method' => 'POST']) !!}

    <h5 class="text-center" style="padding-top: 30px;padding-bottom: 30px;">Pridėti pertvara </h5>

    @include('inc.messages') 
    <div class="row">
        <div class="col-md-6" style="padding-left:0px">
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('patalpos_id', 'Patalpos kodas *') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{Form::select('patalpos_id', $patalpos, null,
                        [
                            'class' => 'form-control',
                            'placeholder' => '-Patalpos kodas-',
                            'style' => 'margin-bottom: 2px; width: 350px',
                            'id' => 'patalpos'
                        ])
                    }}<br/>
                </div>
                
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('pavadinimas', 'Patalpos dalies pavadinimas *') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('pavadinimas', '', ['class' => 'form-control', 'placeholder' => 'Patalpos dalies pavadinimas', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('tipas', 'Tipas *') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                {{Form::select('tipas', ['Administracinė' => 'Administracinė', 'Auditorija' => 'Auditorija', 'Bendro Naudojimo' => 'Bendro Naudojimo', 'Darbininkų' => 'Darbininkų', 'Infrastruktūros' => 'Infrastruktūros', 'Kambarys' => 'Kambarys', 'Kompiuterių klasė' => 'Kompiuterių klasė', 'Konferencijų salė' => 'Konferencijų salė', 'Laboratorija' => 'Laboratorija', 'Pagalbinė' => 'Pagalbinė', 'Salė' => 'Salė', 'San. Mazgas' => 'San. Mazgas', 'Sandėlis' => 'Sandėlis', 'Techninė' => 'Techninė'], null,
                    [
                        'class' => 'form-control',
                        'placeholder' => '-Patalpos tipas-',
                        'style' => 'margin-bottom: 2px; width: 230px'
                    ])
                }}<br/> 
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('pnr', 'Pertvaros Nr. *') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('pnr', '', ['class' => 'form-control', 'placeholder' => 'Pertvaros Nr.', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('talpa', 'Talpa  *') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('talpa', '', ['class' => 'form-control', 'placeholder' => 'Talpa', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('busena', 'Būsena  *') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{Form::select('busena', ['Aktyvus (-i)' => 'Aktyvus (-i)', 'Remontuojamas (-a)' => 'Remontuojamas (-a)', 'Kraustymas' => 'Kraustymas', 'Panaikintas (-a)' => 'Panaikintas (-a)'], null,
                        [
                        'class' => 'form-control',
                        'placeholder' => '-Patalpos Būsena-',
                        'style' => 'margin-bottom: 2px; width: 230px'
                        ])
                    }}<br/> 
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('kvadratura ', 'Kvadratura  *') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('kvadratura', '', ['class' => 'form-control', 'placeholder' => 'Kvadratūra', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('startdate', 'Pradžia  *') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::date('startdate', '', ['class' => 'form-control', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('enddate', 'Pabaiga') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::date('enddate', '', ['class' => 'form-control', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('telefonas', 'Telefonas') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('telefonas', '', ['class' => 'form-control', 'placeholder' => 'Telefonas', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('faksas', 'Faksas') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('faksas', '', ['class' => 'form-control', 'placeholder' => 'Faksas', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>      
        </div>
        <div class="col-md-6">
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('atsakingas', 'Atsakingas') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('atsakingas', '', ['class' => 'form-control', 'placeholder' => 'Atsakingas', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('multimedia', 'Multimedia') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                        {{ Form::text('multimedia', '', ['class' => 'form-control', 'placeholder' => 'Multimedia', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('projektinis', 'Projektinis') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('projektinis', '', ['class' => 'form-control', 'placeholder' => 'Projektinis', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('garsas', 'Garsas') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('garsas', '', ['class' => 'form-control', 'placeholder' => 'Garsas', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('pc', 'Kompiuterinė įranga') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                        {{ Form::text('pc', '', ['class' => 'form-control', 'placeholder' => 'Kompiuterinė įranga', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('stalas', 'Stalas') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('stalas', '', ['class' => 'form-control', 'placeholder' => 'Stalas', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('uztamsinimas', 'Užtamsinimas') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('uztamsinimas', '', ['class' => 'form-control', 'placeholder' => 'Užtamsinimas', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('ekranas', 'Ekranas') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('ekranas', '', ['class' => 'form-control', 'placeholder' => 'Ekranas', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('ekr_dydis', 'Ekrano dydis') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('ekr_dydis', '', ['class' => 'form-control', 'placeholder' => 'Ekrano dydis', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>    
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('internetas', 'Internetas') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                        {{ Form::text('internetas', '', ['class' => 'form-control', 'placeholder' => 'Internetas', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>
            </div>
            <div class="row" style="padding-right: 150px;">
                <div class="col-md-6 text-right">
                    {{ Form::label('kondicionierius', 'Kondicionierius') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                        {{ Form::text('kondicionierius', '', ['class' => 'form-control', 'placeholder' => 'Kondicionierius', 'style' => 'margin-bottom: 2px; width: 230px']) }}<br/>
                </div>  
            </div>
        </div>
    </div>
    
    <div style="padding-bottom: 20px;">
        <hr/>
        <a class="btn btn-light" href="/pertvaros">Grįžti atgal</a>
        {{ Form::submit('Toliau', ['class' => 'btn btn-secondary']) }}
    </div>
  
    <!-- Form CLOSE -->
    {!! Form::close() !!}
</div>

<script type="text/javascript">
    $("#patalpos").select2();
    theme: 'bootstrap';
    allowClear: true;
</script>

@endsection