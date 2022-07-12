@if($list_items)
    <!-- Our Team -->
    <section class="our-team pb40 bb1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="main-title text-center">
                        <h2>{{ $title ?? "" }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($list_items as $item)
                    @php $avatar_url = get_file_url($item['avatar'], 'full') @endphp
                    <div class="col-sm-6 col-lg-4 col-xl-2">
                        <div class="team_member">
                            @if(!empty($avatar_url))
                                <div class="thumb">
                                    <img class="img-fluid" src="{{ $avatar_url }}" alt="{{$item['name']}}">
                                </div>
                            @endif
                            <div class="details">
                                <h4>{{$item['name']}}</h4>
                                <p>{{$item['position']}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif