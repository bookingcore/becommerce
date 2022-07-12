<div class="modal bravo_compare_box" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="axtronic-icon-times"></i></button>
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
