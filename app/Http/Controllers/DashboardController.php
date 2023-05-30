<?php

namespace App\Http\Controllers;

use App\Models\InvoiceSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{

    public $chart1;

    public function index()
    {
        $chart1 = 'month';
        $chart_options_clients = [
            'chart_title' => 'Nuevos Clientes por Mes',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Client',
            'group_by_field' => 'created_at',
            'group_by_period' => $chart1,
            'chart_type' => 'bar',
            'chart_color' => '99,72,50',
        ];
        $chart_clients = new LaravelChart($chart_options_clients);


        $chart_options_sales = [
            'chart_title' => 'Ventas por Día',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Sale',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'chart_color' => '99,72,50',
        ];
        $chart_sales = new LaravelChart($chart_options_sales);

        $todayData = DB::table('invoices')
            ->selectRaw('count(*) as sales, sum(total) as total')
            ->whereDate('created_at', Carbon::today())
            ->get();

        $invoice_setting = InvoiceSetting::all();

        $storageControl = DB::table('products')
            ->select('*')
            ->where('quantity', '<=', 5)
            ->get();

        return response()->view('admin.index', compact('chart_clients', 'chart_sales', 'todayData', 'invoice_setting', 'storageControl'));
    }
}
