<div class="bravo_HowItWorks">
    <div class="container">
        <h4 class="bravo-header-title mf-semi-bold">{{ $title }}</h4>
        <h2 style="font-size: 30px;text-align: center" class="bravo-sub-title mf-regular">
            {{ $sub_title }}
        </h2>
        <div class="martfury-process ">
            <div class="list-process">
                @if(!empty($list))
                    @php $stt = 1; @endphp
                    @foreach($list as $item)
                        <div class="row process-content">
                            <div class="col-md-5 process-image">
                                {!! get_image_tag($item['image'], 'full') !!}
                            </div>
                            <div class="col-md-2 process-step">
                                <div class="step">{{$stt}}</div>
                            </div>
                            <div class="col-md-5 process-desc">
                                <h3>{{$item['title']}}</h3>
                                <div class="desc">
                                    {!! clean($item['content']) !!}
                                </div>
                            </div>
                        </div>
                    @php $stt++; @endphp
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
