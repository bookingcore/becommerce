<div class="bravo-list-news">
    <!-- Our Partner & Blog -->
    <section class="our-blog pt0 pb60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="main-title text-center">
                        <h2>{{$title}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($rows as $row)
                    <div class="col-md-6 col-xl-4">
                        @include('news.loop')
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>