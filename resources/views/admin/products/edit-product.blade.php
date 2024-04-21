@section('customcss')
<link rel="stylesheet" type="text/css" href="/assets/css/admin/rte_theme_default.css">
<link rel="stylesheet" type="text/css" href="/assets/css/admin/blogs.css">
@endsection

<form action="" id="addBlog" enctype="multipart/form-data" class="edit-blogs">
    @csrf
    <input type="hidden" name="id" id="hiddenid" value="{{ $members->id }}">
    <label for="p_name"><b>Product Name</b></label>
    <input type="text" name="p_name" id="p_name" class="form-control py-3 h6" placeholder="Product Name..."
        value="{{ $members->p_name }}">
    <br>
    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" class="form-control py-3 h6" placeholder="Slug here... like: /slug/here.."
        value="{{ $members->slug }}">
    <br>
    <label for="p_price">Offer Price</label>
    <input type="number" name="p_price" id="p_price" class="form-control py-3 h6" placeholder="Offer Price"  value="{{ $members->p_price }}">
    <br>
    <label for="r_price">Regular Price</label>
    <input type="number" name="r_price" id="r_price" class="form-control py-3 h6" placeholder="Regular Price"  value="{{ $members->r_price }}">
    <br>
    <label>Default Sizes : <b style="text-transform:uppercase">{{$members->sizes}}</b></label><br><br>
    <label for="sizes">Change Sizes</label><br>
    <input type="hidden" class="sizes" name="sizes" id="sizes" value=""><br>
    <input type="checkbox" class="form-check-input p-1 border border-dark" id="s" name="s" value="s"
        onchange="updateInput2(this.value)"> Small
    <input type="checkbox" class="form-check-input p-1 ms-3 border border-dark" id="m" name="m" value="m"
        onchange="updateInput2(this.value)"> Medium
    <input type="checkbox" class="form-check-input p-1 ms-3 border border-dark" id="l" name="l" value="l"
        onchange="updateInput2(this.value)"> Large
    <input type="checkbox" class="form-check-input p-1 ms-3 border border-dark" id="xl" name="xl" value="xl"
        onchange="updateInput2(this.value)"> Extra Large
    <input type="checkbox" class="form-check-input p-1 ms-3 border border-dark" id="xxl" name="xxl" value="xxl"
        onchange="updateInput2(this.value)"> Double Extra Large
    <br><br><br>
    <label for="div_editor1">Description</label><br>
    <textarea id="div_editor1" name="description">{{ $members->description }}</textarea><br>
    <label for="title" class="h6" style="font-size:22px">Feature Image: (1024 * 576) / (only .webp
        image) (If you update any one then you need to change also gallery images in below.)</label>
    <input type="file" class="form-control imageInput" name="file" id="featureImageInput" accept="image/*"
        onchange="previewImage('featureImageInput', 'featurePreview')">
    <div id="featurePreview" style="width:100%;overflow:hidden;margin-top:20px">
        <?php 
      $imageArray = json_decode($members->p_image, true);
    ?>
        <input type="hidden" name="cfile1" value="{{ $imageArray[0] }}" />
        <img src="/recent-products-thumb/{{ $imageArray[0] }}" alt="">
    </div>

    <br>
    <label for="title" class="h6" style="font-size:22px">Gallery Images</label>
    <div class="d-flex">
        <div class="filebox me-4 w-100">
            <input type="file" class="form-control mb-3" name="f1_g1" id="galleryImageInput1" accept="image/*"
                onchange="previewImage('galleryImageInput1', 'galleryPreview1')">
            <div id="galleryPreview1" class="mb-3" style="width:100%;overflow:hidden;margin-top:20px">
                <input type="hidden" name="cfile2" value="{{ $imageArray[1] }}" />
                <img src="/recent-products-thumb/{{ $imageArray[1] }}" alt="">
            </div>
        </div>
        <div class="filebox w-100">
            <input type="file" class="form-control mb-3" name="f1_g2" id="galleryImageInput2" accept="image/*"
                onchange="previewImage('galleryImageInput2', 'galleryPreview2')">
            <div id="galleryPreview2" class="mb-3" style="width:100%;overflow:hidden;margin-top:20px">
                <input type="hidden" name="cfile3" value="{{ $imageArray[2] }}" />
                <img src="/recent-products-thumb/{{ $imageArray[2] }}" alt="">
            </div>
        </div>
    </div>
    <div class="d-flex">
        <div class="filebox me-4 w-100">
            <input type="file" class="form-control mb-3" name="f1_g3" id="galleryImageInput3" accept="image/*"
                onchange="previewImage('galleryImageInput3', 'galleryPreview3')">
            <div id="galleryPreview3" class="mb-3" style="width:100%;overflow:hidden;margin-top:20px">
                <input type="hidden" name="cfile4" value="{{ $imageArray[3] }}" />
                <img src="/recent-products-thumb/{{ $imageArray[3] }}" alt="">
            </div>
        </div>
        <div class="filebox w-100">
            <input type="file" class="form-control mb-3" name="f1_g4" id="galleryImageInput4" accept="image/*"
                onchange="previewImage('galleryImageInput4', 'galleryPreview4')">
            <div id="galleryPreview4" class="mb-3" style="width:100%;overflow:hidden;margin-top:20px">
                <input type="hidden" name="cfile5" value="{{ $imageArray[4] }}" />
                <img src="/recent-products-thumb/{{ $imageArray[4] }}" alt="">
            </div>
        </div>
    </div>
    <input type="hidden" name="cp_image" value="{{ $members->p_image }}">
    <br>
    <hr>
    <div class="d-flex justify-content-between">
        <label for="title" class="h6" style="font-size:22px">First Color (Select 5 Images)</label>
        <div class="bothbtn mt-1">
            <a href="#" class="btn btn-success" id="yes1">Yes</a>
            <a href="#" class="btn btn-danger" id="no1">No</a>
        </div>
    </div>
    <div class="hide-1" style="margin-top:20px">
        <input type="file" class="form-control imageInput" name="file1[]" id="featureImageInput5" accept="image/*"
            onchange="previewImage('featureImageInput5', 'featurePreview5')" multiple>
        <?php 
            $firstGallery = json_decode($members->p_image_first, true);
            ?>
        <div id="featurePreview5" style="width:100%;overflow:hidden;margin-top:20px">
            <img src="/recent-products-thumb/{{ $firstGallery[0] }}" alt="">
            <img src="/recent-products-thumb/{{ $firstGallery[1] }}" alt="">
            <img src="/recent-products-thumb/{{ $firstGallery[2] }}" alt="">
            <img src="/recent-products-thumb/{{ $firstGallery[3] }}" alt="">
            <img src="/recent-products-thumb/{{ $firstGallery[4] }}" alt="">

        </div>
        <br>
        <input type="hidden" name="cfirstgallery" value="{{ $members->p_image_first }}" />
    </div>
    <hr>
    <div class="d-flex justify-content-between">
        <label for="title" class="h6" style="font-size:22px">Second Color</label>
        <div class="bothbtn mt-1">
            <a href="#" class="btn btn-success" id="yes2">Yes</a>
            <a href="#" class="btn btn-danger" id="no2">No</a>
        </div>
    </div>
    <div class="hide-2" style="margin-top:20px">
        <input type="file" class="form-control imageInput" name="file2[]" id="featureImageInput10" accept="image/*"
            onchange="previewImage('featureImageInput10', 'featurePreview10')" multiple>
        <div id="featurePreview10" style="width:100%;overflow:hidden;margin-top:20px">
            <?php 
            $secondGallery = json_decode($members->p_image_second, true);
        ?>
            <img src="/recent-products-thumb/{{ $secondGallery[0] }}" alt="">
            <img src="/recent-products-thumb/{{ $secondGallery[1] }}" alt="">
            <img src="/recent-products-thumb/{{ $secondGallery[2] }}" alt="">
            <img src="/recent-products-thumb/{{ $secondGallery[3] }}" alt="">
            <img src="/recent-products-thumb/{{ $secondGallery[4] }}" alt="">
        </div>
        <br>
        <input type="hidden" name="csecondgallery" value="{{ $members->p_image_second }}" />
    </div>
    <hr>
    <div class="d-flex justify-content-between">
        <label for="title" class="h6" style="font-size:22px">Third Color</label>
        <div class="bothbtn mt-1">
            <a href="#" class="btn btn-success" id="yes3">Yes</a>
            <a href="#" class="btn btn-danger" id="no3">No</a>
        </div>
    </div>
    <div class="hide-3" style="margin-top:20px">
        <input type="file" class="form-control imageInput" name="file3[]" id="featureImageInput15" accept="image/*"
            onchange="previewImage('featureImageInput15', 'featurePreview15')" multiple>
        <div id="featurePreview15" style="width:100%;overflow:hidden;margin-top:20px">
            <?php 
            $thirdGallery = json_decode($members->p_image_third, true);
        ?>
            <img src="/recent-products-thumb/{{ $thirdGallery[0] }}" alt="">
            <img src="/recent-products-thumb/{{ $thirdGallery[1] }}" alt="">
            <img src="/recent-products-thumb/{{ $thirdGallery[2] }}" alt="">
            <img src="/recent-products-thumb/{{ $thirdGallery[3] }}" alt="">
            <img src="/recent-products-thumb/{{ $thirdGallery[4] }}" alt="">
        </div>
    </div>
    <br>
    <input type="hidden" name="cthirdgallery" value="{{ $members->p_image_third }}" />
    </div>
    <hr>
    <br>
    <label for="category" class="fw-bold fs-4 mb-2">Select Category</label>
    <select name="category_id" id="" class="form-control">
        <option value="{{ $members->category_id }}">
            @foreach($allcats as $allcats)
            @if($allcats['id'] == $members->category_id)
            {{ $allcats['category_name'] }}
            @endif
            @endforeach
        </option>
        @foreach($cats as $cat)
        <option value="{{ $cat['id'] }}">{{ $cat['category_name'] }}</option>
        @endforeach
    </select><br>
    <div class="fixedbtn-2">
        <input type="submit" class="btn btn-primary read-btn" value="Update Product">
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
            url: "/admin/update-product",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res == true) {
                    $("#addBlog")[0].reset();
                    alert("Product updated successfully!");
                    window.location.reload();
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