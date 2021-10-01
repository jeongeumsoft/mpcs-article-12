@extends(Bootstrap5::theme('layouts.crud'))

{{-- 브라우저 타이틀 --}}
@section('app_title', trans('mpcs-article::menu.articles'))

{{-- 목록 서브타이틀 --}}
@section('crud_subtitle', trans('mpcs-article::menu.articles'))

{{-- 목록 타이틀 --}}
@section('crud_list_title', trans('mpcs-article::menu.articles'))


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
    @component(Bootstrap5::theme('components.modal_crud_create'))        
        {!!Form::open()->idPrefix('user_create_')!!}   
        @include(Article::theme('articles.partials.form'))
        {!!Form::close()!!}
    @endcomponent
    
    {{-- 수정 --}}
    @component(Bootstrap5::theme('components.modal_crud_edit'))
        {!!Form::open()->idPrefix('user_edit_')->method('put')!!}   
        @include(Article::theme('articles.partials.form'))
        {!!Form::close()!!}
    @endcomponent
    
    {{-- 보기 --}}
    @component(Bootstrap5::theme('components.modal_crud_show'))
        {{-- 컨텐츠 인클루드 --}}
        @include(Article::theme('articles.partials.show'))
    @endcomponent

    {{-- 삭제 --}}
    @component(Bootstrap5::theme('components.modal_crud_delete'))
    @endcomponent
    
@endsection

@push('after_app_src_scripts')
<script src="/vendor/mpcs-ui/bootstrap5/js/crud.js"></script>
@endpush

{{-- CURD 스크립트 추가--}}
@push('after_app_scripts')
    <script>
        window.CRUD.init();
    </script>
@endpush
