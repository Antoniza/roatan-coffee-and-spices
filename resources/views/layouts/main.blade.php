<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roatán Coffee & Spices</title>

    {{-- * IMPORTING THE CSS ELEMENTS --}}
    @include('includes.stylesheets')

    {{-- * IMPORTING JQUERY LIBRARY WITH CDN AND FILE FOR ANY CASE OF INTERNET DISCONNECTION --}}
    <script src="{{asset('js/jquery/jquery-3.6.4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://rawgit.com/jeresig/jquery.hotkeys/master/jquery.hotkeys.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
</head>
<body>
    {{-- * CREATING THE MAIN COMPONENT --}}
    @auth
    <div class="menu-wrapper">
        <div class="sidebar-header">
            <div class="sideBar">
                <div>
                    <div class="sideBar-head">
                        <img src="{{asset('img/RoatancoffeeSpices.png')}}" alt="" />
                    </div>
                    <ul>
                        <li class="menu-selected"><a class="icon-menu-item" href="{{route('dashboard-start')}}"><i class="fa-solid fa-house"></i></a> <a class="menu-item" href="{{route('dashboard-start')}}">Inicio</a></li>
                        <li><a  class="icon-menu-item" href="{{route('dashboard-sales')}}"><i class="fa-solid fa-cart-shopping"></i></a> <a class="menu-item" href="{{route('dashboard-sales')}}">Ventas</a></li>
                        <li><a  class="icon-menu-item" href="{{route('dashboard-products')}}"><i class="fa-solid fa-boxes-stacked"></i></a> <a class="menu-item" href="{{route('dashboard-products')}}">Productos</a></li>
                        <li><a  class="icon-menu-item" href="{{route('dashboard-clients')}}"><i class="fa-solid fa-users"></i></a> <a class="menu-item" href="{{route('dashboard-clients')}}">Clientes</a></li>
                        <li><a  class="icon-menu-item" href="{{route('dashboard-settings')}}"><i class="fa-solid fa-gears"></i></a> <a class="menu-item" href="{{route('dashboard-settings')}}">Configuraciones</a></li>
                    </ul>
                    <span class="cross-icon"><i class="fa-solid fa-circle-xmark"></i></span>
                </div>
                <div class="logout">
                    <li><a class="logout_button" href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a> <a class="menu-item logout_button" href="/logout">Salir</a></li>
                    <div class="theme-button">
                        <span class="light-theme"><i class="fa-solid fa-sun"></i></span>
                        <span class="dark-theme hide"><i class="fa-solid fa-moon"></i></span>
                    </div>
                </div>
            </div>

            <div class="backdrop"></div>

            <div class="modals">
                @include('includes.newClient')
            </div>

            <div class="content">

                <header>
                    <div id="mobile" class="menu-button">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                    <div id="desktop" class="menu-button">
                        <i class="fa-solid fa-bars"></i>
                    </div>

                    <h1 class="title"><span>Coffee &</span> Spices</h1>

                    <div class="profile">
                        <img src="{{asset('img/profile2.jpg')}}" alt="" />
                        <span>{{Auth::user()->name}}</span>
                    </div>
                </header>
                {{-- * CREATING THE SPACE WHERE MAIN CONTENT WILL BE --}}
                <div class="data-container">
                    @yield('content')
                </div>
            </div>
        </div>
        
    </div>
@endauth
</body>

{{-- * IMPORTING THE JS ELEMENTS --}}
@include('includes.javascript')

{{-- * CREATING THE SPACE WHERE SOME JS CONTENT WILL BE --}}
@yield('javascript')

</html>
