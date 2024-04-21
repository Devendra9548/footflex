@extends('templates.admin.admin-main')
@section('title')
Admin Information
@endsection

@section('body')
<x-admintopheader/>
<div class="main-container">
  <div class="container">
    <div class="row">
    <div class="col-12 mb-5">
                <h2>User Information</h2><hr>
                <form class="mb-5 mt-3" id="admininfo" action="">
                  @csrf
                    <div class="mb-4">
                    <input type="hidden" name="id" id="hiddenid" value="{{ $admin->id }}">
                        <label for="username" class="form-label"><b>Username</b></label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $admin->username }}">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label"><b>Password</b></label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ $admin->password }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        $("#admininfo").submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            var hiddenid = document.querySelector("#hiddenid").value;
            $.ajax({
                type: "POST",
                url: "/admin/admin-info",
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res == true) {
                        $("#admininfo")[0].reset();
                        alert("admin info updated successfully!");
                        window.location.reload('/admin/admin-info');
                    } else {
                        alert("Error!"+res);
                    }
                }
            });
        });
    });
    </script>
</body>
@endsection
