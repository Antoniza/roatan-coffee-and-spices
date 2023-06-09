<div class="invoice_preview_head">
    <div class="invoice_preview_header">
        <h2><b>Roatán Coffee & Spices</b></h2>
        <hr>
        <p>Casa Matriz: {{$invoice_header->invoice_location}}</p>
        <p>Tel: {{$invoice_header->invoice_phone}}</p>
        <p>Correo: {{$invoice_header->invoice_email}}</p>
        <P>Factura: {{ $invoice->invoice_number }}</P>
        <p>RTN: 11011990004041</p>
        <p>CAI: {{ $invoice_setting->cai }}</p>
    </div>
    <img src="{{ asset('img/RoatancoffeeSpices.png') }}" />
</div>

<hr>
<div class="invoice_preview_underhead">
    <div class="invoice_preview_client">
        <p>Cliente: {{ $client->full_name }}</p>
        <p>RTN: {{ $client->rtn }}</p>
        <p>Fecha y Hora: {{ $invoice->shopping_date }}</p>
    </div>
    <div class="invoice_preview_ex">
        <p>DATOS DEL ADQUIRIENTE EXONERADO</p>
        <p>No. Correlativo de Orden de Compra Exenta:</p>
        <br>
        <p><hr></p>
        <p>No. Correlativo de Constancia Registro Exonerado:</p>
        <br>
        <p><hr></p>
        <p>No. Identificativo del Registro de la SAG</p>
        <br>
        <p><hr></p>
    </div>
</div>

<hr>
<table>
    <thead>
        <tr>
            <th>Cantidad</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($shopping_details as $item)
            <tr>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->name }}</td>
                <td>L. {{ $item->price }}</td>
                <td>L. {{ $item->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="invoice_preview_totals">
    <div class="preview_invoice_total">
        <span>Sub Total: </span>
        <span>L. {{ $invoice->sub_total }}</span>
    </div>

    <div class="preview_invoice_total">
        <span>Rebajas y Descuentos: </span>
        <span>L. 00.00</span>
    </div>

    <div class="preview_invoice_total">
        <span>Importe Exonerado: </span>
        <span>L. 00.00</span>
    </div>

    <div class="preview_invoice_total">
        <span>Importe Exento: </span>
        <span>L. {{ $invoice->sub_e }}</span>
    </div>

    <div class="preview_invoice_total">
        <span>Importe Gravado 15%: </span>
        <span>L. {{ $invoice->sub_isv }}</span>
    </div>

    <div class="preview_invoice_total">
        <span>Importe Gravado 18%: </span>
        <span>L. 00.00</span>
    </div>

    <div class="preview_invoice_total">
        <span>ISV 15%: </span>
        <span>L. {{ $invoice->isv }}</span>
    </div>

    <div class="preview_invoice_total">
        <span>ISV 18%: </span>
        <span>L. 00.00</span>
    </div>

    <div class="preview_invoice_total">
        <b>
            <span>Total: </span>
            <span>L. {{ $invoice->total }}</span>
        </b>
    </div>

    <div class="preview_invoice_total">
        <span>Cambio: </span>
        <span>L. {{ $invoice->change_money }}</span>
    </div>

    @if ($invoice->pay_way == 'Dolares')
    <div class="preview_invoice_total">
        <span>Moneda: </span>
        <span>{{ $invoice->pay_way }}</span>
    </div>

    <div class="preview_invoice_total">
        <span>Tasa de Cambio: </span>
        <span>L. {{ $invoice->dolar_change }}</span>
    </div>
    @else
    <div class="preview_invoice_total">
        <span>Moneda: </span>
        <span>{{ $invoice->pay_way }}</span>
    </div>
    @endif

    <div class="preview_invoice_total">
        <span>Metodo de pago: </span>
        <span>{{ $invoice->pay_method }}</span>
    </div>
</div>

<div class="invoice_preview_footer">
    <p>Total de: {{ $invoice->words }}</p>
    <div class="">
        <p>Firma:</p>
        <hr>
        <p>Rango autorizado:</p>
        <p>DEL {{ $invoice_setting->invoices_set }}-{{ $invoice_setting->start_range }} AL
            {{ $invoice_setting->invoices_set }}-{{ $invoice_setting->end_range }}</p>
        <p>Fecha limite de impresión:</p>
        <p>{{ $invoice_setting->end_date }}</p>
    </div>
</div>

<div class="invoice_preview_bottom">
    <p>¡Gracias por preferirnos!</p>
    <p>Original: Cliente | Copia: Obligado Tributario Emisor</p>
</div>
