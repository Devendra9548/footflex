@extends('templates.admin.admin-main')
@section('title')
Global SEO
@endsection

@section('body')
<x-admintopheader />
<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                <form class="mb-5" action="" id="globalseo">
                    @csrf
                    <div class="mb-4">
                        <input type="hidden" name="id" id="hiddenid" value="{{ $gseo->id }}">
                        <label for="sitename" class="form-label"><b>Site Name</b></label>
                        <input type="text" class="form-control" id="sitename" name="sitename"
                            placeholder="URL like: https://socialmedianame.com " value="{{ $gseo->sitename }}">
                    </div>
                    <div class="mb-4">
                        <label for="facebook" class="form-label"><b>Facebook URL</b></label>
                        <input type="text" class="form-control" id="facebook" name="facebook"
                            placeholder="URL like: https://socialmedianame.com " value="{{ $gseo->facebook }}">
                    </div>
                    <div class="mb-4">
                        <label for="youtube" class="form-label"><b>YouTube URL</b></label>
                        <input type="text" class="form-control" id="youtube" name="youtube"
                            placeholder="URL like: https://socialmedianame.com " value="{{ $gseo->youtube }}">
                    </div>
                    <div class="mb-4">
                        <label for="instagram" class="form-label"><b>Instagram URL</b></label>
                        <input type="text" class="form-control" id="instagram" name="instagram"
                            placeholder="URL like: https://socialmedianame.com " value="{{ $gseo->instagram }}">
                    </div>
                    <div class="mb-4">
                        <label for="twitter" class="form-label"><b>Twitter URL</b></label>
                        <input type="text" class="form-control" id="twitter" name="twitter"
                            placeholder="URL like: https://socialmedianame.com " value="{{ $gseo->twitter }}">
                    </div>
                    <div class="mb-4">
                        <label for="linkedin" class="form-label"><b>LinkedIn URL</b></label>
                        <input type="text" class="form-control" id="linkedin" name="linkedin"
                            placeholder="URL like: https://socialmedianame.com " value="{{ $gseo->linkedin }}">
                    </div>
                    <div class="mb-4">
                        <label for="whatsapp" class="form-label"><b>WhatsApp Number</b></label>
                        <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                            placeholder="Phone Number like: +919998909098 " value="{{ $gseo->whatsapp }}">
                    </div>
                    <div class="mb-4">
                        <label for="pinterest" class="form-label"><b>Pinterest URL</b></label>
                        <input type="text" class="form-control" id="pinterest" name="pinterest"
                            placeholder="URL like: https://socialmedianame.com " value="{{ $gseo->pinterest }}">
                    </div>
                    <div class="mb-4">
                        <label for="globalheader" class="form-label"><b>Global Header</b></label>
                        <textarea class="form-control" rows="5" id="globalheader" name="globalheader"
                            placeholder="like: <script> alert('hello world') </script>">{{ $gseo->globalheader }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="gfbs" class="form-label"><b>Global Footer Before Script</b></label>
                        <textarea class="form-control" rows="5" id="gfbs" name="gfbs"
                            placeholder="like: <script> alert('hello world') </script>">{{ $gseo->gfbs }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="gfas" class="form-label"><b>Global Footer After Script</b></label>
                        <textarea class="form-control" rows="5" id="gfas" name="gfas"
                            placeholder="like: <script> alert('hello world') </script>">{{ $gseo->gfas }}</textarea>
                    </div>
                    <div class="fixedbtn">
                        <button type="submit" class="btn btn-primary">Save Changes !</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $("#globalseo").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var hiddenid = document.querySelector("#hiddenid").value;
        $.ajax({
            type: "POST",
            url: "/admin/global-seo",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res == true) {
                    $("#globalseo")[0].reset();
                    alert("Global SEO updated successfully!");
                    window.location.reload('/admin/global-seo');
                } else {
                    alert("Error!" + res);
                }
            }
        });
    });
});
</script>
</body>
@endsection