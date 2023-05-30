<div class="information hide" title="Shift + i">
    <div class="state-hidden">
        <i class="fa-solid fa-circle-info"></i>
    </div>
    <div class="state-container">
        <span id="closeStatePanel">
            <i class="fa-sharp fa-solid fa-circle-xmark"></i>
        </span>
        <h1>Estado del Sistema.</h1>
        <div class="state-card">
            <h3>Quedan:</h3>
            <span>{{$invoice_setting[0]->end_range - $invoice_setting[0]->invoices + 1}}</span> Facturas
            <hr>
            @if (count($storageControl) > 0)
                <h3>Estado de inventario:</h3>
                @foreach ($storageControl as $item)
                    <h5>- {{$item->name}} <span style="@if($item->quantity <= 5 and $item->quantity > 1) {{ 'color: yellow' }}@else {{ 'color: rgb(625 31, 31)' }}@endif">(Cantidad: {{$item->quantity}})</span></h5>
                @endforeach
            @endif
        </div>
    </div>
</div>
<div class="dashboard-container">
    <h1>Información de Hoy</h1>
    <div class="cards-container">
        <div class="card">
            <div class="card-header">
                <h3>Ventas de Hoy</h3>
            </div>
            <div class="card-body">
                <h5>{{ $todayData[0]->sales }}</h5>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Monto de Ventas</h3>
            </div>
            <div class="card-body">
                <h5> {{ $todayData[0]->total }} <span class="coin">Lps</span></h5>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Atajos</h3>
            </div>
            <div class="card-body">
                <span>F1 - Nueva Venta</span>
                <span>F2 - Productos</span>
                <span>F3 - Clientes</span>
            </div>
        </div>
    </div>
    <div class="charts-container">
        <div>
            <h1>{{ $chart_clients->options['chart_title'] }}</h1>
            {!! $chart_clients->renderHtml() !!}
        </div>
        <div>
            <h1>{{ $chart_sales->options['chart_title'] }}</h1>
            {!! $chart_sales->renderHtml() !!}
        </div>
    </div>
</div>
<script src="{{ asset('js/admin/start.function.js') }}"></script>
{!! $chart_clients->renderChartJsLibrary() !!}
{!! $chart_clients->renderJs() !!}

{!! $chart_sales->renderChartJsLibrary() !!}
{!! $chart_sales->renderJs() !!}
