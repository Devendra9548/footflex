<div class="form">
            <h2>Add New Blog</h2><hr><br>
            <form id="addpage" action="">
                @csrf
                <input type="text" name="pagename" class="form-control py-3 h6" placeholder="Page Name For SEO">
                <br>
                <input type="text" name="slug" class="form-control py-3 h6" placeholder="Slug here... like: /slug/here..">
                <br>
                <input type="submit" class="btn btn-primary" value="Create Page">
                
            </form>
            <br>
</div>
<script>
    $(document).ready(function() {
        $("#addpage").submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
  
            $.ajax({
                type: "POST",
                url: "/admin/add-page",
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res == true) {
                        $("#addpage")[0].reset();
                        alert("Page added successfully!");
                        window.location.reload('/admin/page-seo');
                    } else {
                        alert("Error!"+res);
                    }
                }
            });
        });
    });
</script>    
