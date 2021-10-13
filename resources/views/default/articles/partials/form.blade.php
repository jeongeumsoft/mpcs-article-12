{!! Form::text('id')->type('hidden') !!}
{!! Form::text('type')->type('hidden') !!}

<div class="row h-100">
    <div class="col-12 col-sm-4 col-lg-3">
        {!!Form::text('released_at', trans('mpcs-article::word.attr.released_at'))->attrs(['data-type' => 'data-picker-datetime'])->placeholder(trans('mpcs-article::word.attr.released_at'))->wrapperAttrs(['class' => 'required'])!!} 
        {!!Form::select('article_category_ids', trans('mpcs-article::word.attr.categories'), $article_categories)->attrs(['data-type' => 'select-multiple'])->multiple()->placeholder(trans('mpcs-article::word.attr.categories'))!!}
        {!!Form::text('title', trans('mpcs-article::word.attr.title'))->placeholder(trans('mpcs-article::word.attr.title'))->wrapperAttrs(['class' => 'required']) !!}
        {{-- {!!Form::select('tags', trans('mpcs-article::word.attr.tags'), $tags)->attrs(['data-type' => 'select-multiple'])->multiple()->placeholder(trans('mpcs-article::word.attr.tags'))!!} --}}
        
        {{-- 이미지 업로드 --}}
        @if(Article::useThumbnail())
        <div data-type="image-upload" class="form-group">
            <label for="thumbnail" class="">{{trans('mpcs-article::word.attr.thumbnail')}}</label>
            <div class="border rounded text-center p-2 my-1">
                <img src="" class="w-100 upload-image" data-default-src="{{Article::noImage()}}" data-crud-edit-name="small_image_url" data-crud-edit-type="image">
            </div>
            <input type="file" class="d-none" accept=".png,.jpg,.gif" />
            <input type="hidden" name="thumbnail" />
            <button type="button" class="btn btn-info align-middle" style="width: 100%"
                title="">
                <i class="mdi mdi-cloud-upload me-1"></i>
                파일선택
            </button>
        </div>
        @endif

        <label>{{trans('mpcs-article::word.attr.attachments')}}</label>
        <ul class="list-group" data-crud-show-template-id="script-template-edit-article_files" data-crud-edit-type="template-html" data-crud-edit-name="article_files">
        </ul>
        <div data-type="file-upload-multiple" data-relation-name="article_files[]" data-endpoint-url="/{{ Core::getConfig('url_prefix') }}/article_files" data-item-limit="5"  data-size-limit="10240000"></div>

    </div>
    <div class="col-12 col-sm-8 col-lg-9">
        {!!Form::textarea('summary', trans('mpcs-article::word.attr.summary'))->placeholder(trans('mpcs-article::word.attr.summary')) !!}
        {{-- 에디터 --}}
        <div data-type="editor" style="height: calc(100vh - 250px)">
            <div class="editor-wrap" data-crud-edit-type="editor" data-crud-edit-name="content"></div>
            <input type="hidden" name="content">
        </div>
    </div>
</div>
