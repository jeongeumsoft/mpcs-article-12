{!! Form::text('id')->type('hidden') !!}

<div class="form-group row">
    <label class="col">{{ Str::ucfirst(trans('ui-bootstrap5::word.is_visible_message')) }} </label>
    <div class="col-auto">

        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_visible">
            <label class="form-check-label"></label>
        </div>
    </div>
</div>
{!!Form::select('parent_id', Str::ucfirst(trans('mpcs-article::word.attr.parent_category')), $categories)->attrs(['data-type' => 'select-one'])->wrapperAttrs(['class' => 'mb-3'])!!}

{!! Form::text('name', Str::ucfirst(trans('ui-bootstrap5::word.name')))
->placeholder(Str::ucfirst(trans('ui-bootstrap5::word.name')))
->wrapperAttrs(['class' => 'required']) !!}

{!!Form::select('type', Str::ucfirst(trans('mpcs-article::word.attr.list_type')), $types)->attrs(['data-type' => 'select-one'])->wrapperAttrs(['class' => 'mb-3'])!!}

{!! Form::text('description', Str::ucfirst(trans('ui-bootstrap5::word.description')))
->placeholder(Str::ucfirst(trans('ui-bootstrap5::word.description'))) !!}
