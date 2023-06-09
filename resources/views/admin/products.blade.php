<body>
    <div class="header-products">
        <h1>Sección de Productos</h1>
        <a href="#" id="newProductButton"><button> <span><i class="fa-solid fa-box-open"></i></span> Nuevo
                Producto</button></a>
    </div>

    <div class="table-container">
        <h3>Inventario</h3>
        <table id="products-table" class="hover stripe row-border display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Cantidad Inv.</th>
                    <th>Precio</th>
                    <th>Precio Gravado</th>
                    <th>Impuestos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><a href="/dashboard/product-edit/{{ $item->id }}" class="edit-link">{{ $item->name }} <i
                                    class="fa-solid fa-pen-to-square"></i></a></td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->first_price }} &nbsp; Lps</td>
                        <td>{{ $item->second_price }} &nbsp; Lps</td>
                        <td>
                            @if ($item->type_taxes == 'E')
                                Exento
                            @else
                                Gravado
                            @endif
                        </td>
                        <td>
                            <button class="delete deleteProduct" data-id="{{ $item->id }}"
                                data-token="{{ csrf_token() }}"><i class="fa-solid fa-trash"></i> Borrar </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script src="{{ asset('js/admin/products.function.js') }}"></script>
<script>
    var today = new Date();
    var editor;
    $('#products-table').DataTable({
        dom: 'Bfrtip',
        columnDefs: [{
            target: 5,
            visible: false,
            searchable: 'false'
        }],
        buttons: [{
            extend: 'colvis',
            text: 'Columnas',
            columns: ':not(.noVis)'
        }, {
            extend: 'excel',
            text: '<i class="fa-solid fa-file-excel"></i> Excel',
            exportOptions: {
                columns: [0, 1, 2]
            }
        }, {
            extend: 'print',
            text: '<i class="fa-solid fa-print"></i> Imprimir',
            exportOptions: {
                columns: ':visible'
            },
            title: 'Roatán Coffee & Spices - Productos',
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
                                    <h2>Lista de Productos</h2>
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
