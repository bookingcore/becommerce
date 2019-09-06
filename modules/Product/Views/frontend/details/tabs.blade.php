<div class="product-tabs">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @if(!empty($row->tabs))
            @foreach($row->tabs as $k=>$tab)
                <li class="nav-item">
                    <a class="nav-link @if(!$k) active @endif" data-toggle="tab" href="#tab_{{$k}}" role="tab" aria-controls="home" aria-selected="true">{{$tab['name']}}</a>
                </li>
            @endforeach
        @endif
    </ul>
    <div class="tab-content">
        @if(!empty($row->tabs))
            @foreach($row->tabs as $k=>$tab)
                <div class="tab-pane fade @if(!$k) show active @endif" id="tab_{{$k}}" role="tabpanel">
                    @if(!empty($tab['content']))
                        {!! clean($tab['content']) !!}
                    @elseif(isset($tab['id']) and view()->exists('Product::frontend.details.tabs.'.$tab['id']))
                        @include('Product::frontend.details.tabs.'.$tab['id'])
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>