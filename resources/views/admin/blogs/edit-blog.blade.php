@section('customcss')
<link rel="stylesheet" type="text/css" href="/assets/css/admin/rte_theme_default.css">
<link rel="stylesheet" type="text/css" href="/assets/css/admin/blogs.css">
@endsection

<form action="" id="addBlog" enctype="multipart/form-data" class="edit-blogs">
    @csrf
    <input type="hidden" name="id" id="hiddenid" value="{{ $members->id }}">
    <label for="title" class="fw-bold fs-4 mb-2">Page Title</label>
    <input type="text" name="title" class="form-control py-3 h6" placeholder="Title here..."
        value="{{ $members->title }}">
    <br>
    <label for="slug" class="fw-bold fs-4 mb-2">Page Slug</label>
    <input type="text" name="slug" class="form-control py-3 h6" placeholder="Slug here... like: /slug/here.."
        value="{{ $members->slug }}">
    <br>
    <textarea id="div_editor1" class="description" name="description">{{ $members->description }}</textarea><br>
    <label for="title" class="h6" style="font-size:22px">Upload Feature Image</label>
    <input type="file" class="form-control" name="file" id="imageInput" accept="image/*" onchange="previewImage()">
    <div id="preview" style="width:100%;overflow:hidden;margin-top:20px"><img src="/blogs/{{ $members->file }}" alt=""
            width="150px" class="mb-3"></div>

    <label for="category" class="fw-bold fs-4 mb-2">Select Category</label>
    <select name="category" id="" class="form-control">
        <option value="{{ $members->category }}">
            @foreach($allcats as $allcats)
            @if($allcats['id'] == $members->category)
            {{ $allcats['bcname'] }}
            @endif
            @endforeach
        </option>
        @foreach($cats as $cat)
        <option value="{{ $cat['id'] }}">{{ $cat['bcname'] }}</option>
        @endforeach
    </select><br>
    <div class="fixedbtn-2">
        <input type="submit" class="btn btn-primary read-btn" value="Update Blog">
    </div>
</form>
<script src="/assets/js/admin/all_plugins.js"></script>
<script src="/assets/js/admin/rte.js"></script>
<script>
var editor1cfg = {}
editor1cfg.toolbar = "basic";
var editor1 = new RichTextEditor("#div_editor1", editor1cfg);
</script>
<script>
$(document).ready(function() {
    $("#addBlog").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var hiddenid = document.querySelector("#hiddenid").value;
        $.ajax({
            type: "POST",
            url: "/admin/update-blog",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res == true) {
                    $("#addBlog")[0].reset();
                    alert("Blog updated successfully!");
                    window.location.reload('/admin/all-blogs');
                } else {
                    alert("Error!" + res);
                }
            }
        });
    });
});
</script>