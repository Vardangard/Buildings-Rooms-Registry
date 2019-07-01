<!-- Button trigger modal -->
<button class="btn btn-light" <?php echo $d = (App\Pertvara::count() < 1) ? 'disabled="disabled"' : '' ?> style="left:338px;position:absolute" data-toggle="modal" data-target="#searchModal">Paieška/Filtravimas</button>
<!-- Search Modal -->
<div class="modal fade" id="searchModal" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <!-- Form OPEN -->
        {!! Form::open(['action' => 'PertvarosController@search', 'method' => 'GET']) !!}

        <div class="modal-content">
            <div class="modal-header bg-dark" style="color:white">
                <h5 class="modal-title" id="searchModalLabel">Patalpų dalių paieška</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @include('inc.messages1')
                <div>
                    <div class="container">
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('pastatai_id', 'Pastato kodas') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{Form::select('pastatai_id', $pastatai, null,
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => '-Visi-',
                                        'style' => 'margin-bottom: 2px; width: 278px',
                                        'id' => 'pastatasss'
                                    ])
                                }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('aukstas', 'Patalpos aukštas') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::number('aukstas', '', ['min'=>1,'max'=>16, 'class' => 'form-control', 'placeholder' => 'Aukštas', 'style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('plnr', 'Patalpos numeris') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{Form::select('plnr', $plnr, null,
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => '-Visi-',
                                        'style' => 'margin-bottom: 2px; width: 278px',
                                        'id' => 'plnrr'
                                    ])
                                }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('pertvaros', 'Patalpos dalių sk') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::text('pertvaros', '', ['class' => 'form-control', 'placeholder' => 'Patalpos dalių skaičius', 'style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('tipas', 'Tipas') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{Form::select('tipas', ['Administracinė' => 'Administracinė', 'Auditorija' => 'Auditorija', 'Bendro Naudojimo' => 'Bendro Naudojimo', 'Darbininkų' => 'Darbininkų', 'Infrastruktūros' => 'Infrastruktūros', 'Kambarys' => 'Kambarys', 'Kompiuterių klasė' => 'Kompiuterių klasė', 'Konferencijų salė' => 'Konferencijų salė', 'Laboratorija' => 'Laboratorija', 'Pagalbinė' => 'Pagalbinė', 'Salė' => 'Salė', 'San. Mazgas' => 'San. Mazgas', 'Sandėlis' => 'Sandėlis', 'Techninė' => 'Techninė'], null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => '-Visi-',
                                    'style' => 'margin-bottom: 2px; width: 278px',
                                    'id' => 'tipass'
                                ])
                            }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('numeris', 'Numeris') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                <!--{{ Form::text('numeris', '', ['class' => 'form-control', 'placeholder' => 'Numeris', 'style' => 'margin-bottom: 2px']) }}<br/>-->
                                {{Form::select('numeris', $numeris, null,
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => '-Visi-',
                                        'style' => 'margin-bottom: 2px; width: 278px',
                                        'id' => 'numeriss'
                                    ])
                                }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('talpa', 'Talpa') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::text('talpa', '', ['class' => 'form-control', 'placeholder' => 'Talpa', 'style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('kvadratura ', 'Kvadratura') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::text('kvadratura', '', ['class' => 'form-control', 'placeholder' => 'Kvadratūra', 'style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('busena', 'Būsena') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{Form::select('busena',['Aktyvus (-i)' => 'Aktyvus (-i)', 'Remontuojamas (-a)' => 'Remontuojamas (-a)', 'Kraustymas' => 'Kraustymas', 'Panaikintas (-a)' => 'Panaikintas (-a)'], null,
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => '-Visos-',
                                        'style' => 'margin-bottom: 2px; width: 278px',
                                        'id' => 'busenaa'
                                    ])
                                }}<br/> 
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('multimedia', 'Multimedia') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::hidden('multimedia', 0) }}
                                {{ Form::checkbox('multimedia', 1, 0, ['style' => 'margin-bottom: 10px;']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('pc', 'Kompiuterinė įranga') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::checkbox('pc', 1, 0, ['style' => 'margin-bottom: 10px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('irmv', 'Įr. montavimo vieta') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::checkbox('irmv', 1, 0, ['style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('uztamsinimas', 'Užtamsinimas') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::checkbox('uztamsinimas', 1, 0, ['style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('garsas', 'Garsas') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::checkbox('garsas', 1, 0, ['style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('stalas', 'Stalas') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::checkbox('stalas', 1, 0, ['style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('ekranas', 'Ekranas') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::checkbox('ekranas', 1, 0, ['style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('ekr_dydis', 'Ekrano dydis') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::checkbox('ekr_dydis', 1, 0, ['style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('internetas', 'Internetas') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::checkbox('internetas', 1, 0, ['style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('kondicionierius', 'Kondicionierius') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::checkbox('kondicionierius', 1, 0, ['style' => 'margin-bottom: 2px']) }}<br/>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Uždaryti</button>
                {{ Form::submit('Ieškoti', ['class' => 'btn btn-secondary']) }}
            </div>
        </div> 
        <!-- Form CLOSE -->
        {!! Form::close() !!}
    </div>
</div>

<script type="text/javascript">
    $("#pastatasss").select2();
    $("#plnrr").select2();
    $("#numeriss").select2();
    $("#busenaa").select2({
        minimumResultsForSearch: 20,
    });
    $("#tipass").select2({
        minimumResultsForSearch: 20,
    });
    theme: "bootstrap";
    allowClear: true;
</script>