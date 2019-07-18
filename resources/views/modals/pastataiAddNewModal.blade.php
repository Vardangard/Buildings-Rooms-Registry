<!-- Ivesti nauja pastata -->
<button class="btn btn-light" style="left:20px;position:absolute" data-toggle="modal" data-target="#addNewModal">Įvesti nauja pastatą</button>
<!-- Add New Modal -->
<div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">

        <!-- Form OPEN -->
        {!! Form::open(['action' => 'PastataiController@store', 'method' => 'POST']) !!}

        <div class="modal-content">
            <div class="modal-header bg-dark" style="color:white" style="color:white">
                <h5 class="modal-title" id="addNewModalLabel">Įveskite nauja pastatą</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @include('inc.messages')
                <div>
                    <div class="container">
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('kadastronr', 'Kadastrinis Nr. *') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::text('kadastronr', '', ['class' => 'form-control', 'placeholder' => 'Kadastrinis Nr.', 'style' => 'margin-bottom: 2px']) }} <br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('kodas', 'Kodas *') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::text('kodas', '', ['class' => 'form-control', 'placeholder' => 'Kodas', 'style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('pavadinimas', 'Pavadinimas  *') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::text('pavadinimas', '', ['class' => 'form-control', 'placeholder' => 'Pavadinimas', 'style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('adresas', 'Adresas  *') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::text('adresas', '', ['class' => 'form-control', 'placeholder' => 'Adresas', 'style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('aukstai', 'Aukštai  *') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::number('aukstai', '', ['min' => 1, 'max' => 16, 'class' => 'form-control', 'placeholder' => 'Aukštai', 'style' => 'margin-bottom: 2px', 'style' => 'width:50%;']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('padaliniai', 'Padaliniai') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::text('padaliniai', '', ['class' => 'form-control', 'placeholder' => 'Padaliniai', 'style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('startdate', 'Pradžia  *') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::date('startdate', '', ['class' => 'form-control', 'style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('enddate', 'Pabaiga') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::date('enddate', '', ['class' => 'form-control', 'style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('miestas', 'Miestas  *') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{Form::select('miestas',['Kaunas' => 'Kaunas', 'Vilnius' => 'Vilnius', 'Klaipėda' => 'Klaipėda'], null,
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => 'Pasirinkti Miestą',
                                        'style' => 'margin-bottom: 2px; width: 278px',
                                        'id' => 'miestass'
                                    ])
                                }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('busena', 'Būsena  *') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{Form::select('busena',['Aktyvus (-i)' => 'Aktyvus (-i)', 'Remontuojamas (-a)' => 'Remontuojamas (-a)', 'Kraustymas' => 'Kraustymas', 'Panaikintas (-a)' => 'Panaikintas (-a)'], null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => 'Pasirinkti Būsena',
                                    'style' => 'margin-bottom: 2px; width: 278px',
                                    'id' => 'busenaa'
                                ])
                            }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('Darbo laikas') }}<br/>
                            </div>
                            <div class="col-md-3 text-left">
                                {{ Form::time('p_s', \Carbon\Carbon::createFromFormat('H:i', '08:00', 'Europe/Vilnius'), ['class' => 'form-control', 'style' => 'margin-bottom: 2px;']) }}
                            </div>
                            <div class="col-md-3 text-left">
                                {{ Form::time('p_e', \Carbon\Carbon::createFromFormat('H:i', '17:00', 'Europe/Vilnius'), ['class' => 'form-control', 'style' => 'margin-bottom: 2px;']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('Darbo laikas Š') }}<br/>
                            </div>
                            <div class="col-md-3 text-left">
                                {{ Form::time('ses_s', \Carbon\Carbon::createFromFormat('H:i', '08:00', 'Europe/Vilnius'), ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-3 text-left">
                                {{ Form::time('ses_e', \Carbon\Carbon::createFromFormat('H:i', '17:00', 'Europe/Vilnius'), ['class' => 'form-control', 'style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('Darbo laikas S') }}<br/>
                            </div>
                            <div class="col-md-3 text-left">
                                {{ Form::time('sek_s', \Carbon\Carbon::createFromFormat('H:i', '08:00', 'Europe/Vilnius'), ['class' => 'form-control']) }}
                            </div>
                            <div class="col-md-3 text-left">
                                {{ Form::time('sek_e', \Carbon\Carbon::createFromFormat('H:i', '17:00', 'Europe/Vilnius'), ['class' => 'form-control', 'style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Uždaryti</button>
                {{ Form::submit('Pridėti', ['class' => 'btn btn-secondary']) }}
            </div>
        </div> 
         <!-- Form CLOSE -->
        {!! Form::close() !!}
    </div>
</div>

<script type="text/javascript">
    $("#miestass").select2({
        minimumResultsForSearch: 20,
    });
    $("#busenaa").select2({
        minimumResultsForSearch: 20,
    });
    allowClear: true;
</script>