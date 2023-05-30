<body>
    <div class="header-clients">
        <h1>Sección de Clientes</h1>
        <a id="newClientButton"><button> <span><i class="fa-solid fa-user-plus"></i></span> Nuevo Cliente</button></a>
    </div>

    <div class="table-container">
        <h3>Lista de clientes</h3>
        <table id="clients-table" class="hover stripe row-border display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>RTN</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Agregado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="/dashboard/client-edit/{{ $item->id }}" class="edit-link">{{ $item->full_name }}
                                <i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td>{{ $item->rtn }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <button class="delete deleteClient" data-id="{{ $item->id }}"
                                data-token="{{ csrf_token() }}"><i class="fa-solid fa-trash"></i> Borrar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script src="{{ asset('js/admin/clients.function.js') }}"></script>
<script>
    var today = new Date();
    $('#clients-table').DataTable({
        dom: 'Bfrtip',
        columnDefs: [{
                target: 5,
                visible: false,
            },
            {
                target: 6,
                searchable: 'false'
            },
        ],
        buttons: [{
                extend: 'colvis',
                text: 'Columnas',
                columns: ':not(.noVis)'
            },
            {
                extend: 'excel',
                text: '<i class="fa-solid fa-file-excel"></i> Excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }, {
                extend: 'print',
                text: '<i class="fa-solid fa-print"></i> Imprimir',
                exportOptions: {
                    columns: ':visible'
                },
                title: 'Roatán Coffee & Spices - Clientes',
                footer: 'false',
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
                                    <h2>Lista de Clientes</h2>
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
            }
        ],
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
