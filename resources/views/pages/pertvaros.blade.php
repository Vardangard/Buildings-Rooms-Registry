@extends('layout.app')

@section('content')
<ol class="breadcrumb">     
    <li class="breadcrumb-item"><a href="https://destytojas.vdu.lt">Pagrindinis</a></li>
    <li class="breadcrumb-item"><a href="/">Pastatų ir patalpų registras</a></li>
    <li class="breadcrumb-item active">Pertvarų registras</li>
</ol>
@include('inc.messages1')
<div style="min-width: 1000px;">
    <div class="card">
        <div class="card-heading bg-dark">
            <!-- HEADING -->
            <h5 class="text-center" style="position:relative">
                @include('modals.pertvarosSearchModal')
                
                @can('create', \App\Pertvara::class)
                    <a href="/pertvaros/create" class="btn btn-light <?php echo $d = (App\Patalpa::count() < 1) ? 'disabled"' : '' ?>"  style="left:200px;position:absolute">Įvesti Pertvara</a>
                @endcan
                
                
                <!-- Title -->
                <span style="color:white">Patalpų dalių paieškos rezultatai</span>
                <!--@can('elements', \App\Pertvara::class)
                    <button formaction="/delete-all-pertvaras" type="submit"  class="btn btn-danger"  style="right:20px;position:absolute">Ištrinti Pasirinktas Patalpų Dalis</button>    
                @endcan-->
            </h5>
            <!-- END HEADING -->
        </div>
    </div>
</div>
    <!-- Card Block -->
<div class="card">
    <div class="card-block">
        <div class="table-responsive">
            @if(count($pertvaros) > 0)
            <table class="table table-bordered table-striped table-hover auto" id="pertvaros_table">
                
                <thead class="thead-dark">
                    <tr>
                        <!--@can('elements', \App\Pertvara::class)
                            <th class="text-center"><input type="checkbox" class="selectall"></th>
                        @endcan-->
                        <th>Pastatas</th>
                        <th>Aukštas</th>
                        <th>Patalpos Nr.</th>
                        <th>Tipas</th>
                        <th>Pavadinimas</th>
                        <th>Pertvaros Nr.</th>
                        <th>Talpa</th>
                        <th>Atsakingas</th>
                        <th>Telefonas</th>
                        <th>Kvadratura</th>
                        <th>Būsena</th>
                        <th>Pradžia</th>
                        <th>Pabaiga</th>
                        <th>Paskutinį kartą redaguotas</th>
                        @can('elements', \App\Pertvara::class)
                            <th>Veiksmas</th>
                        @endcan
                    </tr>
                </thead> 
                <tbody>                    
                    
                        @foreach($pertvaros as $pertvara)
                            <tr>
                                <!--@can('elements', \App\Pertvara::class)
                                    <td class="text-center"><input type="checkbox" name="ids[]" class="selectbox" value="{{ $pertvara->id }}"></td>
                                @endcan-->
                                <td style="width: 200px !important;">{{ $pertvara->patalpa->pastatas->pavadinimas ?? '-'}}</td>
                                <td>{{ $pertvara->patalpa->aukstas ?? '-'}}</td>
                                <td>{{ $pertvara->patalpa->nr ?? '-'}}</td>
                                <td style="width: 150px;">
                                    @switch($pertvara->tipas)
                                        @case('PD0201')
                                            Administracinė
                                            @break
                                        @case('PD0202')
                                            Auditorija
                                            @break
                                        @case('PD0208')
                                            Bendro Naudojimo
                                            @break
                                        @case('PD0209') 
                                            Darbininkų  
                                            @break
                                        @case('PD0210')
                                            Infrastruktūros
                                            @break
                                        @case('PD0211')
                                            Kambarys
                                            @break
                                        @case('PD0203')
                                            Kompiuterių klasė
                                            @break
                                        @case('PD0205')
                                            Konferencijų salė
                                            @break
                                        @case('PD0204')
                                            Laboratorija
                                            @break
                                        @case('PD0212')
                                            Pagalbinė
                                            @break
                                        @case('PD0206')
                                            Salė
                                            @break
                                        @case('PD0214')
                                            San. Mazgas
                                            @break
                                        @case('PD0207')
                                            Sandėlis
                                            @break
                                        @case('PD0213')
                                            Techninė
                                            @break
                                        @default
                                            -
                                    @endswitch
                                </td>
                                <td style="width: 160px;">{{ $pertvara->pavadinimas ?? '-'}}</td>
                                <td>{{ $pertvara->nr ?? '-'}}</td>
                                <td>{{ $pertvara->talpa ?? '-'}}</td>
                                <td style="width: 160px;">{{ $pertvara->atsakingas ?? '-' }}</td>
                                <td>{{ $pertvara->telefonas ?? '-' }}</td>
                                <td>{{ $pertvara->kvadratura ?? '-'}} m2</td>
                                <td style="width: 130px;">
                                    @switch($pertvara->busena)
                                        @case('PD0101')
                                            Aktyvus (-i)
                                            @break
                                        @case('PD0102')
                                            Remontuojamas (-a)
                                            @break
                                        @case('PD0103')
                                            Kraustymas
                                            @break
                                        @case('PD0104')
                                            Panaikintas (-a)
                                            @break
                                        @default
                                            -
                                    @endswitch
                                </td> 
                                <td style="width: 100px;">{{ $date = $pertvara->startdate ? \Carbon\Carbon::parse($pertvara->startdate)->format('Y-m-d') : '-' }}</td>
                                <td style="width: 100px;">{{ $date = $pertvara->enddate ? \Carbon\Carbon::parse($pertvara->enddate)->format('Y-m-d') : '-' }}</td>
                                <!--<td style="width: 130px;">{{ $pertvara->updated_at ?? '00:00:00'}}<br/>{{ !Auth::user()->permissions->where('permission_id', env("P_REGULAR"))->isEmpty() ? Auth::user()->name : "Admin" }}</td>-->
                                <td style="width: 150px;">{{ $pertvara->updated_at ?? '0000-00-00 00:00:00'}}<br/>{{ !Auth::user()->permissions->where('permission_id', env("P_REGULAR"))->isEmpty() ? Auth::user()->name : "Admin" }}</td>


                                @can('elements', \App\Pertvara::class)
                                    <!-- Form Delete -->
                                    <form method="POST">
                                        @csrf
                                        @method('DELETE')    
                                        <td style="min-width: 110px;">
                                            @can('update', $pertvara)
                                                <a class="btn" id="redaguoti" href="/pertvaros/{{ $pertvara->id }}/edit"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('delete', $pertvara)
                                                <button class="btn" onclick="return confirm('Ar tikrai norite ištrinti šią pertvarą?')" id="trinti" formaction="{{ action('PertvarosController@destroy', $pertvara->id) }}" type="submit"><i class="fa fa-trash"></i></button>
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
        $('#pertvaros_table').DataTable({
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
                { "bSortable": false, "aTargets": [ 14 ] }, 
                { "bSearchable": false, "aTargets": [ 14 ] },
                
            ],
            "order": []
        });
    });
</script>
    

    
@endsection
