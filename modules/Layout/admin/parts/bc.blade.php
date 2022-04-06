@if(!empty($breadcrumbs))
<nav class="main-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class='fa fa-home'></i> {{__("Dashboard")}}</a></li>

            @foreach($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item {{$breadcrumb['class'] ?? ''}}">
                    @if(!empty($breadcrumb['url']))
                        <a href="{{url($breadcrumb['url'])}}">{{$breadcrumb['name']}}</a>
                    @else
                        {{$breadcrumb['name']}}
                    @endif
                </li>
            @endforeach

    </ol>
</nav>
@endif
@if(setting_item('last_schedule_check') !=date('Y-m-d'))
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <h5 class="alert-heading">{{__('Please setup the Scheduler')}} </h5>
                    <p>
                        {{__('We need to add a single cron configuration entry to our server that runs the scheduler')}}
                        <a target="_blank" href="https://laravel.com/docs/8.x/scheduling#running-the-scheduler">{{__('Click here')}}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif
