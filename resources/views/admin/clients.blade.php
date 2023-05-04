<body>
    <div class="header-sales">
        <h1>Sección de Clientes</h1>
        <a href="#" id="newClientButton"><button> <span><i class="fa-solid fa-cart-plus"></i></span> Nuevo Cliente</button></a>
    </div>
    
    <div class="table-container">
        <h3>Lista de clientes</h3>
        <table id="clients-table" class="hover stripe row-border" style="width:100%">
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
                @foreach ($clients as $item)
                    <tr>
                        <tb>{{$item->id}}</tb>
                        <tb>{{$item->name}}</tb>
                        <tb>{{$item->email}}</tb>
                        <tb>{{$item->phone}}</tb>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script src="{{asset('js/admin/clients.function.js')}}"></script>
<script>
    $('#clients-table').DataTable({
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
        }
    });
</script>