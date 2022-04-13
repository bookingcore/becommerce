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
            {!! $row->getProcessedContent() !!}
        </div>
    @endif
@endsection
@section('footer')
    {{--<script src="{{ theme_url('Freshen') }}/js/single-counter.js"></script>--}}
@endsection
