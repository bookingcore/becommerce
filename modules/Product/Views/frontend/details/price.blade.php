@if(!empty($row->sale_price))
    <p class="price has-sale">
        <ins>
            <span class="amount">{{format_money($row->sale_price)}}</span>
        </ins>
        <del>
            <span class="amount">{{format_money($row->price)}}</span>
        </del>
    </p>
@else
    <p class="price">
        <span class="amount">{{format_money($row->price)}}</span>
    </p>
@endif
