<body class="edit-body">
    <div class="header-products">
        <a href="{{ route('dashboard-products') }}" class="edit-link"><i class="fa-solid fa-backward-step"></i></a>
        <h1>Edición de Producto</h1>
    </div>
    <div class="edit-panel">
        <form action="" id="edit_productForm">
            @csrf
            <input type="hidden" name="" id="edit-product_id" value="{{$product->id}}">
            <div class="form-group">
                <label for="">Nombre del producto</label>
                <input type="text" name="edit_product_name" id="edit_product_name" class="form-control" value="{{$product->name}}">
                <center><span id="edit_product_name-error"></span></center>
            </div>
            <div class="form-compact">
                <div class="form-group">
                    <label for="">Precio</label>
                    <input type="number" name="edit_product_first-price" id="edit_product_first-price" class="form-control" step=".01" value="{{$product->first_price}}" min="0">
                    <center><span id="edit_first_price-error"></span></center>
                </div>
                <div class="form-group">
                    <label for="">Precio Grabado</label>
                    <input type="number" name="edit_product_second-price" id="edit_product_second-price" class="form-control" step=".01" value="{{$product->second_price}}" min="0">
                    <center><span id="edit_second_price-error"></span></center>
                </div>
            </div>
            <div class="form-compact">
                <div class="form-group">
                    <label for="">Descuento (%)</label>
                    <input type="number" name="edit_product_discount" id="edit_product_discount" class="form-control" step=".01" value="{{$product->discount}}" min="0">
                    <center><span id="edit_discount-error"></span></center>
                </div>
                <div class="form-group">
                    <label for="">Cantidad (U/C)</label>
                    <input type="number" name="edit_product_quantity" id="edit_product_quantity" class="form-control" value="{{$product->quantity}}" min="1">
                    <center><span id="edit_quantity-error"></span></center>
                </div>
            </div>
            <div class="form-compact">
                <div class="form-group">
                    <label for="product_e">Exento</label>
                    <input type="radio" name="edit_product_type-taxes" id="edit_product_e" @if ($product->type_taxes == 'E')
                        @checked(true)
                    @endif class="edit_taxes_type form-control" value="E">
                </div>
                <div class="form-group">
                    <label for="product_g">Grabado</label>
                    <input type="radio" name="edit_product_type-taxes" id="edit_product_g" @if ($product->type_taxes == 'G')
                    @checked(true)
                @endif  class="edit_taxes_type form-control" value="G">
                </div>
                <div class="form-group">
                    <label for="product_g">Selectivo</label>
                    <input type="radio" name="edit_product_type-taxes" id="edit_product_s" @if ($product->type_taxes == 'S')
                    @checked(true)
                @endif  class="edit_taxes_type form-control" value="S">
                </div>
            </div>
        </form>
        <div class="edit-footer">
            <button class="submit-button" id="edit-product-button">Actualizar</button>
        </div>
    </div>
</body>
<script src="{{ asset('js/admin/products.function.js') }}"></script>