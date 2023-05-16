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
                        <input type="hidden" id="id" value="{{$settings[0]->id}}">
                        <div class="form-group">
                            <label for="">CAI</label>
                            <input type="text" name="caiCode" id="caiCode" placeholder="Ingrese el CAI" class="form-control" value="{{ $settings[0]->cai }}">
                        </div>
                        <div class="form-group">
                            <label for="">RTN</label>
                            <input type="text" name="rtnCode" id="rtnCode" placeholder="Ingrese el RTN" class="form-control" value="{{ $settings[0]->rtn }}">
                        </div>
                        <div class="form-group-container">
                            <div class="form-group">
                                <label for="">Fecha Inicial</label>
                                <input type="date" name="startDate" id="startDate" class="form-control" value="{{ $settings[0]->start_date }}">
                            </div>
                            <div class="form-group">
                                <label for="">Fecha Final</label>
                                <input type="date" name="endDate" id="endDate" class="form-control" value="{{ $settings[0]->end_date }}">
                            </div>
                            <div class="form-group">
                                <label for="">Facturas desde</label>
                                <input type="text" name="startRange" id="startRange" class="form-control" value="{{ $settings[0]->start_range }}">
                            </div>
                            <div class="form-group">
                                <label for="">Facturas hasta</label>
                                <input type="text" name="endRange" id="endRange" class="form-control" value="{{ $settings[0]->end_range }}">
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="">CAI</label>
                            <input type="text" name="caiCode" id="caiCode" placeholder="Ingrese el CAI" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">RTN</label>
                            <input type="text" name="rtnCode" id="rtnCode" placeholder="Ingrese el RTN" class="form-control" pattern="(8 6)\d{2} \d{2} \d{3}">
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
    </div>
</body>
<script src="{{asset('js/admin/settings.function.js')}}"></script>