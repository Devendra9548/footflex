<form action="" id="addseotag">
  @csrf
  <input type="hidden" id="hiddenid" name="blogid" value="{{ $blogid }}">
  <div class="mb-3 mt-3">
    <label for="title" class="form-label"><b>Title:</b></label>
    <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" value="{{ $members->title }}">
  </div>
  
  <div class="mb-3">
    <label for="pwd" class="form-label"><b>Description:</b></label>
    <textarea class="form-control" rows="5" id="description" name="description">{{ $members->description }}</textarea>
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label"><b>Keywords:</b></label>
    <textarea class="form-control" rows="5" id="keywords" name="keywords">{{ $members->keywords }}</textarea>
  </div>
  <div class="mb-3 mt-3">
    <label for="title" class="form-label"><b>Author:</b></label>
    <input type="text" class="form-control" id="author" placeholder="Author Name" name="author" value="{{ $members->author }}">
  </div>
  <div class="mb-3">
    <label for="smarkup" class="form-label"><b>Schema Markup:</b></label>
    <textarea class="form-control" rows="5" id="smarkup" name="smarkup" placeholder="<script> Add script here... </script>">{{ $members->smarkup }}</textarea>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    $(document).ready(function() {
        $("#addseotag").submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            var hiddenid = document.querySelector("#hiddenid").value;
            $.ajax({
                type: "POST",
                url: "/admin/post-cat-seo",
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                     $("#addseotag")[0].reset();
                     alert("Seo updated successfully!");
                     window.location.reload('/admin/all-blogs');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Before Delete Please Remove Category From Blogs");
                }
            });
        });
    });
    </script>



