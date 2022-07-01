<?php
if(setting_item('product_disable_downloadable') or !is_default_lang()) return;
?>
<div class="panel">
    <div class="panel-title"><strong>{{__("Downloadable")}}</strong></div>
    <div class="panel-body">
        <div class="form-group mb-3">
            <label class="font-weight-bold"><input type="checkbox" name="downloadable" value="1" @if(old('downloadable',$row->downloadable ?? '')) checked @endif> {{__('Enable downloadable')}}</label>
        </div>
        <div class="form-group mb-3" data-condition="downloadable:is(1)">
            <label for="">{{__("Download expiry")}}</label>
            <input type="number" min="0" class="form-control" placeholder="{{__("Never expired")}}" value="{{old('download_expiry_days',$row->download_expiry_days)}}">
            <p><i>{{__('Number of days before a download link expires. Leave bank for unlimited')}}</i></p>
        </div>
        <div class="form-group-item" data-condition="downloadable:is(1)">
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-11 text-left">{{__("File")}}</div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                @foreach($row->download_files as $key=>$download_file)
                    <div class="item" data-number="{{$key}}">
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" name="download_files[{{$key}}][file_name]" class="form-control" placeholder="{{__('File Name')}}" value="{{$download_file->file_name}}">
                            </div>
                            <div class="col-md-6">
                                {!! \Modules\Media\Helpers\FileHelper::fieldFileUpload('download_files['.$key.'][file_id]',$download_file->file_id,'product_download') !!}
                            </div>
                            <div class="col-md-1">
                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-right">
                <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
            </div>
            <div class="g-more hide">
                <div class="item" data-number="__number__">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" __name__="download_files[__number__][file_name]" class="form-control" placeholder="{{__('File Name')}}">
                        </div>
                        <div class="col-md-6">
                            {!! \Modules\Media\Helpers\FileHelper::fieldFileUpload('download_files[__number__][file_id]','','product_download','__name__') !!}
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
