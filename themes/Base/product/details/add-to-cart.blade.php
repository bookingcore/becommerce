@if($row->stock_status == 'in')
    <div class="bc-product__shopping">
        <figure>
            <figcaption>Quantity</figcaption>
            <div class="form-group--number">
                <button class="up"><i class="fa fa-plus"></i></button>
                <button class="down"><i class="fa fa-minus"></i></button>
                <input class="form-control" name="quantity" type="number" min="1" max="{{ $row->is_manage_stock > 0 ? $row->quantity - $row->sold : 100 }}" value="1">
            </div>
        </figure>
        <a class="btn btn--black" href="#">Add to cart</a>
        <a class="btn" href="#">Buy Now</a>
        <div class="bc-product__actions">
            <a href="#">
                <i class="icon-heart"></i>
            </a>
            <a href="#">
                <i class="icon-chart-bars"></i>
            </a>
        </div>
    </div>
@endif
