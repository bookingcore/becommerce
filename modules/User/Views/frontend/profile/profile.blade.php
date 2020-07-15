@extends('layouts.app')

@section('content')
<div class="page-profile-content page-template-content">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-3 col-bravo-filter">
                    @include('User::frontend.profile.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="bravo_profile_content woocommerce">
                        @if(!empty($rows))
                            @include('Product::frontend.layouts.search.content-search_content')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('User::frontend.profile.services')
</div>
@endsection
