<div class="information hide">
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
            <span>25</span> Facturas
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
                <h5>0</h5>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Monto de Ventas</h3>
            </div>
            <div class="card-body">
                <h5>0 <span class="coin">Lps</span></h5>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Atajos</h3>
            </div>
            <div class="card-body">
                F1 - Nuevo Cliente
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
<script>
    {!! $chart_clients->renderChartJsLibrary() !!}
    {!! $chart_clients->renderJs() !!}

    {!! $chart_sales->renderChartJsLibrary() !!}
    {!! $chart_sales->renderJs() !!}
    <script src="{{asset('js/admin/start.function.js')}}"></script>
</script>
