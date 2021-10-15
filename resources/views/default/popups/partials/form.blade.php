{!! Form::text('id')->type('hidden') !!}
{!! Form::text('type')->type('hidden') !!}

<div class="row h-100">
    <div class="col-12 col-sm-auto">

        <div class="form-group row">
            <label class="col">{{ Str::title(trans('ui-bootstrap5::word.is_visible_message')) }} </label>
            <div class="col-auto">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_visible">
                    <label class="form-check-label"></label>
                </div>
            </div>
        </div>

        
        <div class="form-group row">
            <label>
                {{ Str::title(trans('mpcs-article::word.attr.type')) }}
                <button type="button" class="btn p-0" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" title="타입선택" data-bs-content="이미지 방식은 이미지에 링크주소만 출력, HTML은 HTML 내용으로 출력">
                    <i class="mdi mdi-information"></i>
                </button> 
            </label>
            <div class="btn-group w-100" role="group">
                <input type="radio" class="btn-check" name="type" id="{{$idPrefix}}type_image" value="IMAGE" autocomplete="off" checked>
                <label class="btn btn-outline-dark" for="{{$idPrefix}}type_image">
                    <i class="mdi mdi-check"></i>
                    이미지 방식
                </label>
                <input type="radio" class="btn-check" name="type" id="{{$idPrefix}}type_text" value="TEXT" autocomplete="off">
                <label class="btn btn-outline-dark" for="{{$idPrefix}}type_text">
                    <i class="mdi mdi-check"></i>
                    HTML 방식
                </label>
            </div>
        </div>

        <div class="form-group">
            <label>게시기간</label>
            <div class="input-group mb-3">
                <input data-type="data-picker-datetime" type="text" name="period_from" class="form-control" placeholder="{{trans('mpcs-article::word.attr.period_from')}}">
                <span class="input-group-text">~</span>
                <input data-type="data-picker-datetime" type="text" name="period_to" class="form-control" placeholder="{{trans('mpcs-article::word.attr.period_to')}}">
            </div>
        </div>
        {!!Form::text('url', trans('mpcs-article::word.attr.url'))->placeholder(trans('mpcs-article::word.attr.url'))->type('url') !!}
        <div class="form-group row">
            <label>{{ Str::title(trans('mpcs-article::word.is_target_title')) }} </label>
            <div class="btn-group w-100" role="group">
                <input type="radio" class="btn-check" name="target" id="{{$idPrefix}}target_self" value="_self" autocomplete="off" checked>
                <label class="btn btn-outline-dark" for="{{$idPrefix}}target_self">
                    <i class="mdi mdi-check"></i>
                    {{Str::title(trans('mpcs-article::word.target_self'))}}
                </label>
                <input type="radio" class="btn-check" name="target" id="{{$idPrefix}}target_blank" value="_blank" autocomplete="off">
                <label class="btn btn-outline-dark" for="{{$idPrefix}}target_blank">
                    <i class="mdi mdi-check"></i>
                    {{Str::title(trans('mpcs-article::word.target_blank'))}}
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="image" class="">
                {{trans('mpcs-article::word.attr.image')}}
                <button type="button" class="btn p-0" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" title="이미지 규격" data-bs-content="420px * 600px 이미지 사이즈에 최적화 되어 있습니다.">
                    <i class="mdi mdi-information"></i>
                </button>
            </label>
            <div data-type="image-upload">
                <div class="ratio ratio-42x60 mx-auto mb-1" style="max-width: 420px;">
                    <img src="" class="upload-image" data-default-src="{{Article::noImage()}}" data-crud-edit-name="image_file_url" data-crud-edit-type="image">
                </div>
                <input type="file" class="d-none" accept=".png,.jpg,.gif" />
                <input type="hidden" name="image" />
                <button type="button" class="btn btn-info align-middle" style="width: 100%"
                    title="">
                    <i class="mdi mdi-cloud-upload me-1"></i>
                    파일선택
                </button>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm">
        {!!Form::text('title', trans('mpcs-article::word.attr.title'))->placeholder(trans('mpcs-article::word.attr.title'))->wrapperAttrs(['class' => 'required']) !!}

        {{-- <div class="form-group">
            <label>{{ Str::title(trans('mpcs-article::word.attr.background_color')) }} </label>
            <div class="col border rounded p-2" data-type="color-picker">
                <input type="hidden" name="background_color">
            </div>
        </div> --}}

        {{-- 에디터 --}}
        <label>
            HTML
        </label>
        <div data-type="editor" style="height: calc(100% - 105px);">
            <div class="editor-wrap" data-crud-edit-type="editor" data-crud-edit-name="content"></div>
            <input type="hidden" name="content">
        </div>
    </div>
</div>
