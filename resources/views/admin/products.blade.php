<body>
    <div class="header-products">
        <h1>Sección de Productos</h1>
        <a href="#"><button> <span><i class="fa-solid fa-box-open"></i></span> Nuevo Producto</button></a>
    </div>
    
    <div class="table-container">
        <h3>Inventario</h3>
        <table id="products-table" class="hover stripe row-border" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                    <tr>
                        <tb>{{$item->id}}</tb>
                        <tb>{{$item->name}}</tb>
                        <tb>{{$item->quantity}}</tb>
                        <tb>{{$item->price}}</tb>
                        <tb> edit | delete</tb>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script>
    var editor;
    $('#products-table').DataTable({
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