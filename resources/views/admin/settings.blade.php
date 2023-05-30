<body>
    <div class="header-settings">
        <h1>Configuraciones</h1>
    </div>
    <div class="settings-container">
        <div class="setting-card">
            <div class="setting-card-header">
                <h3>Configuración de facturación</h3>
            </div>
            <div class="setting-card-body">
                <form method="post">
                    @csrf
                    @if (count($settings) != 0)
                        <input type="hidden" id="id" value="{{ $settings[0]->id }}">
                        <div class="form-group">
                            <label for="">CAI</label>
                            <input type="text" name="caiCode" id="caiCode" placeholder="Ingrese el CAI"
                                class="form-control" value="{{ $settings[0]->cai }}">
                        </div>
                        <div class="form-group">
                            <label for="">RTN</label>
                            <input type="text" name="rtnCode" id="rtnCode" placeholder="Ingrese el RTN"
                                class="form-control" value="{{ $settings[0]->rtn }}">
                        </div>
                        <div class="form-group-container">
                            <div class="form-group">
                                <label for="">Fecha Inicial</label>
                                <input type="date" name="startDate" id="startDate" class="form-control"
                                    value="{{ $settings[0]->start_date }}">
                            </div>
                            <div class="form-group">
                                <label for="">Fecha Final</label>
                                <input type="date" name="endDate" id="endDate" class="form-control"
                                    value="{{ $settings[0]->end_date }}">
                            </div>
                            <div class="form-group">
                                <label for="">Facturas desde</label>
                                <input type="text" name="startRange" id="startRange" class="form-control"
                                    value="{{ $settings[0]->invoices_set }}-{{ $settings[0]->start_range }}">
                            </div>
                            <div class="form-group">
                                <label for="">Facturas hasta</label>
                                <input type="text" name="endRange" id="endRange" class="form-control"
                                    value="{{ $settings[0]->invoices_set }}-{{ $settings[0]->end_range }}">
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="">CAI</label>
                            <input type="text" name="caiCode" id="caiCode" placeholder="Ingrese el CAI"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">RTN</label>
                            <input type="text" name="rtnCode" id="rtnCode" placeholder="Ingrese el RTN"
                                class="form-control" pattern="(8 6)\d{2} \d{2} \d{3}">
                        </div>
                        <div class="form-group-container">
                            <div class="form-group">
                                <label for="">Fecha Inicial</label>
                                <input type="date" name="startDate" id="startDate" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Fecha Final</label>
                                <input type="date" name="endDate" id="endDate" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Facturas desde</label>
                                <input type="text" name="startRange" id="startRange" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Facturas hasta</label>
                                <input type="text" name="endRange" id="endRange" class="form-control">
                            </div>
                        </div>
                    @endif
                </form>
                @if (count($settings) != 0)
                    <button id="updateCaiData" class="updateCaiData">Actualizar</button>
                @else
                    <button id="saveCaiData" class="saveCaiData">Guardar</button>
                @endif
            </div>
        </div>

        @if (count($settings) > 0)
        <input type="hidden" id="id" value="{{ $settings[0]->id }}">
            <div class="setting-card">
                <div class="setting-card-header">
                    <h3>Tasa de cambio del dolar</h3>
                </div>
                <div class="setting-card-body">
                    <form method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Taza de cambio (Lps)</label>
                            <input type="number" name="dolar_change" id="dolar_change"
                                placeholder="Ingrese la taza de cambio" class="form-control"
                                value="{{ $settings[0]->dolar_change }}">
                        </div>
                    </form>
                    <button id="updateDolarChange" class="updateDolarChange">Actualizar</button>
                </div>
            </div>

            @if ($invoice_header != null)
            <div class="setting-card">
                <div class="setting-card-header">
                    <h3>Información de factura</h3>
                </div>
                <div class="setting-card-body">
                    <form method="post">
                        @csrf
                        <input type="hidden" id="id" value="{{ $settings[0]->id }}">
                        <div class="form-group">
                            <label for="">Ubicación</label>
                            <input type="text" name="invoice_location" id="invoice_location"
                                placeholder="Ingrese la ubicación de la empresa" class="form-control"
                                value="{{$invoice_header->invoice_location}}">
                        </div>

                        <div class="form-group">
                            <label for="">telefono</label>
                            <input type="text" name="invoice_phone" id="invoice_phone"
                                placeholder="Ingrese el telefono de la empresa" class="form-control"
                                value="{{$invoice_header->invoice_phone}}">
                        </div>

                        <div class="form-group">
                            <label for="">Correo</label>
                            <input type="email" name="invoice_email" id="invoice_email"
                                placeholder="Ingrese la taza de cambio" class="form-control"
                                value="{{$invoice_header->invoice_email}}">
                        </div>
                    </form>
                    <button id="updateInvoiceHeader" class="updateInvoiceHeader">Actualizar</button>
                </div>
            </div>
            @else
            <div class="setting-card">
                <div class="setting-card-header">
                    <h3>Información de factura</h3>
                </div>
                <div class="setting-card-body">
                    <form method="post">
                        @csrf
                        <input type="hidden" id="id" value="{{ $settings[0]->id }}">
                        <div class="form-group">
                            <label for="">Ubicación</label>
                            <input type="text" name="invoice_location" id="invoice_location"
                                placeholder="Ingrese la ubicación de la empresa" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">telefono</label>
                            <input type="text" name="invoice_phone" id="invoice_phone"
                                placeholder="Ingrese el telefono de la empresa" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Correo</label>
                            <input type="email" name="invoice_email" id="invoice_email"
                                placeholder="Ingrese la taza de cambio" class="form-control">
                        </div>
                    </form>
                    <button id="updateInvoiceHeader" class="updateInvoiceHeader">Actualizar</button>
                </div>
            </div>
            @endif
        @endif
    </div>
</body>
<script src="{{ asset('js/admin/settings.function.js') }}"></script>
