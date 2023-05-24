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
            <h2>Inicio de Sesión</h2>
            <form action="{{ route('post-login') }}" method="post">
                @if (session('fail'))
                    <h4>{{session('fail')}}</h4>
                @endif
                @csrf
                <div class="form-group">
                    <label for=""><i class="fa-solid fa-user"></i><span>Correo</span></label>
                <input type="email" name="email" autofocus>
                </div>
                <div class="form-group">
                    <label for=""><i class="fa-solid fa-lock"></i><span>Contraseña</span></label>
                    <input type="password" name="password" id="password">
                </div>
                <button type="submit">Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>