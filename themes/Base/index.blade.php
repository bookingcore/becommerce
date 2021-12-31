@extends("layouts.app")
@section('content')
    @if($row->template_id)
        @php
            $bg = (!empty($c_background)) ? json_decode($c_background) : '';
            if (!empty($bg->image)){
                $background = get_file_url($bg->image,'full');
                $style = "url($background)";
            } else {
                $style = (!empty($bg->color)) ? $bg->color : '';
            }
        @endphp
        <div class="page-template-content" style="background: {!! clean($style) !!}">
            {!! clean($row->getProcessedContent()) !!}
        </div>
    @else
        <div class="container " style="padding-top: 40px;padding-bottom: 40px;">
            <h1>{{$row->title}}</h1>
            <div class="blog-content">
                {!! clean($row->content) !!}
            </div>
        </div>
    @endif
@endsection
