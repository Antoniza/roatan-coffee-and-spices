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
    $('#sales-table').DataTable();
</script>