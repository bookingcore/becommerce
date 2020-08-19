<div class="bravo_FrequentlyAskedQuestions">
    <div class="container">
        <h4 class="bravo-header-title mf-semi-bold">{!! clean($title) !!}</h4>
        <h2 class="bravo-sub-title mf-regular">{!! clean($sub_title) !!}</h2>
        <div class="row bravo-content-list">
            <div class="col-sm-6">
                @if(!empty($itemListLeft))
                    @foreach($itemListLeft as $item)
                        <h3 class="bravo-content-title mf-semi-bold">{!! clean($item['title']) !!}</h3>
                        <div class="bravo-content">
                            {!! clean($item['content']) !!}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-sm-6">
                @if(!empty($itemListRight))
                    @foreach($itemListRight as $item)
                        <h3 class="bravo-content-title mf-semi-bold">{!! clean($item['title']) !!}</h3>
                        <div class="bravo-content">
                            {!! clean($item['content']) !!}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <hr class="break_line">
        <div class="contact-us">
            <h2 class="contact-title mf-regular">{!! clean($contact_title) !!}</h2>
            <div class="martfury-button text-center size-large color-dark ">
                <a href="{{$contact_link}}">{!! clean($contact_link_button) !!}</a>
            </div>
        </div>
    </div>
</div>
