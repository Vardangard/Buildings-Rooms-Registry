<!-- Paieska/filtravimas -->
<button class="btn btn-light" style="left:20px;position:absolute" data-toggle="modal" data-target="#patalposSearchModal">Paieška/Filtravimas</button>
<!-- Search Modal -->
<div class="modal fade" id="patalposSearchModal" role="dialog" aria-labelledby="patalposSearchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <!-- Form OPEN -->
        {!! Form::open(['action' => 'PatalposController@search', 'method' => 'GET']) !!}

        <div class="modal-content">
            <div class="modal-header bg-dark" style="color:white">
                <h5 class="modal-title" id="patalposSearchModalLabel">Patalpų paieška</h5>
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
                                {{ Form::label('pastatai_id', 'Pastato kodas') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                            {{Form::select('pastatai_id', $pastatai, null,
                                [
                                'class' => 'form-control',
                                'placeholder' => '-Pastato kodas-',
                                'style' => 'margin-bottom: 2px; width: 278px',
                                'id' => 'pastatass'
                                ])
                            }}<br/>
                            </div> 
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('aukstas', 'Patalpos aukštas') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::number('aukstas', '', ['min'=>1,'max'=>16, 'class' => 'form-control', 'placeholder' => 'Aukštas', 'style' => 'width:50%;']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('nr', 'Patalpos numeris') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{Form::select('nr', $nr, null,
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => '-Visi-',
                                        'style' => 'margin-bottom: 2px; width: 278px',
                                        'id' => 'nrr'
                                    ])
                                }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('pertvaros', 'Patalpos dalių sk') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::number('pertvaros', '',  ['min'=>1,'max'=>16, 'class' => 'form-control', 'placeholder' => 'Kiekis', 'style' => 'width:50%;']) }}<br/>
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
    $("#pastatass").select2();
    $("#nrr").select2();
    allowClear: true;
</script>