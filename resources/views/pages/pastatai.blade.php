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
            @include('modals.pastataiAddNewModal')
            @include('modals.pastataiSearchModal')
            <!-- Form Delete -->
            <form method="POST">
                @csrf
                @method('DELETE')    

            <!-- Title -->
            <span style="color:white">Pastatų paieškos rezultatai</span>
            
            <button formaction="/delete-all" type="submit"  class="btn btn-danger"  style="right:20px;position:absolute">Ištrinti Pasirinktus Pastatus</button>    
        </h5>
         <!-- END HEADING -->
    </div>
</div>
<div class="card">   
    <!-- Card Block -->
    <div class="card-block">
        <div class="table-responsive">
            <table class="table table-bordered table-hover auto">
                @if(count($pastatai) >= 1)
                <thead class="thead-dark">
                    <tr>
                        <th><input type="checkbox" class="selectall"></th>
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
                        <th>Veiksmas</th>
                    </tr>
                </thead> 
                <tbody>
                    
                        @foreach($pastatai as $pastatas)
                            <tr>
                                <td><input type="checkbox" name="ids[]" class="selectbox" value="{{ $pastatas->id }}"></td>
                                <td>{{ $pastatas->kodas }}</td>
                                <td>{{ $pastatas->pavadinimas }}</td>
                                <td>{{ $pastatas->adresas }}</td>
                                <td>{{ $pastatas->aukstai }}</td>
                                <td>{{ $pastatas->kadastronr }}</td>
                                <td style="width: 300px;">{{ $pastatas->padaliniai }}</td>
                                <td>{{ $pastatas->startdate }}</td>
                                <td>{{ $pastatas->enddate ?? '-' }}</td>
                                <td>{{ $pastatas->busena }}</td> 
                                <td>{{ $pastatas->miestas }}</td>
                                <td style="width: 250px;">
                                    Darbo diena: {{ $pastatas->darbo_laikas_p_s }} - {{ $pastatas->darbo_laikas_p_e }}<br/>
                                    Seštadienis: {{ $pastatas->darbo_laikas_ses_s }} - {{ $pastatas->darbo_laikas_ses_e }}<br/>
                                    Sekmadienis: {{ $pastatas->darbo_laikas_sek_s }} - {{ $pastatas->darbo_laikas_sek_e }}
                                </td>
                                <td style="width: 110px;">	
                                    <a class="btn" id="redaguoti" href="/pastatai/{{ $pastatas->id }}/edit"><i class="fa fa-edit"></i></a>
                                    <button class="btn" id="trinti" formaction="{{ action('PastataiController@destroy', $pastatas->id) }}" type="submit"><i class="fa fa-trash"></i></button>
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
<div class="text-right">
    {{ $pastatai->links() }}
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
