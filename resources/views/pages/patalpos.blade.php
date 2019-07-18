@extends('layout.app')

@section('content')
<ol class="breadcrumb">     
    <li class="breadcrumb-item"><a href="https://destytojas.vdu.lt">Pagrindinis</a></li>
    <li class="breadcrumb-item"><a href="/">Pastatų ir patalpų registras</a></li>
    <li class="breadcrumb-item active">Patalpų registras</li>
</ol>
@include('inc.messages1')

<div class="card">
    <div class="card-heading bg-dark">
        <!-- HEADING -->
        <h5 class="text-center" style="position:relative">
            @can('create', \App\Patalpa::class)
                @include('modals.patalposAddNewModal')
            @endcan
              

            <!-- Title -->
            <span style="color:white">Patalpų paieškos rezultatai</span>
        </h5>
         <!-- END HEADING -->
    </div>
</div>
<div class="card">
    <!-- Card Block -->
    <div class="card-block">
        <div class="table-responsive">
            @if(count($patalpos) > 0)
            <table class="table table-bordered table-hover auto" id="patalpos_table">
                <thead class="thead-dark">
                    <tr>
                        <!--@can('elements', \App\Patalpa::class)
                            <th class="text-center"><input type="checkbox" class="selectall"></th>
                        @endcan-->
                        <th>Pastatas</th>
                        <th>Aukštas</th>
                        <th>Patalpos Nr.</th>
                        <th>Pertvaros</th>
                        <th>Paskutinį kartą redaguotas</th>
                        @can('elements', \App\Patalpa::class)
                            <th>Veiksmas</th>
                        @endcan
                    </tr>
                </thead> 
                <tbody>                    
                    
                        @foreach($patalpos as $patalpa)
                            <tr>
                                <!--@can('elements', \App\Patalpa::class)
                                    <td style="width: 12px;" class="text-center"><input type="checkbox" name="ids[]" class="selectbox" value="{{ $patalpa->id }}">{{$patalpa->id}}</td>
                                @endcan-->
                                <td>{{ $patalpa->pastatas->pavadinimas }}</td>
                                <td>{{ $patalpa->aukstas }}</td>
                                <td>{{ $patalpa->nr }}</td>
                                <td>@if($patalpa->pertvaros < 1)
                                        Nėra įrašytų pertvarų
                                    @elseif($patalpa->pertvaros > 0)
                                        {{ $patalpa->pertvaros }}
                                    @endif
                                </td>
                                <td>{{ $patalpa->updated_at }}</td> 
    
                                @can('elements', \App\Patalpa::class)
                                    <!-- Form Delete -->
                                        <form method="POST">
                                            @csrf
                                            @method('DELETE')  
                                    <td style="width: 110px;">
                                        @can('update', $patalpa)
                                            <a class="btn" id="redaguoti" href="/patalpos/{{ $patalpa->id }}/edit"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        
                                        @can('delete', $patalpa)
                                            <button class="btn" onclick="return confirm('Ar tikrai norite ištrinti šią patalpą?')" id="trinti" formaction="{{ action('PatalposController@destroy', $patalpa->id) }}" type="submit"><i class="fa fa-trash"></i></button>
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
    })
</script>-->

<script>
    $(document).ready( function () {
        $.fn.dataTable.ext.classes.sPageButton = 'btn btn-light';
        $('#patalpos_table').DataTable({
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
                { "bSortable": false, "aTargets": [ 5 ] }, 
                { "bSearchable": false, "aTargets": [ 5 ] },
                
            ],
            "order": []
        });
    });
</script>

    
@endsection
