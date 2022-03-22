@extends('layouts.app')
@section('content')
    @if($row->template_id && $row->show_template)
        <div class="page-template-content">
            {!! ($row->getProcessedContent()) !!}
        </div>
    @else
         @include('global.breadcrumb')
        <div class="axtronic-contact-info">
            <div class="container">
                <div class="axtronic-section__header">
                    <h3>{{$translation->title}}</h3>
                </div>
                <div class="axtronic-section__content">
                    {!! clean($translation->content) !!}
                    <p><i>{{__("Last updated: :date",['date'=>display_date($row->updated_at)])}}</i></p>
                </div>
            </div>
        </div>
    @endif
@endsection
