<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ trans('installer_messages.title') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('module/installer/img/favicon/favicon-16x16.png') }}" sizes="16x16"/>
        <link rel="icon" type="image/png" href="{{ asset('module/installer/img/favicon/favicon-32x32.png') }}" sizes="32x32"/>
        <link rel="icon" type="image/png" href="{{ asset('module/installer/img/favicon/favicon-96x96.png') }}" sizes="96x96"/>
        <link href="{{ asset('module/installer/css/style.min.css') }}" rel="stylesheet"/>
        @yield('style')
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <style>
            .logo-text,.logo-1,.logo-2{
                text-decoration: none;
            }
            .c-000000 {
                color: white;
            }
            .fw-700 {
                font-weight: 700;
            }
            .fs-33 {
                font-size: 33px;
            }
            .hl {
                color: #28afb1;
            }
            .has_header2 .c-000000,.responsive-sidebar .c-000000,.sticky .c-000000{
                color:black;
            }
            .px-3{
                padding:30px 0px;
            }
        </style>
    </head>
    <body>
        <div class="master">
            <div>
            <div class="text-center px-3">
                <span class="logo-text fs-33 fw-700 c-000000">Be<span class="hl fw-700">Commerce</span></span>
            </div>
            <div class="box">
                <div class="header">
                    <h1 class="header__title">@yield('title')</h1>
                </div>
                <ul class="step">
                    <li class="step__divider"></li>
                    <li class="step__item {{ isActive('LaravelInstaller::environment')}} {{ isActive('LaravelInstaller::environmentWizard')}} {{ isActive('LaravelInstaller::environmentClassic')}}">
                        @if(Request::is('install/environment') || Request::is('install/environment/wizard') || Request::is('install/environment/classic') )
                            <a href="{{ route('LaravelInstaller::environment') }}">
                                <i class="step__icon fa fa-cog" aria-hidden="true"></i>
                            </a>
                        @else
                            <i class="step__icon fa fa-cog" aria-hidden="true"></i>
                        @endif
                    </li>
                    <li class="step__divider"></li>
                    <li class="step__item {{ isActive('LaravelInstaller::permissions') }}">
                        @if(Request::is('install/permissions') || Request::is('install/environment') || Request::is('install/environment/wizard') || Request::is('install/environment/classic') )
                            <a href="{{ route('LaravelInstaller::permissions') }}">
                                <i class="step__icon fa fa-key" aria-hidden="true"></i>
                            </a>
                        @else
                            <i class="step__icon fa fa-key" aria-hidden="true"></i>
                        @endif
                    </li>
                    <li class="step__divider"></li>
                    <li class="step__item {{ isActive('LaravelInstaller::requirements') }}">
                        @if(Request::is('install') || Request::is('install/requirements') || Request::is('install/permissions') || Request::is('install/environment') || Request::is('install/environment/wizard') || Request::is('install/environment/classic') )
                            <a href="{{ route('LaravelInstaller::requirements') }}">
                                <i class="step__icon fa fa-list" aria-hidden="true"></i>
                            </a>
                        @else
                            <i class="step__icon fa fa-list" aria-hidden="true"></i>
                        @endif
                    </li>
                    <li class="step__divider"></li>
                </ul>
                <div class="main">
                    @if (session('message'))
                        <p class="alert text-center">
                            <strong>
                                @if(is_array(session('message')))
                                    {{ session('message')['message'] }}
                                @else
                                    {{ session('message') }}
                                @endif
                            </strong>
                        </p>
                    @endif
                    @if(session()->has('errors'))
                        <div class="alert alert-danger" id="error_alert">
                            <button type="button" class="close" id="close_alert" data-dismiss="alert" aria-hidden="true">
                                 <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                            <h4>
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ trans('installer_messages.forms.errorTitle') }}
                            </h4>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('container')
                </div>
            </div>
            </div>
        </div>
        @yield('scripts')
        <script type="text/javascript">
            var x = document.getElementById('error_alert');
            var y = document.getElementById('close_alert');
            y.onclick = function() {
                x.style.display = "none";
            };
        </script>
    </body>
</html>
