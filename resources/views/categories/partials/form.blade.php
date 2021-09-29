{!! Form::text('id')->type('hidden') !!}
{!! Form::text('parent_id')->type('hidden') !!}

<div class="form-group row">
    <label class="col">{{ trans('ui-bootstrap5::word.is_visible_message') }} </label>
    <div class="col-auto">
        
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_visible">
            <label class="form-check-label"></label>
        </div>
    </div>
</div>

<div class="form-group breadcrumb-wrap">
    <label>상위 카테고리</label>
    <div class="form-control">
    </div>
</div>

{!! Form::text('name', trans('ui-bootstrap5::word.name'))
->placeholder(trans('ui-bootstrap5::word.name'))
->wrapperAttrs(['class' => 'required']) !!}

{!! Form::text('slug', trans('ui-bootstrap5::word.slug'))
->placeholder(trans('ui-bootstrap5::word.slug'))
->wrapperAttrs(['class' => 'required']) !!}

{!! Form::text('description', trans('ui-bootstrap5::word.description'))
->placeholder(trans('ui-bootstrap5::word.description')) !!}


