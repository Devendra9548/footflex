@extends('templates.admin.admin-main')
@section('title')
Add Blog
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
            <h2>Add New Blog</h2>
            <hr><br>
            <form id="addBlog" action="" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" class="form-control py-3 h6" placeholder="Title here...">
                <br>
                <input type="text" name="slug" class="form-control py-3 h6"
                    placeholder="Slug here... like: /slug/here..">
                <br>
                <textarea id="div_editor1" name="description"></textarea><br>
                <label for="title" class="h6" style="font-size:22px">Feature Image:(1024 * 576) / (only .webp
                    image)</label>
                <input type="file" class="form-control" name="file" id="imageInput" accept="image/*"
                    onchange="previewImage()">
                <div id="preview" style="width:100%;overflow:hidden;margin-top:20px"></div>

                <label for="title" class="h6" style="font-size:22px;margin-top:15px;margin-bottom:10px">Select Sub
                    Category</label>
                <select name="category" id="category" class="form-control" style="margin-bottom:15px">
                    @foreach($members as $members)
                    <option value="{{ $members['id'] }}">{{ $members['bcname'] }}</option>
                    @endforeach
                </select><br>
                <input type="submit" class="btn btn-primary" value="Create Post">

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
    $("#addBlog").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/admin/add-blog",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res == true) {
                    $("#addBlog")[0].reset();
                    alert("Blog added successfully!");
                    window.location.reload('/admin/add-blog');
                } else {
                    alert("Error!" + res);
                }
            }
        });
    });
});
</script>
@endsection