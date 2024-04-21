@section('customcss')
<link rel="stylesheet" type="text/css" href="/assets/css/admin/rte_theme_default.css">
<link rel="stylesheet" type="text/css" href="/assets/css/admin/blogs.css">
@endsection

<form action="" id="addBlogCategory" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="hiddenid" value="{{ $members->id }}">
    <input type="text" name="bcname" id="bcname" class="form-control py-3 h6" placeholder="Category Name ..."
        value="{{ $members->bcname }}">
    <br>
    <input type="text" name="bcslug" id="bcslug" class="form-control py-3 h6"
        placeholder="Slug here... like: /slug/here.." value="{{ $members->bcslug }}">
    <br>

    <textarea id="div_editor1" class="bcdescription" name="bcdescription">{{ $members->bcdescription }}</textarea><br>
    <label for="title" class="h6" style="font-size:22px">Upload Feature Image</label>
    <input type="file" class="form-control" name="bcfile" id="imageInput" accept="image/*" onchange="previewImage()">
    <div id="preview" style="width:100%;overflow:hidden;margin-top:20px"><img src="/blogs/{{ $members->bcfile }}" alt=""
            width="150px" class="mb-3"></div>

    <select name="bccategory" id="" class="form-control">
        @if(isset($members) && isset($members->bccategory))
        <option value="{{ $members->bccategory }}">
            @foreach($cats as $cat)
            @if($cat['id'] == $members->bccategory)
            {{ $cat['bcname'] }}
            @endif
            @endforeach
        </option>
        @else
        <option value="">Select Sub Category</option>
        @endif
        
        @foreach($cats as $cats)
        <option value="{{ $cats['id'] }}">{{ $cats['bcname'] }}</option>
        @endforeach

    </select><br>
    <input type="submit" class="btn btn-primary read-btn" value="Update Category">

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
        $("#addBlogCategory").submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            var hiddenid = document.querySelector("#hiddenid").value;
            $.ajax({
                type: "post",
                url: "/admin/update-blog-category",
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res == true) {
                        $("#addBlogCategory")[0].reset();
                        alert("Blog Category updated successfully!");
                        window.location.reload('/admin/all-blogs-categories');
                    } else {
                        alert("Error!"+res);
                    }
                }
            });
        });
    });
    </script>