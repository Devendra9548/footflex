<form action="" id="addseotag">
    @csrf
    <input type="hidden" id="hiddenid" name="id" value="{{ $members->id }}">
    <div class="mb-3">
        <label for="pagename" class="form-label"><b>Page Name:</b></label>
        <input type="text" class="form-control" id="pagename" placeholder="Page Name" name="pagename"
            value="{{ $members->pagename }}">
    </div>

    <div class="mb-3 mt-3">
        <label for="slug" class="form-label"><b>Page Slug:</b></label>
        <input type="text" class="form-control" id="slug" placeholder="Page Slug" name="slug"
            value="{{ $members->slug }}">
    </div>

    <div class="mb-3 mt-3">
        <label for="title" class="form-label"><b>Title:</b></label>
        <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title"
            value="{{ $members->title }}">
    </div>

    <div class="mb-3">
        <label for="pwd" class="form-label"><b>Description:</b></label>
        <textarea class="form-control" rows="5" id="description"
            name="description">{{ $members->description }}</textarea>
    </div>

    <div class="mb-3">
        <label for="pwd" class="form-label"><b>Keywords:</b></label>
        <textarea class="form-control" rows="5" id="keywords" name="keywords">{{ $members->keywords }}</textarea>
    </div>

    <div class="mb-3">
    <label for="file" class="form-label"><b>Feature Image:(1024 * 576) / (only .webp image)</b></label>
        <input type="file" class="form-control" name="file" id="imageInput" accept="image/*" onchange="previewImage()">
        <div id="preview" style="width:100%;overflow:hidden;margin-top:20px">
        <img src="/pages/{{ $members->file }}" alt="" width="150px" class="mb-3">
        </div>
    </div>

    <div class="mb-3 mt-3">
        <label for="title" class="form-label"><b>Author:</b></label>
        <input type="text" class="form-control" id="author" placeholder="Author Name" name="author"
            value="{{ $members->author }}">
    </div>

    <div class="mb-3 mt-3">
        <label for="title" class="form-label"><b>Schema Markup:</b></label>
        <textarea class="form-control" rows="5" id="smarkup" name="smarkup" placeholder="<script> Add script here... </script>">{{ $members->smarkup }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Update Data</button>
</form>
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
            img.width = 150;


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
    $("#addseotag").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/admin/update-page",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                $("#addseotag")[0].reset();
                alert("Page Seo updated successfully!");
                window.location.reload('/admin/page-seo');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Error: "+textStatus);
            }
        });
    });
});
</script>