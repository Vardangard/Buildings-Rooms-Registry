<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="padding-top:0px; padding-bottom: 0px;">
    <a class="navbar-brand" href="/"><img src="{{ asset('img/vdu_logo_white_135.png') }}"/></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        <li class="nav-item {{ Request::is('pastatai') ? 'active' : null }}">
            <a class="nav-link" href="/pastatai">Pastatų registras<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item {{ Request::is('patalpos') ? 'active' : null }}">
            <a class="nav-link" href="/patalpos">Patalpų registras<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item {{ Request::is('pertvaros') ? 'active' : null }}">
            <a class="nav-link" href="/pertvaros">Pertvarų registras<span class="sr-only">(current)</span></a>
        </li>
        @can('view', App\User::class)
            <li class="nav-item {{ Request::is('vartotojai') ? 'active' : null }}">
                <a class="nav-link" href="/vartotojai">Vartotojai<span class="sr-only">(current)</span></a>
            </li>
        @endcan
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <!--<li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>-->
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out" id="ex"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                
            @endguest
        </ul>
    </div>
</nav>