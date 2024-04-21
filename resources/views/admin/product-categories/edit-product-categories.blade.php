@section('customcss')
<link rel="stylesheet" type="text/css" href="/assets/css/admin/rte_theme_default.css">
<link rel="stylesheet" type="text/css" href="/assets/css/admin/blogs.css">
@endsection

<form action="" id="updateProductCategory" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="hiddenid" value="{{ $members->id }}">
    <input type="text" name="category_name" id="category_name" class="form-control py-3 h6" placeholder="Category Name ..."
        value="{{ $members->category_name }}">
    <br>
    <input type="text" name="slug" id="slug" class="form-control py-3 h6"
        placeholder="Slug here... like: /slug/here.." value="{{ $members->slug }}">
    <br>

    <label for="title" class="h6" style="font-size:22px">Upload Feature Image</label>
    <input type="file" class="form-control" name="image" id="imageInput" accept="image/*" onchange="previewImage()">
    <div id="preview" style="width:100%;overflow:hidden;margin-top:20px"><img src="/products/{{ $members->image }}" alt=""
            width="150px" class="mb-3"></div>

    <select name="p_category" id="" class="form-control">
        @if(isset($members) && isset($members->p_category))
        <option value="{{ $members->p_category }}">
            @foreach($cats as $cat)
            @if($cat['id'] == $members->p_category)
            {{ $cat['category_name'] }}
            @endif
            @endforeach
        </option>
        @else
        <option value="">Select Parent Category</option>
        @endif
        
        @foreach($cats as $cats)
        <option value="{{ $cats['id'] }}">{{ $cats['category_name'] }}</option>
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
        $("#updateProductCategory").submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            var hiddenid = document.querySelector("#hiddenid").value;
            $.ajax({
                type: "post",
                url: "/admin/update-product-category",
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res == true) {
                        $("#updateProductCategory")[0].reset();
                        alert("Product Category updated successfully!");
                        window.location.reload('/admin/all-products-categories');
                    } else {
                        alert("Error!"+res);
                    }
                }
            });
        });
    });
    </script>