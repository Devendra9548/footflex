@extends('templates.admin.admin-main')
@section('title')
Add Category
@endsection

@section('customcss')
<link rel="stylesheet" type="text/css" href="/assets/css/admin/rte_theme_default.css">
<link rel="stylesheet" type="text/css" href="/assets/css/admin/blogs.css">
@endsection

@section('body')
<x-admintopheader />
<div class="main-container">
    <x-blogmenu />

    <!-- second section -->
    <div class="container mt-5">
        <div class="form">
            <h2>Add New Category</h2>
            <hr><br>
            <form action="" id="addBlogCategory" enctype="multipart/form-data">
                @csrf
                <input type="text" name="bcname" class="form-control py-3 h6" placeholder="Category Name ...">
                <br>
                <input type="text" name="bcslug" class="form-control py-3 h6"
                    placeholder="Slug here... like: /slug/here..">
                <br>
                <textarea id="div_editor1" name="bcdescription"></textarea><br>
                <label for="title" class="h6" style="font-size:22px">Upload Feature Image</label>
                <input type="file" class="form-control" name="bcfile" id="imageInput" accept="image/*"
                    onchange="previewImage()">
                <div id="preview" style="width:100%;overflow:hidden;margin-top:20px"></div>

                <select name="bccategory" id="" class="form-control" placeholder="select">
                    <option value="">Select Sub Category</option>
                    @foreach($members as $members)
                    <option value="{{ $members['id'] }}">{{ $members['bcname'] }}</option>
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
<script src="/assets/js/admin/all_plugins.js"></script>
<script src="/assets/js/admin/rte.js"></script>
<script>
var editor1cfg = {}
editor1cfg.toolbar = "basic";
var editor1 = new RichTextEditor("#div_editor1", editor1cfg);

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
        $("#addBlogCategory").submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
  
            $.ajax({
                type: "POST",
                url: "/admin/add-blog-category",
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res == true) {
                        $("#addBlogCategory")[0].reset();
                        alert("Blog Category added successfully!");
                        window.location.reload('/admin/add-blog-category');
                    } else {
                        alert("Error!"+res);
                    }
                }
            });
        });
    });
    </script>       
@endsection