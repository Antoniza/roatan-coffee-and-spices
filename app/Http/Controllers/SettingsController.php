<?php

namespace App\Http\Controllers;

use App\Models\InvoiceSetting;
use Illuminate\Http\Request;
class SettingsController extends Controller
{

    public function index(){
        $invoceSetting = InvoiceSetting::all();
        return response()->view('admin.settings', ['settings' => $invoceSetting]);
    }
    public function store(Request $request){
        $request->validate([
            'cai' => ['required', 'min:37'],
            'rtn' => ['required', 'min:14'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'start_range' => ['required'],
            'end_range' => ['required']
        ]);

        list($section1, $section2, $section3, $invoice) = explode("-", $request->start_range);
        list($section4, $section5, $section6, $invoice_end) = explode("-", $request->end_range);


        $setting = new InvoiceSetting();
        $setting -> cai = $request -> cai;
        $setting -> rtn = $request -> rtn;
        $setting -> start_date = $request -> start_date;
        $setting -> end_date = $request -> end_date;
        $setting -> start_range = $invoice;
        $setting -> end_range = $invoice_end;
        $setting -> invoices_set = $section1.'-'.$section2.'-'.$section3;
        $setting -> invoices = $invoice;
        $setting -> update_by = auth()->user()->id;
        $setting -> save();

        return response()->json(['message'=>'Encabezado de factura actualizado.']);
    }

    public function update(Request $request, $id){

        list($section1, $section2, $section3, $invoice) = explode("-", $request->start_range);
        list($section4, $section5, $section6, $invoice_end) = explode("-", $request->end_range);


        $setting = InvoiceSetting::find($id);
        $setting -> cai = $request -> cai;
        $setting -> rtn = $request -> rtn;
        $setting -> start_date = $request -> start_date;
        $setting -> end_date = $request -> end_date;
        $setting -> start_range = $invoice;
        $setting -> end_range = $invoice_end;
        $setting -> invoices_set = $section1.'-'.$section2.'-'.$section3;
        $setting -> invoices = $invoice;
        $setting -> update_by = auth()->user()->id;
        $setting -> save();

        $setting->save();

        return response()->json(['message'=>'Configuración CAI actualizada.']);
     }
}