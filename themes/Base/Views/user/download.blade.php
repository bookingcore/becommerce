@extends('layouts.app')
@section('content')
    @include('global.breadcrumb')
    <div class="bc-section-account mb-3 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @include('user.sidebar')
                </div>
                <div class="col-lg-8">
                    <div class="fs-24 mb-3">
                        <h3>{{__("My downloads")}}</h3>
                    </div>
                    <div class="bc-content">
                        @include('global.message')
                        <div class="bc-content">
                            <div class="table-responsive">
                                <table class="table bc-table">
                                    <thead>
                                    <tr>
                                        <th>{{__("Product")}}</th>
                                        <th>{{__("File")}}</th>
                                        <th>{{__("Expired At")}}</th>
                                        <th>{{__("Actions")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rows as $row)
                                        <tr>
                                            <td>
                                                <a href="{{$row->model->getDetailUrl() ?? ''}}">
                                                    {{$row->model->title ?? ''}}
                                                </a>
                                            </td>
                                            <td>{{$row->file_name}}</td>
                                            <td>
                                                <?php $expired_at = $row->getExpiredAt(); ?>
                                                @if($expired_at)
                                                    @if(strtotime($expired_at) > time())
                                                        {{display_datetime($expired_at)}}
                                                    @else
                                                        <div class="text-danger">{{__("Expired")}}</div>
                                                    @endif
                                                @else
                                                    <span class="text-success">{{__("No limit")}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($row->isValid())
                                                    <a class="btn btn-sm btn-primary" href="{{\Illuminate\Support\Facades\URL::signedRoute('user.download.start',['id'=>$row->id,'file_id'=>$row->download_id])}}"><i class="fa fa-download"></i> {{__('Download')}}</a>
                                                @else
                                                    <a class="btn btn-sm btn-warning"  href="{{$row->model->getDetailUrl() ?? ''}}">{{__("Re-order now")}}</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{$rows->withQueryString()->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
