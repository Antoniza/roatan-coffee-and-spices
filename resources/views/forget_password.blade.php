<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roatán Coffee & Spices</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="left-content">
            <img src="{{ asset('img/RoatancoffeeSpices.png') }}" alt="">
        </div>
        <div class="right-content">
            <h2>Recuperación de Contraseña</h2>
            <form action="{{ route('forget-password-post') }}" method="post">
                @if (session('success'))
                    <div class="success_alert">{{ session('success') }}</div>
                @endif
                @csrf
                <div class="form-group">
                    <label for=""><i class="fa-solid fa-user"></i><span>Correo</span></label>
                    <input type="email" name="email" autofocus>
                </div>
                <button type="submit">Enviar Correo</button>
                <a href="{{ route('login') }}">Ir a inicio de sesión</a>
            </form>
        </div>
    </div>
</body>

</html>
