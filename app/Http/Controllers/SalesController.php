<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceSetting;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index()
    {
        $sales = DB::table('sales')
            ->select('sales.id', 'clients.full_name', 'invoices.invoice_number', 'invoices.shopping_date', 'sales.created_at')
            ->join('clients', 'clients.id', '=', 'sales.id_client')
            ->join('invoices', 'invoices.id', '=', 'sales.id_invoice')
            ->get();

        $invoice_settings = InvoiceSetting::all();
        return response()->view('admin.sales', ['sales' => $sales, 'invoice_settings' => $invoice_settings]);
    }

    public function new()
    {
        $products = Product::all();
        $clients = Client::all();
        $invoice_settings = InvoiceSetting::all();
        return response()->view('admin.newSale', ['products' => $products, 'clients' => $clients, 'invoice_settings' => $invoice_settings]);
    }

    public function store(Request $request)
    {

        $invoice = new Invoice();
        if ($request->id_client == 0) {
            $client = Client::all()->first();
            $invoice->id_client = $client->id;
        } else {
            $invoice->id_client = $request->id_client;
        }
        $invoice->invoice_number = $request->invoice_number;
        $invoice->shopping_details = json_encode($request->shopping_details);
        $invoice->shopping_date = $request->shopping_date;
        $invoice->id_user = $request->id_user;
        $invoice->id_invoice_setting = $request->id_invoice_setting;
        $invoice->elements = $request->elements;
        $invoice->pay_method = $request->pay_method;
        $invoice->pay_way = $request->pay_way;
        $invoice->sub_total = $request->sub_total;
        $invoice->sub_e = $request->sub_e;
        $invoice->sub_isv = $request->sub_isv;
        $invoice->isv = $request->isv;
        $invoice->total = $request->total;
        $invoice->change_money = $request->change_money;
        $invoice->dolar_change = $request->dolar_change;
        $invoice->words = $request->words;
        $invoice->save();

        $settings = InvoiceSetting::find($request->id_invoice_setting);
        $settings->invoices = $settings->invoices + 1;
        $settings->save();


        $sale = new Sale();
        $last_sale = Invoice::all()->last();
        if ($request->id_client == 0) {
            $sale->id_client =  $client->id;
        } else {
            $sale->id_client =  $request->id_client;
        }
        $sale->id_invoice = $last_sale->id;
        $sale->save();

        for ($i = 0; $i < count($request->shopping_details); $i++) {
            $item = Product::find($request->shopping_details[$i]['id']);
            $item->quantity = $item->quantity - $request->shopping_details[$i]['quantity'];
            $item->save();
        }
    }

    public function invoice($id)
    {

        $sale = Sale::find($id);

        $invoice = Invoice::find($sale->id_invoice);

        $shopping_details = json_decode($invoice->shopping_details);

        $client = Client::find($invoice->id_client);

        $user = User::find($invoice->id_user);

        $invoice_setting = InvoiceSetting::find($invoice->id_invoice_setting);

        $invoice_header = json_decode($invoice_setting['invoice_header']);
        return response()->view('admin.invoice.invoice', ['invoice_setting' => $invoice_setting, 'sale' => $sale, 'user' => $user, 'client' => $client, 'invoice' => $invoice, 'shopping_details' => $shopping_details, 'invoice_header' => $invoice_header]);
    }

    public function printInvoice()
    {

        $sale = Sale::all()->last();

        $invoice = Invoice::find($sale->id_invoice);

        $shopping_details = json_decode($invoice->shopping_details);

        $client = Client::find($invoice->id_client);

        $user = User::find($invoice->id_user);

        $invoice_setting = InvoiceSetting::find($invoice->id_invoice_setting);

        $invoice_header = json_decode($invoice_setting['invoice_header']);
        return response()->view('admin.invoice.invoice', ['invoice_setting' => $invoice_setting, 'sale' => $sale, 'user' => $user, 'client' => $client, 'invoice' => $invoice, 'shopping_details' => $shopping_details, 'invoice_header' => $invoice_header]);
    }
}
