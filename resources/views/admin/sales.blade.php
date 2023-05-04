<body>
    <div class="header-sales">
        <h1>Sección de Ventas</h1>
        <a href="#"><button> <span><i class="fa-solid fa-cart-plus"></i></span> Nueva Venta</button></a>
    </div>
    
    <div class="table-container">
        <h3>Historial de ventas</h3>
        <table id="sales-table" class="hover stripe row-border" style="width:100%">
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
                        <tb>{{$item->id}}</tb>
                        <tb>{{$item->id_client}}</tb>
                        <tb>{{$item->id_invoice}}</tb>
                        <tb>{{$item->created_at}}</tb>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script>
    var editor;
    $('#sales-table').DataTable({
        language: {
            processing:     "Tratamiento en proceso...",
            search:         "Buscar",
            lengthMenu:     "Mostrar _MENU_ registros por pagina",
            info:           "Mostrando del registro _START_ al _END_ de _TOTAL_ registros",
            infoEmpty:      "0 de 0 registros",
            infoFiltered:   "(Filtro de _MAX_ registros en total)",
            infoPostFix:    "",
            loadingRecords: "Cargando registros...",
            zeroRecords:    "No hay registros que cargar",
            emptyTable:     "No hay datos disponibles en la tabla",
            paginate: {
                first:      "Primero",
                previous:   "Previo",
                next:       "Siguiente",
                last:       "Ultimo"
            },
            aria: {
                sortAscending:  ": Activar orden ascendente",
                sortDescending: ": Activar orden descendente"
            }
        },
        buttons: [
            { extend: 'create', editor: editor },
            { extend: 'edit',   editor: editor },
            { extend: 'remove', editor: editor },
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
    });
</script>