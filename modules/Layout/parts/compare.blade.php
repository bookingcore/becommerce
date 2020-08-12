<div class="bravo_compare_box">
    <div class="compare_overlay"></div>
    <button type="button" class="compare_close"><i class="icon-cross"></i></button>
    <div class="compare_content">
        <h1 class="compare-title">{{ __('Compare products') }}</h1>
        <table class="compare-list">
            @if($compare = session('compare'))
                @include('Product::frontend.layouts.compare')
            @else
                <tbody>
                    <tr class="no-products" role="row">
                        <td>{{ __('No products added in the compare table') }}</td>
                    </tr>
                </tbody>
            @endif
        </table>
    </div>
</div>
