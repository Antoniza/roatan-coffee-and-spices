<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 id="message"></h1>
    <form method="post" id="form">
        @csrf
        <input type="text" id="name" placeholder="Client's Name">
        <input type="email" id="email" id="" placeholder="Client's Email">
        <input type="text" id="phone" placeholder="Client's Phone">
        <input type="password" name="password" id="password">

        <button id="saveButton">Save Data</button>
    </form>

    <h2>Usuario Agregado</h2>
    <ol id="names">
    </ol>
    <br>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{asset('js/register.function.js')}}"></script>
</html>