<div class="modal" id="clients-modal">
    <div class="modal-body">
        <div class="modal-header">
            <h2>Crear Nuevo Cliente</h2>
        </div>
        <hr>
        <div class="modal-content">
            <form method="post">
                @csrf
                <div class="form-group">
                    <label for="">Nombre Completo</label>
                    <input type="text" name="client_full_name" id="client_full_name" class="form-control">
                    <center><span id="full_name-error"></span></center>
                </div>
                <div class="form-group">
                    <label for="">RTN</label>
                    <input type="text" name="client_rtn" id="client_rtn" class="form-control">
                    <center><span id="rtn-error"></span></center>
                </div>
                <div class="form-group">
                    <label for="">Numero Teléfono</label>
                    <input type="text" name="client_phone" id="client_phone" class="form-control">
                    <center><span id="phone-error"></span></center>
                </div>
                <div class="form-group">
                    <label for="">Correo Electrónico</label>
                    <input type="email" name="client_email" id="client_email" class="form-control">
                    <center><span id="email-error"></span></center>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="submit-button" id="submit-client-button">Guardar</button>
            <button class="cancel-button" id="cancel-button">Cancelar</button>
        </div>
    </div>
</div>
<script src="{{ asset('js/admin/clients.function.js') }}"></script>
