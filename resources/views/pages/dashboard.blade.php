@extends('layout.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mb-2" id="menu">
            <div class="card-body">
                <h4 class="card-title">Pastatų-Patalpų registras (PPRIS)</h4>
                <p class="card-text">Visų pastatų, patalpų ir pertvarų tvarkymas, peržiūra ir paieška.</p>
                <a class="card-link" href="/pastatai">Pastatų administravimas</a>
                <a class="card-link" href="/patalpos">Patalpų administravimas</a>
                <a class="card-link" href="/pertvaros">Pertvarų administravimas</a>
                <a class="card-link" href="/vartotojai">Vartotojai</a>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-top:200px;">
    <div class="col-md-12 d-flex justify-content-center">
        @include('inc.wellcome')
    </div>
</div>

@endsection
