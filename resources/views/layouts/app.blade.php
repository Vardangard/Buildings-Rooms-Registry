<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Projektai</title>

    <link href="https://resources.vdu.lt/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://resources.vdu.lt/css/unified-login/style.css" rel="stylesheet">
</head>
<body>

<div class="container h-100">
    @if ($errors->any())
        <div class="alert alert-danger"><strong>@lang('base.klaida')!</strong> {{ $errors->first() }}</div>
    @endif
    <div>
        @if(session('success'))
        <div class="alert alert-success text-center" style="display:inline-block">
            {{ session('success') }}
        </div>
        @endif
        @if(session('danger'))
            <div class="alert alert-danger text-center" style="display:inline-block">
                {{ session('danger') }}
            </div>
        @endif
    </div>
    <div class="h-100 row align-items-md-center justify-content-md-center">
        <div class="col-sm-12 col-md-9 col-login">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="title">Projektai</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-logo">
                    <a href="{{ url('/') }}" class="logo"><img src="https://resources.vdu.lt/images/vdu_logo_cherry_500.png" alt=""></a>
                </div>
                <div class="col-md-5">
                    <form class="form-signin" method="post" action="{{ route('login') }}">
                        <label for="inputUsername" class="sr-only">Naudotojo vardas</label>
                        <input name="username" id="inputUsername" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="Naudotojo vardas" required autofocus>
                        <label for="inputPassword" class="sr-only">Slaptažodis</label>
                        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Slaptažodis" required>
                        <button class="btn btn-lg btn-dark btn-block" type="submit">Prisijungti</button>
                        <p class="text-right"><small class="form-text text-muted">Negalite prisijungti <a href="https://pagalba.vdu.lt/">Pagalba</a>!</small></p>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>