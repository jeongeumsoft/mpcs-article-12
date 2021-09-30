{!! Form::text('id')->type('hidden') !!}

<div class="form-group row">
    <label class="col">{{ trans('ui-bootstrap5::word.is_visible_message') }} </label>
    <div class="col-auto">

        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_visible">
            <label class="form-check-label"></label>
        </div>
    </div>
</div>
{!!Form::select('parent_id', '부모 카테고리', $categories)->attrs(['data-type' => 'select-one'])->wrapperAttrs(['class' => 'mb-3'])!!}

{!! Form::text('name', trans('ui-bootstrap5::word.name'))
->placeholder(trans('ui-bootstrap5::word.name'))
->wrapperAttrs(['class' => 'required']) !!}

{!!Form::select('type', '목록타입', $types)->attrs(['data-type' => 'select-one'])->wrapperAttrs(['class' => 'mb-3'])!!}

{!! Form::text('description', trans('ui-bootstrap5::word.description'))
->placeholder(trans('ui-bootstrap5::word.description')) !!}
