@extends('layout.app')

@section('content')
<ol class="breadcrumb">     
    <li class="breadcrumb-item"><a href="https://destytojas.vdu.lt">Pagrindinis</a></li>
    <li class="breadcrumb-item"><a href="/">Pastatų ir patalpų registras</a></li>
    <li class="breadcrumb-item active">Pastatų registras</li>
</ol>
@include('inc.messages')

<div class="card">
    <div class="card-heading bg-dark">
        <!-- HEADING -->
        <h5 class="text-center" style="position:relative">
            @can('create', \App\Pastatas::class)
                @include('modals.pastataiAddNewModal')
            @endcan

            <!-- Title -->
            <span style="color:white">Pastatų paieškos rezultatai</span>
             
            <!--@can('create', \App\Pastatas::class)           
                <button formaction="/delete-all" type="submit"  class="btn btn-danger"  style="right:20px;position:absolute">Ištrinti Pasirinktus Pastatus</button>   
            @endcan-->
        </h5>
         <!-- END HEADING -->
    </div>
</div>
<div class="card">   
    <!-- Card Block -->
    <div class="card-block">
        <div class="table-responsive">
            @if(count($pastatai) >= 1)
            <table class="table table-bordered table-hover auto" id="pastatai_table">
                
                <thead class="thead-dark">
                    <tr>
                        <!--@can('elements', \App\Pastatas::class)
                            <th class="text-center"><input type="checkbox" class="selectall"></th>
                        @endcan--> 
                        <th>Kodas</th>
                        <th>Pavadinimas</th>
                        <th>Adresas</th>
                        <th>Aukštai</th>
                        <th>Kadastro Nr.</th>
                        <th>Padaliniai</th>
                        <th>Pradžia</th>
                        <th>Pabaiga</th>
                        <th>Būsena</th>
                        <th>Miestas</th>
                        <th>Darbo laikas</th>
                        @can('elements', \App\Pastatas::class)
                            <th>Veiksmas</th>
                        @endcan
                    </tr>
                </thead> 
                <tbody>
                    
                        @foreach($pastatai as $pastatas)
                            <tr>
                                <!--@can('elements', \App\Pastatas::class)
                                    <td style="width: 12px;" class="text-center"><input type="checkbox" name="ids[]" class="selectbox" value="{{ $pastatas->id }}"></td>
                                @endcan-->
                                <td>{{ $pastatas->kodas }}</td>
                                <td style="width: 300px;">{{ $pastatas->pavadinimas }}</td>
                                <td>{{ $pastatas->adresas }}</td>
                                <td>{{ $pastatas->aukstai }}</td>
                                <td>{{ $pastatas->kadastronr }}</td>
                                <td style="width: 300px;">{{ $pastatas->padaliniai }}</td>
                                <td>{{ \Carbon\Carbon::parse($pastatas->startdate)->format('Y-m-d') }}</td>
                                <td>{{ $date = $pastatas->enddate ? \Carbon\Carbon::parse($pastatas->enddate)->format('Y-m-d') : '-' }}</td>
                                <td>{{ $pastatas->busena }}</td> 
                                <td>{{ $pastatas->miestas }}</td>
                                <td style="width: 250px;">
                                    Darbo diena: {{ $pastatas->darbo_laikas_p_s }} - {{ $pastatas->darbo_laikas_p_e }}<br/>
                                    Šeštadienis: {{ $pastatas->darbo_laikas_ses_s }} - {{ $pastatas->darbo_laikas_ses_e }}<br/>
                                    Sekmadienis: {{ $pastatas->darbo_laikas_sek_s }} - {{ $pastatas->darbo_laikas_sek_e }}
                                </td>

                                @can('elements', \App\Pastatas::class)
                                    <!-- Form Delete -->
                                    <form method="POST">
                                            @csrf
                                            @method('DELETE') 
                                        <td style="width: 110px;">	
                                            @can('update', $pastatas)
                                                <a class="btn" id="redaguoti" href="/pastatai/{{ $pastatas->id }}/edit"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('delete', $pastatas)
                                                <button class="btn" onclick="return confirm('Ar tikrai norite ištrinti šį pastatą?')"  id="trinti" formaction="{{ action('PastataiController@destroy', $pastatas->id) }}" type="submit"><i class="fa fa-trash"></i></button>
                                            @endcan
                                        </td>
                                    </form>
                                @endcan

                            </tr>
                        @endforeach
                    
                </tbody>
               
            </table> 
            @else
                <p class="alert alert-danger" style="border-radius:0px; margin-bottom:0px">Įrašų nerasta!</p>
            @endif
        </div>
    </div>
</div>


<!-- SCRIPTS -->

<!-- CHECKBOX SELECT
<script type="text/javascript">
    $('.selectall').click( function () {
        $('.selectbox').prop('checked', $(this).prop('checked'));
        $('.selectall2').prop('checked', $(this).prop('checked'));
    })
    $('.selectall2').click( function () {
        $('.selectbox').prop('checked', $(this).prop('checked'));
        $('.selectall').prop('checked', $(this).prop('checked'));
    })
    $('.selectbox').change( function () {
        var total = $('.selectbox').length;
        var number = $('.selectbox:checked').length;
        if(total == number) {
            $('.selectall').prop('checked', true);
            $('.selectall2').prop('checked', true);
        } else {
            $('.selectall').prop('checked', false);
            $('.selectall2').prop('checked', false);
        }
    });
</script>-->

<script>
    $(document).ready( function () {
        $.fn.dataTable.ext.classes.sPageButton = 'btn btn-light';
        $('#pastatai_table').DataTable({
            "language": {
                "sEmptyTable":      "Lentelėje nėra duomenų",
                "sInfo":            "Rodomi įrašai nuo _START_ iki _END_ iš _TOTAL_ įrašų",
                "sInfoEmpty":       "Rodomi įrašai nuo 0 iki 0 iš 0",
                "sInfoFiltered":    "(atrinkta iš _MAX_ įrašų)",
                "sInfoPostFix":     "",
                "sInfoThousands":   " ",
                "sLengthMenu":      "Rodyti _MENU_ įrašus",
                "sLoadingRecords":  "Įkeliama...",
                "sProcessing":      "Apdorojama...",
                "sSearch":          "Ieškoti:",
                "searchPlaceholder": "Ieškoti",
                "sThousands":       " ",
                "sUrl":             "",
                "sZeroRecords":     "<span style=\"padding: 20px; margin: 0px; font-size: 20px; \">Įrašų nerasta</span>",
            
                "oPaginate": {
                    "sFirst": "Pirmas",
                    "sPrevious": "Ankstesnis",
                    "sNext": "Tolimesnis",
                    "sLast": "Paskutinis"
                }
            },
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [ 11 ] }, 
                { "bSearchable": false, "aTargets": [ 11 ] },
            ],
            "order": []
        });
    });
</script>
    


    
@endsection
