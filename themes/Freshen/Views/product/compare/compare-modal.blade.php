<div class="modal bravo_compare_box fade" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __("Compare") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped compare-list">
                        @if($compare = get_compare_details())
                            @include('product.compare.list')
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
        </div>
    </div>
</div>