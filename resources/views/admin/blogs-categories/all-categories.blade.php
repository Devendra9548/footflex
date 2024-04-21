@extends('templates.admin.admin-main')
@section('title')
All Categories
@endsection

@section('customcss')
<link rel="stylesheet" type="text/css" href="/assets/css/admin/rte_theme_default.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('body')
<x-admintopheader />

<div class="main-container">
    <x-blogmenu />

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="result"></div>
                    <div id="layoutdiv" style="position: absolute; width: 100%;z-index: 999;left: 0px;height:100%;">
                    </div>
                    <div id="getformdata"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <!-- second section -->
    <div class="container  mt-5">
        <div class="row bg-white mx-1">
            <div class="col-12 d-flex justify-content-start align-items-center">
                <p class="m-0 py-3">All Blog Categories</p>
            </div>
        </div><br>
        <div class="row bg-white mx-1 mb-5">
            <div class="col-12">
                <table class="table table-striped mb-5" width="100%">
                    <thead>
                        <tr>
                            <th style="width:10%">Id</th>
                            <th style="width:20%">Title</th>
                            <th style="width:22%">Slug</th>
                            <th style="width:18%">Category</th>
                            <th style="width:32%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogcategory as $blogcategories)
                        <tr>
                            <td> {{ $blogcategories['id'] }}</td>
                            <td> {{ $blogcategories['bcname'] }}</td>
                            <td> {{ $blogcategories['bcslug'] }}</td>
                            <td>
                                <?php 
                                 $data = $blogcategories['bccategory']; 
                                 ?>
                                @foreach($blogcategory as $members)
                                @if($members['id'] == $data)
                                {{ $members['bcname'] }}
                                @endif
                                @endforeach
                            </td>
                            <td class="">
                            <a href="#" class="btn btn-secondary text-white seotag m-1" value="{{ $blogcategories['id'] }}"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                        class="fa-brands fa-searchengin"></i>
                                    SEO</a>
                                <a id="views" href="#" class="btn btn-success text-white reads views"
                                    value="{{ $blogcategories['id'] }}" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"><i class="fa-solid fa-eye"></i> View</a>
                                <a href="#" class="btn btn-warning text-white edit" value="{{ $blogcategories['id'] }}"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" class="btn btn-danger text-white delete"
                                    value="{{ $blogcategories['id'] }}"><i class="fa-solid fa-trash"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

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
            img.width = 150;
            img.classList.add('mb-3');

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
    $(".views").click(function(event) {
        event.preventDefault();
        $('#layoutdiv').show();
        var datas = $(this).attr('value');

        $.ajax({
            type: "GET",
            url: "/admin/edit-blog-categories/" + datas,
            success: function(data) {
                $("#getformdata").html(data);

            }
        });


    });
});
</script>

<script>
$(document).ready(function() {
    $(".edit").click(function(event) {
        event.preventDefault();
        $('#layoutdiv').hide();
        var datas = $(this).attr('value');

        $.ajax({
            type: "GET",
            url: "/admin/edit-blog-categories/" + datas,
            success: function(data) {
                $("#getformdata").html(data);

            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    $(".delete").click(function(event) {
        event.preventDefault();
        $('#layoutdiv').hide();
        var data = confirm("Are You Sure You Want to Delete It?");
        if (data == true) {
            var datas = $(this).attr('value');
            $.ajax({
                type: "DELETE",
                url: "/admin/delete-blog-categories/" + datas,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content') // Include CSRF token for Laravel protection
                },
                success: function(data) {
                    alert("Deleted Successfully!")
                    location.reload();
                },

                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Before Delete Please Remove Category From Blogs");
                }
            });
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $(".seotag").click(function(event) {
        event.preventDefault();
        $('#layoutdiv').hide();
        var datas = $(this).attr('value');
        $.ajax({
            type: "GET",
            url: "/admin/post-cat-seo/" + datas,
            success: function(data) {
                $("#getformdata").html(data);

            }
        });
    });
});
</script>
</body>
@endsection