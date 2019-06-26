<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/"><img src="{{ asset('img/vdu_logo_white_135.png') }}"/></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        <li class="nav-item {{ Request::is('/') ? 'active' : null }}">
            <a class="nav-link" href="/">Meniu</a>
        </li>
        <li class="nav-item {{ Request::is('pastatai') ? 'active' : null }}">
            <a class="nav-link" href="/pastatai">Pastatų registras<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item {{ Request::is('pertvaros') ? 'active' : null }}">
            <a class="nav-link" href="/pertvaros">Pertvarų registras<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item {{ Request::is('patalpos') ? 'active' : null }}">
            <a class="nav-link" href="/patalpos">Patalpų registras<span class="sr-only">(current)</span></a>
        </li>
        </ul>
    </div>
</nav>