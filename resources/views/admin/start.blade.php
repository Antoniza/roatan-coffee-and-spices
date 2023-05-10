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
    <div class="charts-container" style="width: 100% !important; display: flex; justify-content: center;">
        <div style="width: 49%;">
            <h1>{{ $chart_clients->options['chart_title'] }}</h1>
            {!! $chart_clients->renderHtml() !!}
        </div>
        <div style="width: 49%;">
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
</script>
