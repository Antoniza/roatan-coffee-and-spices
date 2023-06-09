@if (count($invoice_settings) > 0)
    @if ($invoice_settings[0]->invoice_header != null)

        <body>

            <div class="invoice_preview_back">
                <div class="printing">
                    <button class="submit-button" id="reprint_button">Imprimir</button>
                    <button class="cancel-button" id="cancel-reprint">Cancelar</button>
                </div>
            </div>
            <div class="invoice">
                <div class="invoice_preview" id="invoice">
                    <div class="loading" style="display: flex">
                        <div class="lds-dual-ring"></div>
                    </div>
                </div>
            </div>

            <div class="header-sales">
                <h1>Sección de Ventas</h1>
                <a href="{{ route('dashboard-new-sales') }}" id="new-sale"><button> <span><i
                                class="fa-solid fa-cart-plus"></i></span> Nueva Venta</button></a>
            </div>

            <div class="table-container">
                <h3>Historial de ventas</h3>
                <table id="sales-table" class="hover stripe row-border display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cliente</th>
                            <th># Factura</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->full_name }}</td>
                                <td>{{ $item->invoice_number }}</td>
                                <td>{{ $item->shopping_date }}</td>
                                <td><a href="/dashboard/get-invoice/{{ $item->id }}" class="load_invoice" data-invoice="{{ $item->invoice_number }} - ({{ $item->shopping_date }})">
                                        <button><i class="fa-solid fa-print"></i> Reimprimir</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </body>
        <script src="{{ asset('js/admin/sales.function.js') }}"></script>
        <script>
            var today = new Date();
            var editor;
            $('#sales-table').DataTable({
                order: [
                    [0, "desc"]
                ],
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'colvis',
                    text: 'Columnas',
                    columns: ':not(.noVis)'
                }, {
                    extend: 'excel',
                    text: '<i class="fa-solid fa-file-excel"></i> Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    },
                    className: 'export-excel'
                }, {
                    extend: 'print',
                    text: '<i class="fa-solid fa-print"></i> Imprimir',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    },
                    title: 'Roatán Coffee & Spices - Ventas',
                    footer: 'true',
                    customize: function(win) {
                        $(win.document.body).find('h1').remove();

                        $(win.document.body)
                            .css('font-size', '10pt')
                            .prepend(
                                `
                            <div style="width:100%; height: auto; padding-bottom: 2rem; display: flex; justify-content: flex-start; aling-items: center; flex-direction: row;">
                                <div style="width: 40%; height: 100%">
                                    <img src="{{ asset('img/RoatancoffeeSpices.png') }}" style="width: 80%" />
                                </div>

                                <div style="width: 60%; margin-top: 5%;">
                                    <h2>Lista de Ventas</h2>
                                </div>

                                <div style="width: 30%; margin-top: -5%;">
                                    <h6>Impreso el ` + today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today
                                .getDate() + ' || ' + today.getHours() + ":" + today.getMinutes() + ":" +
                                today.getSeconds() + `</h6>
                                </div>
                            </div>

                            `,
                                '<img src="{{ asset('img/RoatancoffeeSpices.png') }}" style="opacity: 0.3; position: absolute; top: 0; left: 0; right: 0; bottom: 0; margin: auto; width: 80%" />'
                            );

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }],
                language: {
                    processing: "Tratamiento en proceso...",
                    search: "<i class='fa-solid fa-magnifying-glass'></i> Buscar",
                    lengthMenu: "Mostrar _MENU_ registros por pagina",
                    info: "Mostrando del registro _START_ al _END_ de _TOTAL_ registros",
                    infoEmpty: "0 de 0 registros",
                    infoFiltered: "(Filtro de _MAX_ registros en total)",
                    infoPostFix: "",
                    loadingRecords: "Cargando registros...",
                    zeroRecords: "No hay registros que cargar",
                    emptyTable: "No hay datos disponibles en la tabla",
                    paginate: {
                        first: "Primero",
                        previous: "Previo",
                        next: "Siguiente",
                        last: "Ultimo"
                    },
                    aria: {
                        sortAscending: ": Activar orden ascendente",
                        sortDescending: ": Activar orden descendente"
                    }
                }
            });
        </script>
    @else
        <h1>Factura no configurada</h1>
        <p>Se requiere que configure el encabezado de factura previamente para realizar una venta o acción similar.</p>
    @endif
@else
    <h1>Factura no configurada</h1>
    <p>Se requiere que configure la factura previamente para realizar una venta o acción similar.</p>
@endif
