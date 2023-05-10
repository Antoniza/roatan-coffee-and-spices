<div class="modal-shadow"></div>
<div class="modal" id="clients-modal">
    <div class="modal-body">
        <div class="modal-header">
            <h2>Crear nuevo Cliente</h2>
        </div>
        <hr>
        <div class="modal-content">
            <form method="post">
                @csrf
                <div class="form-group">
                    <label for="">Nombre Completo</label>
                    <input type="text" name="client_full_name" id="client_full_name" class="form-control">
                    @error('full_name')
                        <center>
                            <h5 class="alert-fail">{{ $message }}</h5>
                        </center>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Identidad</label>
                    <input type="text" name="client_dni" id="client_dni" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Numero Telefono</label>
                    <input type="text" name="client_phone" id="client_phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Correo Electrónico</label>
                    <input type="text" name="client_email" id="client_email" class="form-control">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="submit-button" id="submit-button">Guardar</button>
            <button class="cancel-button" id="cancel-button">Cancelar</button>
        </div>
    </div>
    <div class="form-alert">
        <h4 id="form-alert-message">---</h4>
    </div>
</div>