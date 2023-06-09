<div class="modal" id="products-modal">
    <div class="modal-body">
        <div class="modal-header">
            <h2>Crear Nuevo Producto</h2>
        </div>
        <hr>
        <div class="modal-content">
            <form method="post" id="productForm">
                @csrf
                <div class="form-group">
                    <label for="">Nombre del producto</label>
                    <input type="text" name="product_name" id="product_name" class="form-control">
                    <center><span id="product_name-error"></span></center>
                </div>
                <div class="form-compact">
                    <div class="form-group">
                        <label for="">Precio</label>
                        <input type="number" name="product_first-price" id="product_first-price" class="form-control" step=".01" min="0">
                        <center><span id="first_price-error"></span></center>
                    </div>
                    <div class="form-group">
                        <label for="">Precio Gravado</label>
                        <input type="number" name="product_second-price" id="product_second-price" class="form-control" step=".01" value="0" disabled>
                        <center><span id="second_price-error"></span></center>
                    </div>
                </div>
                <div class="form-compact">
                    <div class="form-group">
                        <label for="">Descuento</label>
                        <input type="number" name="product_discount" id="product_discount" class="form-control" value="0" step=".01" min="0">
                        <center><span id="discount-error"></span></center>
                    </div>
                    <div class="form-group">
                        <label for="">Cantidad</label>
                        <input type="number" name="product_quantity" id="product_quantity" class="form-control" value="1" min="1">
                        <center><span id="quantity-error"></span></center>
                    </div>
                </div>
                <div class="form-compact">
                    <div class="form-group">
                        <label for="product_e">Exento</label>
                        <input type="radio" name="product_type-taxes" id="product_e" checked class="taxes_type form-control" value="E">
                    </div>
                    <div class="form-group">
                        <label for="product_g">Gravado</label>
                        <input type="radio" name="product_type-taxes" id="product_g" class="taxes_type form-control" value="G">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="submit-button" id="submit-button">Guardar</button>
            <button class="cancel-button" id="cancel-button">Cancelar</button>
        </div>
    </div>
</div>
