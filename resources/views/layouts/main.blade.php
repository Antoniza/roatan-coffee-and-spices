<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Roatán Coffee & Spices</title>

    {{-- * IMPORTING THE CSS ELEMENTS --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @include('includes.stylesheets')

    {{-- * IMPORTING JQUERY LIBRARY WITH CDN AND FILE FOR ANY CASE OF INTERNET DISCONNECTION --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://rawgit.com/jeresig/jquery.hotkeys/master/jquery.hotkeys.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    {{-- * CREATING THE MAIN COMPONENT --}}
    @auth
        <div class="menu-wrapper">
            <div class="sidebar-header">
                <div class="sideBar">
                    <div>
                        <div class="sideBar-head">
                            <img src="{{ asset('img/RoatancoffeeSpices.png') }}" alt="" />
                        </div>
                        <ul>
                            <li class="menu-selected"><a class="icon-menu-item" href="{{ route('dashboard-start') }}"><i
                                        class="fa-solid fa-house"></i></a> <a class="menu-item"
                                    href="{{ route('dashboard-start') }}">Inicio</a></li>
                            <li><a class="icon-menu-item" href="{{ route('dashboard-sales') }}"><i
                                        class="fa-solid fa-cart-shopping"></i></a> <a class="menu-item"
                                    href="{{ route('dashboard-sales') }}">Ventas</a></li>
                            <li><a class="icon-menu-item" href="{{ route('dashboard-products') }}"><i
                                        class="fa-solid fa-boxes-stacked"></i></a> <a class="menu-item"
                                    href="{{ route('dashboard-products') }}">Productos</a></li>
                            <li><a class="icon-menu-item" href="{{ route('dashboard-clients') }}"><i
                                        class="fa-solid fa-users"></i></a> <a class="menu-item"
                                    href="{{ route('dashboard-clients') }}">Clientes</a></li>
                            <li><a class="icon-menu-item" href="{{ route('dashboard-settings') }}"><i
                                        class="fa-solid fa-gears"></i></a> <a class="menu-item"
                                    href="{{ route('dashboard-settings') }}">Configuraciones</a></li>
                        </ul>
                        <span class="cross-icon"><i class="fa-solid fa-circle-xmark"></i></span>
                    </div>
                    <div class="logout">
                        <li><a class="logout_button" href="/logout"><i class="fa-solid fa-right-from-bracket"></i></a> <a
                                class="menu-item logout_button" href="/logout">Salir</a></li>
                        <div class="theme-button">
                            <span class="light-theme"><i class="fa-solid fa-sun"></i></span>
                            <span class="dark-theme hide"><i class="fa-solid fa-moon"></i></span>
                        </div>
                    </div>
                </div>

                <div class="backdrop"></div>

                <div class="loading">
                    <div class="lds-dual-ring"></div>
                </div>

                <div class="modals">
                    <div class="modal-shadow"></div>
                    @include('includes.admin.newClient')
                    @include('includes.admin.newProduct')
                </div>

                <div class="content">

                    <header>
                        <div id="mobile" class="menu-button">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                        <div id="desktop" class="menu-button">
                            <i class="fa-solid fa-bars"></i>
                        </div>

                        <h1 class="title">Roatán <span>Coffee &</span> Spices</h1>

                        <div class="profile">
                            <img src="{{ asset('img/profile2.jpg') }}" alt="" />
                            <span>{{ Auth::user()->name }}</span>
                            <input type="hidden" name="" id="user_id" value="{{ Auth::user()->id }}">
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
