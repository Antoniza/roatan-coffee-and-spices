<body class="edit-body">
    <div class="header-clients">
        <a href="{{ route('dashboard-clients') }}" class="edit-link"><i class="fa-solid fa-backward-step"></i></a>
        <h1>Edición de Cliente</h1>
    </div>
    <div class="edit-panel">
        <form action="">
            @csrf
            <input type="hidden" name="" id="edit-client_id" value="{{$client->id}}">
            <div class="form-group">
                <label for="">Nombre Completo</label>
                <input type="text" name="edit-client_full_name" id="edit-client_full_name" class="form-control" value="{{$client->full_name}}">
                <center><span id="edit-full_name-error"></span></center>
            </div>
            <div class="form-group">
                <label for="">RTN</label>
                <input type="text" name="edit-client_rtn" id="edit-client_rtn" class="form-control" value="{{$client->rtn}}">
                <center><span id="edit-rtn-error"></span></center>
            </div>
            <div class="form-group">
                <label for="">Numero Teléfono</label>
                <input type="text" name="edit-client_phone" id="edit-client_phone" class="form-control" value="{{$client->phone}}">
                <center><span id="edit-phone-error"></span></center>
            </div>
            <div class="form-group">
                <label for="">Correo Electrónico</label>
                <input type="email" name="edit-client_email" id="edit-client_email" class="form-control" value="{{$client->email}}">
                <center><span id="edit-email-error"></span></center>
            </div>
        </form>
        <div class="edit-footer">
            <button class="submit-button" id="edit-client-button">Actualizar</button>
        </div>
    </div>
</body>
<script src="{{ asset('js/admin/clients.function.js') }}"></script>