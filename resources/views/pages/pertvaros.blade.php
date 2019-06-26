@extends('layout.app')

@section('content')
<ol class="breadcrumb">     
    <li class="breadcrumb-item"><a href="https://destytojas.vdu.lt">Pagrindinis</a></li>
    <li class="breadcrumb-item"><a href="/">Pastatų ir patalpų registras</a></li>
    <li class="breadcrumb-item active">Pertvarų registras</li>
</ol>
@include('inc.messages1')

<div class="card">
    <div class="card-heading bg-dark">
        <!-- HEADING -->
        <h5 class="text-center" style="position:relative">
            @include('modals.patalposAddNewModal')

            <a href="/pertvaros/create" class="btn btn-light" style="left:200px;position:absolute">Įvesti Pertvara</a>

            @include('modals.pertvarosSearchModal')
            <!-- Form Delete -->
            <form method="POST">
                @csrf
                @method('DELETE')    

            <!-- Title -->
            <span style="color:white">Patalpų dalių paieškos rezultatai</span>
            
            <button formaction="/delete-all-pertvaras" type="submit"  class="btn btn-danger"  style="right:20px;position:absolute">Ištrinti Pasirinktas Patalpų Dalis</button>    
        </h5>
         <!-- END HEADING -->
    </div>
</div>
    <!-- Card Block -->
<div class="card">
    <div class="card-block">
        <div class="table-responsive">
            <table class="table table-bordered table-hover auto">
                @if(count($pertvaros) > 0)
                <thead class="thead-dark">
                    <tr>
                        <th><input type="checkbox" class="selectall"></th>
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
                        <th>Veiksmas</th>
                    </tr>
                </thead> 
                <tbody>                    
                    
                        @foreach($pertvaros as $pertvara)
                            <tr>
                                <td><input type="checkbox" name="ids[]" class="selectbox" value="{{ $pertvara->id }}"></td>
                                <td>{{ $pertvara->patalpa->pastatas->pavadinimas }}</td>
                                <td>{{ $pertvara->patalpa->aukstas }}</td>
                                <td>{{ $pertvara->patalpa->nr }}</td>
                                <td>{{ $pertvara->tipas }}</td>
                                <td>{{ $pertvara->pavadinimas }}</td>
                                <td>{{ $pertvara->nr }}</td>
                                <td>{{ $pertvara->talpa }}</td>
                                <td>{{ $pertvara->atsakingas ?? '-' }}</td>
                                <td>{{ $pertvara->telefonas ?? '-' }}</td>
                                <td>{{ $pertvara->kvadratura }} m2</td>
                                <td>{{ $pertvara->busena }}</td>
                                <td>{{ $pertvara->startdate }}</td>
                                <td>{{ $pertvara->enddate ?? '-' }}</td>
                                <td>{{ $pertvara->updated_at }}</td>

                                <td>
                                    <a class="btn" id="redaguoti" href="/pertvaros/{{ $pertvara->id }}/edit"><i class="fa fa-edit"></i></a>
                                    <button class="btn" id="trinti" formaction="{{ action('PertvarosController@destroy', $pertvara->id) }}" type="submit"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                   
                </tbody>
                @else
                    <p class="alert alert-danger" style="border-radius:0px; margin-bottom:0px">Duomenų Nėra</p>
                @endif
            </table>
        </div>
    </div>
</div>

</form>

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
</script>

    
@endsection
