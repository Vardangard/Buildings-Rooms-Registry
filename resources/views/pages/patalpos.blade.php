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
            @include('modals.patalposSearchModal')

            <!-- Form Delete -->
            <form method="POST">
                @csrf
                @method('DELETE')    

            <!-- Title -->
            <span style="color:white">Patalpų paieškos rezultatai</span>
            @can('create', \App\Patalpa::class)
                <button formaction="/delete-all-patalpas" type="submit"  class="btn btn-danger"  style="right:20px;position:absolute">Ištrinti Pasirinktas Patalpas</button>    
            @endcan
        </h5>
         <!-- END HEADING -->
    </div>
</div>
<div class="card">
    <!-- Card Block -->
    <div class="card-block">
        <div class="table-responsive">
            @if(count($patalpos) > 0)
            <table class="table table-bordered table-hover auto">
                <thead class="thead-dark">
                    <tr>
                        @can('elements', \App\Patalpa::class)
                            <th><input type="checkbox" class="selectall"></th>
                        @endcan
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
                                @can('elements', \App\Patalpa::class)
                                    <td style="width: 12px;"><input type="checkbox" name="ids[]" class="selectbox" value="{{ $patalpa->id }}"></td>
                                @endcan
                                <td>{{ $patalpa->pastatas->pavadinimas }}</td>
                                <td>{{ $patalpa->aukstas }}</td>
                                <td>{{ $patalpa->nr }}</td>
                                <td>@if($patalpa->pertvaros < 1)
                                        Nėra įrašytų pertvarų
                                    @elseif($patalpa->pertvaros > 0)
                                        {{ $patalpa->pertvaros }}
                                    @endif
                                </td>
                                <td>{{ $patalpa->updated_at }}</td> <!--App\Pertvara::where('patalpos_id', 'like', $patalpa->id)->count()-->

                                @can('elements', \App\Patalpa::class)
                                    <td style="width: 110px;">
                                        @can('update', $patalpa)
                                            <a class="btn" id="redaguoti" href="/patalpos/{{ $patalpa->id }}/edit"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('delete', $patalpa)
                                            <button class="btn" id="trinti" formaction="{{ action('PatalposController@destroy', $patalpa->id) }}" type="submit"><i class="fa fa-trash"></i></button>
                                        @endcan
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                </tbody>
                @else
                    <p class="alert alert-danger" style="border-radius:0px; margin-bottom:0px">Duomenų Nėra</p>
                @endif
            </table>
            <br/>
            <div>  <!--class="d-flex justify-content-center"-->
                {{ $patalpos->links() }}
            </div>
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
