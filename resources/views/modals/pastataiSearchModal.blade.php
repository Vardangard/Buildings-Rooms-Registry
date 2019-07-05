<!-- Paieska/filtravimas -->
<button class="btn btn-light" <?php echo $d = (App\Pastatas::count() < 1) ? 'disabled="disabled"' : '' ?> style="left:20px;position:absolute" data-toggle="modal" data-target="#searchModal">Paieška/Filtravimas</button>
<!-- Search Modal -->
<div class="modal fade" id="searchModal" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <!-- Form OPEN -->
        {!! Form::open(['action' => 'PastataiController@search', 'method' => 'GET']) !!}

        <div class="modal-content">
            <div class="modal-header bg-dark" style="color:white">
                <h5 class="modal-title" id="searchModalLabel">Pastatų paieška</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @include('inc.messages')
                <div>
                    <div class="container form-group">
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('kadastronr', 'Kadastrinis Nr.') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                <!--{{ Form::search('kadastronr', '', ['id' => 'kadastrass', 'class' => 'form-control', 'placeholder' => 'Kadastrinis Nr.', 'style' => 'margin-bottom: 2px']) }} <br/>-->
                                {{Form::select('kadastronr', $kadastrai, null,
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => '-Kadastrinis Nr-',
                                        'style' => 'margin-bottom: 2px; width: 278px',
                                        'id' => 'kadastrass'
                                    ])
                                }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('kodas', 'Kodas') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                <!--{{ Form::search('kodas', '', ['id' => 'kodass', 'class' => 'form-control', 'placeholder' => 'Kodas', 'style' => 'margin-bottom: 2px']) }}<br/>-->
                                {{Form::select('kodas', $kodai, null,
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => '-Kodas-',
                                        'style' => 'margin-bottom: 2px; width: 278px',
                                        'id' => 'kodass'
                                    ])
                                }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('pavadinimas', 'Pavadinimas') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                <!--{{ Form::search('pavadinimas', '', ['id' => 'pavadinimass', 'class' => 'form-control', 'placeholder' => 'Pavadinimas', 'style' => 'margin-bottom: 2px']) }}<br/>-->
                                {{Form::select('pavadinimas', $pavadinimai, null,
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => '-Pavadinimas-',
                                        'style' => 'margin-bottom: 2px; width: 278px',
                                        'id' => 'pavadinimass'
                                    ])
                                }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('adresas', 'Adresas') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                <!--{{ Form::search('adresas', '', ['id' => 'adresass', 'class' => 'form-control', 'placeholder' => 'Adresas', 'style' => 'margin-bottom: 2px']) }}<br/>-->
                                {{Form::select('adresas', $adresai, null,
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => '-Adresas-',
                                        'style' => 'margin-bottom: 2px; width: 278px',
                                        'id' => 'adresass'
                                    ])
                                }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('aukstai', 'Aukštai') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::number('aukstai', '', ['min'=>1,'max'=>16, 'class' => 'form-control', 'style' => 'width:50%;']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('busena', 'Būsena') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{Form::select('busena', ['Aktyvus (-i)' => 'Aktyvus (-i)', 'Remontuojamas (-a)' => 'Remontuojamas (-a)', 'Kraustymas' => 'Kraustymas', 'Panaikintas (-a)' => 'Panaikintas (-a)'], null,
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => '-Būsena-',
                                        'style' => 'margin-bottom: 2px; width: 278px',
                                        'id' => 'busenaaa'
                                    ])
                                }}<br/>
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
    $("#kadastrass").select2();
    $("#kodass").select2();
    $("#pavadinimass").select2();
    $("#adresass").select2();
    $("#busenaaa").select2({
        minimumResultsForSearch: 20,
    });
    allowClear: true;
</script>