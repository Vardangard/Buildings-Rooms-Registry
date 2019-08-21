<!-- Ivesti nauja pastata -->
<button class="btn btn-light" <?php echo $d = (App\Pastatas::count() < 1) ? 'disabled="disabled"' : '' ?> style="left:20px;position:absolute" data-toggle="modal" data-target="#addNewPatalpaModal">Įvesti naują patalpą</button>
<!-- Add New Modal -->
<div class="modal fade" id="addNewPatalpaModal" role="dialog" aria-labelledby="addNewPatalpaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        
        <!-- Form OPEN -->
        {!! Form::open(['action' => 'PatalposController@store', 'method' => 'POST']) !!}

        <div class="modal-content">
            <div class="modal-header bg-dark" style="color:white" style="color:white">
                <h5 class="modal-title" id="addNewPatalpaModalLabel">Įveskite naują patalpą</h5>
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
                                {{ Form::number('aukstas', '1', ['min'=>0,'max'=>16, 'class' => 'form-control', 'placeholder' => 'Aukštas', 'style' => 'width:50%;']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('nr', 'Patalpos numeris') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::text('nr', '', ['class' => 'form-control', 'placeholder' => 'Patalpos Nr', 'style' => 'margin-bottom: 2px']) }}<br/>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 150px;">
                            <div class="col-md-6 text-right">
                                {{ Form::label('pertvaros', 'Patalpos dalių sk') }}<br/>
                            </div>
                            <div class="col-md-6 text-left">
                                {{ Form::number('pertvaros', '1',  ['min'=>0,'max'=>16, 'class' => 'form-control', 'placeholder' => 'Patalpos dalių skaičius', 'style' => 'width:50%;']) }}<br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Uždaryti</button>
                {{ Form::submit('Toliau', ['class' => 'btn btn-secondary']) }}
            </div>
        </div> 
        <!-- Form CLOSE -->
        {!! Form::close() !!}
    </div>
</div>

<script type="text/javascript">
    $("#pastatass").select2();
    allowClear: true;
</script>