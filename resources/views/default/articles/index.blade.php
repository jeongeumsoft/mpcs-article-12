@extends(Bootstrap5::theme('layouts.crud'))

{{-- 브라우저 타이틀 --}}
@section('app_title', Article::menuTitle(config('mpcsarticle.app_title')))

{{-- 목록 서브타이틀 --}}
@section('crud_subtitle', Article::menuTitle(config('mpcsarticle.subtitle')))

{{-- 목록 타이틀 --}}
@section('crud_list_title', Article::menuTitle(config('mpcsarticle.list_title')))

{{-- 사이트메뉴 인클루드 --}}
{{-- @section('aside_left_nav')
    @include(Article::theme('articles.partials.list_categories'), ['datas' => $categories])
@endsection --}}


{{-- 검색폼 영역 --}}
@section('crud_search')
    @component(Bootstrap5::theme('components.aside_crud_search'))
        @include(Article::theme('articles.partials.search'))
    @endcomponent
@endsection


{{-- 헤더 버튼 그룹 --}}
@section('crud_button_group')
    <button class="btn-crud-create btn btn-primary font-weight-bold"><i class="mdi mdi-account-plus mr-1"></i>
        {{ Str::title(trans('ui-bootstrap5::word.create')) }}</button>
@endsection


{{-- 목록 그리드 영역 --}}
@section('crud_grid')
    {{-- @include(Bootstrap5::theme('users.partials.list')) --}}
@endsection


{{-- CRUD 모달 폼 영역--}}
@section('crud_form')

    {{-- 생성 --}}
    @component(Bootstrap5::theme('components.modal_crud_create'), ['modalSize' => 'modal-fullscreen'])        
        {!!Form::open()->idPrefix('user_create_')->attrs(['class' => 'h-100'])!!}   
        @include(Article::theme('articles.partials.form'))
        {!!Form::close()!!}
    @endcomponent
    
    {{-- 수정 --}}
    @component(Bootstrap5::theme('components.modal_crud_edit'), ['modalSize' => 'modal-fullscreen'])
        {!!Form::open()->idPrefix('user_edit_')->method('put')->attrs(['class' => 'h-100'])!!}   
        @include(Article::theme('articles.partials.form'))
        {!!Form::close()!!}
    @endcomponent
    
    {{-- 보기 --}}
    @component(Bootstrap5::theme('components.modal_crud_show'), ['modalSize' => 'modal-fullscreen'])
        {{-- 컨텐츠 인클루드 --}}
        @include(Article::theme('articles.partials.show'))
    @endcomponent

    {{-- 삭제 --}}
    @component(Bootstrap5::theme('components.modal_crud_delete'))
    @endcomponent
    
@endsection



{{-- 스크립트 템플릿 --}}
@push('header_script')

    {{-- 파일업로드 --}}
    @component(Bootstrap5::theme('components.script_file_uploader'))
    @endcomponent

    {{-- 보기 : 카테고리, 첨부파일 --}}
    @component(Article::theme('articles.partials.script_templates'))
    @endcomponent
@endpush


@push('after_app_src_scripts')
<script src="/vendor/mpcs-ui/bootstrap5/js/crud.js"></script>
@endpush

{{-- CURD 스크립트 추가--}}
@push('after_app_scripts')
    <script>
        window.CRUD.init();
    </script>
@endpush
