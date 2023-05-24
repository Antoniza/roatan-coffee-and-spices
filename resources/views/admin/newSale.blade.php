<body>
    <div class="form-client">
        <div class="header-clients">
            <h1>RTN</h1>
            <a id="newClientButton"><button> <span><i class="fa-solid fa-user-plus"></i></span> Nuevo Cliente</button></a>
        </div>
        <br>
        <input type="hidden" name="" id="client_id">
        <input type="text" id="rtn-search" placeholder="Consumidor Final">
        <br>
        <div class="modal-footer">
            <button class="submit-button" id="continue_payment">Continuar</button>
            <button class="cancel-button" id="cancel-continue">Cancelar</button>
        </div>
    </div>

    <div class="form-payment">
        <div class="header-clients">
            <h1>Efectivo</h1>
            <a id=""><button> <span><i class="fa-solid fa-credit-card"></i></span> Pago tarjeta</button></a>
        </div>
        <br>
        <input type="text" id="payment" placeholder="00.00 Lps" autofocus>
        <br>
        <div class="modal-footer">
            <h5 id="pay_text"></h5>
            <h2 id="pay_total">Total</h2>
            <button class="submit-button" id="finish_sale">Guardar</button>
        </div>
    </div>

    <div class="header-sales">
        <a href="{{ route('dashboard-sales') }}" class="edit-link"><i class="fa-solid fa-backward-step"></i></a>
        <h1>Nueva Venta</h1>
    </div>
    @if (count($invoice_settings)>0)
    <div class="newSale-container">
        <div class="control-content">
            <div class="control-header">
                <input type="hidden" name="" id="item_id">
                <div class="form-group">
                    <label for="">Producto:</label>
                    <input type="text" id='product_search' placeholder="Buscar producto..." data-item autofocus>
                </div>
                <div class="form-group">
                    <label for="">Cantidad:</label>
                    <input type="number" id='quantity' placeholder="Cantidad..." min="1" value="1">
                </div>
            </div>
            <div class="sale-table">
                <table id="sale-table" class="hover stripe row-border display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="footer-sale">

                <div class="subtotal">
                    <h5>Subtotal:</h5>
                    <span id="subtotal">0</span>
                </div>
                |
                <div class="subtotal">
                    <h5>Subtotal Exentos:</h5>
                    <span id="subtotalE">0</span>
                </div>
                |
                <div class="subtotal">
                    <h5>Subtotal ISV 15%:</h5>
                    <span id="subisv">0</span>
                </div>
                |
                <div class="subtotal">
                    <h5>ISV 15%:</h5>
                    <span id="isv">0</span>
                </div>
                |
                <div class="total">
                    <h3>Total:</h3>
                    <span id="total">0</span>
                </div>
            </div>
        </div>
        <div class="actions-container">
            <input type="hidden" name="" id="invoice_setting" value="{{$invoice_settings[0]->id}}">
            <h3>Hora:</h3>
            <span>{{now()}}</span>
            <hr>
            <br>
            <h3>Factura:</h3>
            <span id="invoice_number">{{$invoice_settings[0]->invoices_set}}-{{$invoice_settings[0]->invoices}}</span>
            <hr>
            <br>
            <h3>Elementos:</h3>
            <span id="countElements">0</span>
            <hr>

            <div class="buttons-section">
                <button class="submit-button" id="continue_sale">Continuar</button>
                <button class="delete">Cancelar</button>
            </div>
        </div>
    </div>
    @else
    <h1>Se requiere configurar la factura en la seccion de configuraciones.</h1>
    @endif
</body>
<script src="{{ asset('js/admin/sales.function.js') }}"></script>