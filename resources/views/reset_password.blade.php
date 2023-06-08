<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roatán Coffee & Spices</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="left-content">
            <img src="{{asset('img/RoatancoffeeSpices.png')}}" alt="">
        </div>
        <div class="right-content">
            <h2>Cambiar Contraseña</h2>
            <form action="{{ route('reset-password-post') }}" method="POST">
                <img src="{{ asset('images/logo_roatan.png') }}" alt="">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <input type="text" id="email_address" name="email" required autofocus placeholder="Correo Electrónico">
                @if ($errors->has('email'))
                    <span>{{ $errors->first('email') }}</span>
                @endif

                <input type="password" id="password" name="password" required autofocus placeholder="Nueva Contraseña">
                @if ($errors->has('password'))
                    <span>{{ $errors->first('password') }}</span>
                @endif

                <input type="password" id="password-confirm" name="password_confirmation" required
                    autofocus placeholder="Confirme contraseña">
                @if ($errors->has('password_confirmation'))
                    <span>{{ $errors->first('password_confirmation') }}</span>
                @endif

                <button type="submit">Cambiar contraseña</button>
                <a href="{{route('login')}}">Ir a inicio de sesión</a>
            </form>
        </div>
    </div>
</body>
</html>