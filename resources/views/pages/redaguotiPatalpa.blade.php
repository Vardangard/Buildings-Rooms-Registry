@extends('layout.app')

@section('content')

<div class="container">
    <!-- Form OPEN -->
    {!! Form::open(['action' => ['PatalposController@update', $patalpa->id], 'method' => 'POST']) !!}

    <h5 class="text-center" style="padding-top: 20px; margin-bottom: 30px;">Redaguoti patalpa</h5>

    @include('inc.messages') 
    <div class="row d-flex justify-content-center" style="padding-right: 190px">
        <div class="col-md-8" >
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('pastatai_id', 'Pastato kodas') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                {{Form::select('pastatai_id', $pastatai, $patalpa->pastatai_id,
                    [
                    'class' => 'form-control',
                    'placeholder' => '-Pastato kodas-',
                    'style' => 'margin-bottom: 2px',
                    'id' => 'pastatas'
                    ])
                }}<br/>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('aukstas', 'Patalpos aukštas') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::number('aukstas', $patalpa->aukstas, ['min'=>1,'max'=>16, 'class' => 'form-control', 'placeholder' => 'Aukštas', 'style' => 'width:50%;']) }}<br/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('nr', 'Patalpos numeris') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('nr', $patalpa->nr, ['class' => 'form-control', 'placeholder' => 'Patalpos Nr', 'style' => 'margin-bottom: 2px']) }}<br/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-right">
                    {{ Form::label('pertvaros', 'Patalpos dalių sk') }}<br/>
                </div>
                <div class="col-md-6 text-left">
                    {{ Form::text('pertvaros', $patalpa->pertvaros, ['class' => 'form-control', 'placeholder' => 'Patalpos dalių skaičius', 'style' => 'margin-bottom: 2px']) }}<br/>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div style="padding-bottom: 20px">
        <a class="btn btn-light" href="/patalpos">Grįžti atgal</a>
        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::submit('Toliau', ['class' => 'btn btn-secondary']) }}
    </div>
  
    <!-- Form CLOSE -->
    {!! Form::close() !!}
</div>

<script type="text/javascript">
    $("#pastatas").select2();
    allowClear: true;
</script>
@endsection