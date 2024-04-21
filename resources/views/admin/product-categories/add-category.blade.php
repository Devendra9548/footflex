@extends('templates.admin.admin-main')
@section('title')
Add Category
@endsection

@section('customcss')
<link rel="stylesheet" type="text/css" href="/assets/css/admin/blogs.css">
@endsection

@section('body')
<x-admintopheader />
<div class="main-container">
<x-productmenu />

    <!-- second section -->
    <div class="container mt-5">
        <div class="form">
            <h2>Add New Product Category</h2>
            <hr><br>
            <form action="" id="addProductCategory" enctype="multipart/form-data">
                @csrf
                <input type="text" name="category_name" class="form-control py-3 h6" placeholder="Category Name ...">
                <br>
                <input type="text" name="slug" class="form-control py-3 h6"
                    placeholder="Slug here... like: /slug/here..">
                <br>
                <label for="title" class="h6" style="font-size:22px">Upload Feature Image</label>
                <input type="file" class="form-control" name="image" id="imageInput" accept="image/*"
                    onchange="previewImage()">
                <div id="preview" style="width:100%;overflow:hidden;margin-top:20px"></div><br>
                <label for="select" class="h6" style="font-size:22px">Select Parent Category</label>
                <select name="p_category" id="select" class="form-control" placeholder="select">
                    <option value="">Select Parent Category</option>
                    @foreach($members as $members)
                    <option value="{{ $members['id'] }}">{{ $members['category_name'] }}</option>
                    @endforeach
                </select><br>
                <input type="submit" class="btn btn-primary" value="Create Category">

            </form>
            <br><br><br><br><br><br>
        </div>
    </div>

</div>
</body>
@endsection
@section('customjs')
<script>


function previewImage() {
    var preview = document.getElementById('preview');
    var fileInput = document.getElementById('imageInput');
    var file = fileInput.files[0];

    // Check if a file is selected
    if (file) {
        var reader = new FileReader();

        // Set up the reader onload event
        reader.onload = function(e) {
            // Create an image element
            var img = new Image();
            img.src = e.target.result;


            // Append the image to the preview div
            preview.innerHTML = '';
            preview.appendChild(img);
        };

        // Read the file as a data URL
        reader.readAsDataURL(file);
    } else {
        // If no file is selected, clear the preview
        preview.innerHTML = '';
    }
}
</script>
<script>
    $(document).ready(function() {
        $("#addProductCategory").submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
  
            $.ajax({
                type: "POST",
                url: "/admin/add-product-category",
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res == true) {
                        $("#addProductCategory")[0].reset();
                        alert("Product Category added successfully!");
                        window.location.reload('/admin/add-product-category');
                    } else {
                        alert("Error!"+res);
                    }
                }
            });
        });
    });
    </script>       
@endsection