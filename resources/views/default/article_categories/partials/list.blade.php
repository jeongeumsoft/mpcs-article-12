<ul class="crud-list p-3 nested-sortable" style="list-style: none">
        @each(Article::theme('article_categories.partials.branch'), $datas, 'branch')
</ul>
