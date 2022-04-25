@extends ('admin.layouts.app')
@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="d-flex justify-content-between mb20">
                    <h1 class="title-bar">{{__('Tools - Schedule')}}</h1>
                </div>
                <div class="panel">
                    <div class="panel-body pd15">
                        @if(!\Cache::has('last_schedule_check') or (now() > \Cache::get('last_schedule_check')))
                        <div class="row">
                            <div class="col-md-12">
                                <p class="font-weight-bold">{{__('You only need to add a single cron configuration entry to your server that runs the schedule:run command every minute. ')}}</p>
                                <div class="border rounded p-3 mb-2 w-100">
                                    <code class=" ">* * * * * cd {{base_path()}} && php artisan schedule:run >> /dev/null 2>&1</code>

                                </div>
                            </div>
                            <div class="col-12">
                                <p class="font-weight-bold">
                                    {{__("if you  added . Please click button to check")}}
                                </p>
                                <form action="" class="text-center" method="post">
                                    @csrf
                                    <button class="btn btn-outline-primary btn-sm">{{__('Check')}}</button>
                                </form>
                            </div>
                        </div>
                        @else
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-center font-weight-bold">{{__('Schedule configured')}}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
