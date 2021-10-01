{!! Form::text('id')->type('hidden') !!}
{!! Form::text('type')->type('hidden') !!}

{!!Form::text('released_at', trans('mpcs-article::word.attr.released_at'))->attrs(['data-type' => 'data-picker-datetime'])->placeholder(trans('mpcs-article::word.attr.released_at'))!!} 
{!!Form::select('categories[]', trans('mpcs-article::word.attr.categories'), $categories)->attrs(['data-type' => 'select-multiple'])->multiple()->placeholder(trans('mpcs-article::word.attr.categories'))!!}

{!!Form::text('title', trans('mpcs-article::word.attr.title'))->placeholder(trans('mpcs-article::word.attr.title'))->wrapperAttrs(['class' => 'required']) !!}

{!!Form::textarea('summary', trans('mpcs-article::word.attr.summary'))->placeholder(trans('mpcs-article::word.attr.summary')) !!}

{!!Form::select('tags[]', trans('mpcs-article::word.attr.tags'), $tags)->attrs(['data-type' => 'select-multiple'])->multiple()->placeholder(trans('mpcs-article::word.attr.tags'))!!}
