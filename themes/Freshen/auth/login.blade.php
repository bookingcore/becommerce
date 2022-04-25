@extends('layouts.app')

@section('content')
    <section class="our-log bgc-f5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5 offset-xl-4">
                    <div class="log_reg_form">
                        <ul class="sign_up_tab nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home2-tab" data-bs-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">
                                    {{ __("Login") }}
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content container p0" id="myTabContent2">
                            <div class="row mt30 tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home2-tab">
                                <div class="col-lg-12">
                                    @include("auth.login-form")
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
