{{-- Show : 카테고리명 --}}
<script type="text/template" id="script-template-article_categories">
    <span class="badge bg-info">
        {nested_str}
    </span> 
</script>

{{-- Show : 태그 --}}
<script type="text/template" id="script-template-tags">
    <span class="badge rounded-pill border border-dark text-dark">
        #{name}
    </span> 
</script>

{{-- Show : Uploader --}}
<script type="text/template" id="script-template-article_files">
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <div class="col">
            {caption} <span class="badge bg-body text-dark">{size}</span> 
        </div>
        <div class="col-auto">
            <a class="btn btn-sm btn-icon btn-primary" href="{file_url}" download="{caption}">
                <i class="mdi mdi-download"></i>
            </a>
        </div>
    </li>
</script>

{{-- Edit : Uploader --}}
<script type="text/template" id="script-template-edit-article_files">
    <li data-template-wrap="item" class="list-group-item d-flex justify-content-between align-items-center mb-1">
        <div class="col">
            {caption} <span class="badge bg-body text-dark">{size}</span> 
        </div>
        <div class="col-auto">
            <a class="btn btn-sm btn-icon btn-primary" href="{file_url}" download="{caption}">
                <i class="mdi mdi-download"></i>
            </a>
            <button data-template-btn="delete" data-template-target="item" data-template-field-name="delete_article_files[]" data-template-value="{id}" type="button" class="btn btn-sm btn-icon btn-danger">
                <i class="mdi mdi-trash-can"></i>
            </button>
        </div>
    </li>
</script>