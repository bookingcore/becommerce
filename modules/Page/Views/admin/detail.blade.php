@extends('admin.layouts.app')

@section('content')

    <form action="{{route('page.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit: ') .$translation->title :  __('Add new page') }}</h1>
                    @if($row->slug)
                        <p class="item-url-demo">{{ __('Permalink: ')}} {{ url((request()->query('lang') ? request()->query('lang').'/' : ''). config('page.page_route_prefix') )}}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                        </p>
                    @endif
                </div>
                <div class="">
                    @if($row->id)
                        <a class="btn btn-primary btn-sm" href="{{route('page.admin.builder',['id'=>$row->id])}}"><i class="fa fa-paint-brush"></i> {{ __('Template Builder')}}</a>
                    @endif
                    @if($row->slug)
                        <a class="btn btn-default btn-sm" href="{{$row->getDetailUrl(request()->query('lang'))}}" target="_blank"><i class="fa fa-eye"></i> {{ __('View page')}}</a>
                    @endif
                </div>
            </div>
            @include('Layout::admin.message')
            @if($row->id)
                @include('Language::admin.navigation')
            @endif
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-title">
                                <strong>{{ __('Page Content')}}</strong>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>{{ __('Title')}} <span class="text-danger">*</span></label>
                                    <input required type="text" value="{{$translation->title}}" placeholder="Page title" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{ __('Content')}}</label>
                                    <div class="">
                                        <textarea name="content" class="d-none has-tinymce" cols="30" rows="10">{{$translation->content}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('Core::admin/seo-meta/seo-meta')
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__('Publish')}}</strong></div>
                            <div class="panel-body">
                                @if(is_default_lang())
                                <div>
                                    <label><input @if($row->status=='publish') checked @endif type="radio" name="status" value="publish"> {{__("Publish")}}
                                    </label></div>
                                <div>
                                    <label><input @if($row->status=='draft') checked @endif type="radio" name="status" value="draft"> {{__("Draft")}}
                                    </label></div>
                                @endif

                                    <hr>
                                <div class="form-group">
                                    <label >{{__("Display type")}}</label>

                                    <div>
                                        <label><input @if($row->show_template) checked @endif type="radio" name="show_template" value="1"> {{__("Template")}}
                                        </label></div>
                                    <div>
                                        <label><input @if(!$row->show_template) checked @endif type="radio" name="show_template" value="0"> {{__("Content")}}
                                        </label></div>
                                </div>
                                <?php do_action(\Modules\Page\Hook::FORM_AFTER_DISPLAY_TYPE,$row) ?>
                            </div>
                            <div class="panel-footer">
                                <div class="text-right">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> {{__('Save Changes')}}</button>
                                </div>
                            </div>
                        </div>

                        @if(is_default_lang())
                            <div class="panel">
                                <div class="panel-title"><strong>{{__("Author")}}</strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <?php
                                        $user = !empty($row->author_id) ? App\User::find($row->author_id) : false;
                                        \App\Helpers\AdminForm::select2('author_id', [
                                            'configs' => [
                                                'ajax'        => [
                                                    'url' => url('/admin/module/user/getForSelect2'),
                                                    'dataType' => 'json'
                                                ],
                                                'allowClear'  => true,
                                                'placeholder' => __('-- Select User --')
                                            ]
                                        ], !empty($user->id) ? [
                                            $user->id,
                                            $user->display_name . ' (#' . $user->id . ')'
                                        ] : false)
                                        ?>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(is_default_lang())
                            <div class="panel">
                                <div class="panel-body">
                                    <h3 class="panel-body-title">{{ __('Feature Image')}}</h3>
                                    <div class="form-group">
                                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$translation->image_id) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@section ('script.body')
@endsection
