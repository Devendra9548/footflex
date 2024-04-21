@extends('templates.admin.admin-main')
@section('title')
Add Products
@endsection

@section('customcss')
<link rel="stylesheet" type="text/css" href="/assets/css/admin/rte_theme_default.css">
<link rel="stylesheet" type="text/css" href="/assets/css/admin/blogs.css">
@endsection

@section('body')
<x-admintopheader />
<div class="main-container">
    <x-productmenu />

    <!-- second section -->
    <div class="container mt-5">
        <div class="form">
            <h2>Add New Product</h2>
            <hr><br>
            <form id="addProduct" method="get" action="" enctype="multipart/form-data">
                @csrf
                <label for="p_name">Product Name</label>
                <input type="text" name="p_name" id="p_name" class="form-control py-3 h6" placeholder="Product Name...">
                <br>
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control py-3 h6"
                    placeholder="Slug here... like: /slug/here..">
                <br>
                <label for="p_price">Regular Price</label>
                <input type="number" name="p_price" id="p_price" class="form-control py-3 h6" placeholder="Regular Price">
                <br>
                <label for="r_price">Sale Price</label>
                <input type="number" name="r_price" id="r_price" class="form-control py-3 h6" placeholder="Sale Price">
                <br>
                <label for="p_price">Select Category</label>
                <select name="category_id" id="category" class="form-control py-3 h6" style="margin-bottom:15px">
                    <option value="">Select Category</option>
                    @foreach($members as $members)
                    <option value="{{ $members['id'] }}">{{ $members['category_name'] }}</option>
                    @endforeach
                </select><br>
                <label for="sizes">Select Sizes</label><br>
                <input type="hidden" class="sizes" name="sizes" id="sizes" value="">
                <input type="checkbox" class="form-check-input p-1 border border-dark" id="s" name="s" value="s"
                    onchange="updateInput2(this.value)"> Small
                <input type="checkbox" class="form-check-input p-1 ms-3 border border-dark" id="m" name="m" value="m"
                    onchange="updateInput2(this.value)"> Medium
                <input type="checkbox" class="form-check-input p-1 ms-3 border border-dark" id="l" name="l" value="l"
                    onchange="updateInput2(this.value)"> Large
                <input type="checkbox" class="form-check-input p-1 ms-3 border border-dark" id="xl" name="xl" value="xl"
                    onchange="updateInput2(this.value)"> Extra Large
                <input type="checkbox" class="form-check-input p-1 ms-3 border border-dark" id="xxl" name="xxl"
                    value="xxl" onchange="updateInput2(this.value)"> Double Extra Large
                <br><br><br>
                <label for="div_editor1">Description</label><br>
                <textarea id="div_editor1" name="description"></textarea><br>
                <label for="title" class="h6" style="font-size:22px">Feature Image: (1024 * 576) / (only .webp
                    image)</label>
                <input type="file" class="form-control imageInput" name="file" id="featureImageInput" accept="image/*"
                    onchange="previewImage('featureImageInput', 'featurePreview')">
                <div id="featurePreview" style="width:100%;overflow:hidden;margin-top:20px"></div>
                <br>
                <label for="title" class="h6" style="font-size:22px">Gallery Images</label>
                <div class="d-flex">
                    <div class="filebox me-4 w-100">
                        <input type="file" class="form-control mb-3" name="f1-g1" id="galleryImageInput1"
                            accept="image/*" onchange="previewImage('galleryImageInput1', 'galleryPreview1')">
                        <div id="galleryPreview1" class="mb-3" style="width:100%;overflow:hidden;margin-top:20px"></div>
                    </div>
                    <div class="filebox w-100">
                        <input type="file" class="form-control mb-3" name="f1-g2" id="galleryImageInput2"
                            accept="image/*" onchange="previewImage('galleryImageInput2', 'galleryPreview2')">
                        <div id="galleryPreview2" class="mb-3" style="width:100%;overflow:hidden;margin-top:20px"></div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="filebox me-4 w-100">
                        <input type="file" class="form-control mb-3" name="f1-g3" id="galleryImageInput3"
                            accept="image/*" onchange="previewImage('galleryImageInput3', 'galleryPreview3')">
                        <div id="galleryPreview3" class="mb-3" style="width:100%;overflow:hidden;margin-top:20px"></div>
                    </div>
                    <div class="filebox w-100">
                        <input type="file" class="form-control mb-3" name="f1-g4" id="galleryImageInput4"
                            accept="image/*" onchange="previewImage('galleryImageInput4', 'galleryPreview4')">
                        <div id="galleryPreview4" class="mb-3" style="width:100%;overflow:hidden;margin-top:20px"></div>
                    </div>
                </div>
                <br>
                <hr>
                <div class="d-flex justify-content-between">
                    <label for="title" class="h6" style="font-size:22px">First Color</label>
                    <div class="bothbtn mt-1">
                        <a href="#" class="btn btn-success" id="yes1">Yes</a>
                        <a href="#" class="btn btn-danger" id="no1">No</a>
                    </div>
                </div>
                <div class="hide-1">
                    <input type="file" class="form-control imageInput" name="file1[]" id="featureImageInput5"
                        accept="image/*" onchange="previewImage('featureImageInput5', 'featurePreview5')" multiple>
                    <div id="featurePreview5" style="width:100%;overflow:hidden;margin-top:20px"></div>
                    <br>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <label for="title" class="h6" style="font-size:22px">Second Color</label>
                    <div class="bothbtn mt-1">
                        <a href="#" class="btn btn-success" id="yes2">Yes</a>
                        <a href="#" class="btn btn-danger" id="no2">No</a>
                    </div>
                </div>
                <div class="hide-2">
                    <input type="file" class="form-control imageInput" name="file2[]" id="featureImageInput10"
                        accept="image/*" onchange="previewImage('featureImageInput10', 'featurePreview10')" multiple>
                    <div id="featurePreview10" style="width:100%;overflow:hidden;margin-top:20px"></div>
                    <br>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <label for="title" class="h6" style="font-size:22px">Third Color</label>
                    <div class="bothbtn mt-1">
                        <a href="#" class="btn btn-success" id="yes3">Yes</a>
                        <a href="#" class="btn btn-danger" id="no3">No</a>
                    </div>
                </div>
                <div class="hide-3">
                    <input type="file" class="form-control imageInput" name="file3[]" id="featureImageInput15"
                        accept="image/*" onchange="previewImage('featureImageInput15', 'featurePreview15')" multiple>
                    <div id="featurePreview15" style="width:100%;overflow:hidden;margin-top:20px"></div>
                    <br>
                </div>
                <hr>
                <br>

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
function updateInput2(value) {
    // Get the sizes input element
    var sizesInput = document.getElementById('sizes');

    // Check if the value already exists in sizesInput
    var valuesArray = sizesInput.value.split(',').map(function(item) {
        return item.trim();
    });

    // If the value is not present, append with a comma
    if (!valuesArray.includes(value.trim())) {
        if (sizesInput.value.trim() !== '') {
            sizesInput.value += ', ' + value;
        } else {
            sizesInput.value = value;
        }
    } else {
        // If the value already exists and the user unticks the field, remove it
        var updatedValues = valuesArray.filter(function(item) {
            return item !== value.trim();
        });

        sizesInput.value = updatedValues.join(', ');
    }
}
</script>

<script>
var editor1cfg = {}
editor1cfg.toolbar = "basic";
var editor1 = new RichTextEditor("#div_editor1", editor1cfg);

function previewImage(inputId, previewId) {
    var input = document.getElementById(inputId);
    var preview = document.getElementById(previewId);
    var files = input.files;

    // Check if any file is selected
    if (files.length > 0) {
        preview.innerHTML = ''; // Clear previous previews

        for (var i = 0; i < files.length; i++) {
            var reader = new FileReader();
            var file = files[i];

            // Set up the reader onload event
            reader.onload = function(e) {
                // Create an image element
                var img = new Image();
                img.width = 100;
                img.src = e.target.result;

                // Append the image to the preview div
                preview.appendChild(img);
            };

            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
    } else {
        // If no file is selected, clear the preview
        preview.innerHTML = '';
    }
}


</script>
<script>
$(document).ready(function() {
    $("#addProduct").submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        var ffiles = $('#featureImageInput5')[0].files;
        var sfiles = $('#featureImageInput10')[0].files;
        var tfiles = $('#featureImageInput15')[0].files;

        // Append each file to the FormData object individually
        for (var i = 0; i < ffiles.length; i++) {
            formData.append('file1[]', ffiles[i]);
        }
        for (var i = 0; i < sfiles.length; i++) {
            formData.append('file2[]', sfiles[i]);
        }
        for (var i = 0; i < tfiles.length; i++) {
            formData.append('file3[]', tfiles[i]);
        }

        $.ajax({
            type: "POST",
            url: "/admin/add-product",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res == true) {
                    $("#addProduct")[0].reset();
                    alert("Product added Successfully!");
                    window.location.reload('/admin/add-product');
                } else {
                    alert("Error!" + res);
                }
            }
        });
    });
});
</script>


<script>
$(document).ready(function() {
    $("#yes1").click(function(event) {
        event.preventDefault();
        $(".hide-1").show();
        $('#featureImageInput5').attr('name', 'file1');
        $('#galleryImageInput6').attr('name', 'f1-g1');
        $('#galleryImageInput7').attr('name', 'f1-g2');
        $('#galleryImageInput8').attr('name', 'f1-g3');
        $('#galleryImageInput9').attr('name', 'f1-g4');
    });
    $("#no1").click(function(event) {
        event.preventDefault();
        $(".hide-1").hide();
        $('#featureImageInput5').attr('name', 'filedraft');
        $('#galleryImageInput6').attr('name', 'filedraft');
        $('#galleryImageInput7').attr('name', 'filedraft');
        $('#galleryImageInput8').attr('name', 'filedraft');
        $('#galleryImageInput9').attr('name', 'filedraft');
    });
    $("#yes2").click(function(event) {
        event.preventDefault();
        $(".hide-2").show();
        $('#featureImageInput10').attr('name', 'file2');
        $('#galleryImageInput11').attr('name', 'f2-g1');
        $('#galleryImageInput12').attr('name', 'f2-g2');
        $('#galleryImageInput13').attr('name', 'f2-g3');
        $('#galleryImageInput14').attr('name', 'f2-g4');
    });
    $("#no2").click(function(event) {
        event.preventDefault();
        $(".hide-2").hide();
        $('#featureImageInput10').attr('name', 'filedraft');
        $('#galleryImageInput11').attr('name', 'filedraft');
        $('#galleryImageInput12').attr('name', 'filedraft');
        $('#galleryImageInput13').attr('name', 'filedraft');
        $('#galleryImageInput14').attr('name', 'filedraft');
    });
    $("#yes3").click(function(event) {
        event.preventDefault();
        $('#featureImageInput15').attr('name', 'file3');
        $('#galleryImageInput16').attr('name', 'f3-g1');
        $('#galleryImageInput17').attr('name', 'f3-g2');
        $('#galleryImageInput18').attr('name', 'f3-g3');
        $('#galleryImageInput19').attr('name', 'f3-g4');
        $(".hide-3").show();
    });
    $("#no3").click(function(event) {
        event.preventDefault();
        $(".hide-3").hide();
        $('#featureImageInput15').attr('name', 'filedraft');
        $('#galleryImageInput16').attr('name', 'filedraft');
        $('#galleryImageInput17').attr('name', 'filedraft');
        $('#galleryImageInput18').attr('name', 'filedraft');
        $('#galleryImageInput19').attr('name', 'filedraft');
    });
});
</script>

<script>
$(document).ready(function() {
    $('#no1').on('click', function() {
        // Change the name attribute of the file input
        $('#featureImageInput5').attr('name', 'filedraft');
    });
});
</script>

@endsection

