@extends('templates.admin.admin-main')
@section('title')
All Orders
@endsection

@section('customcss')
<link rel="stylesheet" type="text/css" href="/assets/css/admin/rte_theme_default.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('body')
<x-admintopheader />
<div class="main-container">
    <x-ordermenu />

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer Actions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background: #e5e5e5;">
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
    <div class="container mt-5">
        <div class="row bg-white mx-1">
            <div class="col-6 d-flex justify-content-start align-items-center">
                <p class="m-0 py-3 fs-5 fw-bold"> All Customers</p>
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center">
               
            </div>
        </div><br>
        <div class="row bg-white mx-1">
            <div class="col-12">
                <table class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Customer Username</th>
                            <th>Customer Email</th>
                            <th>Customer Phone Number</th>
                            <th>Customer Password</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($customers as $customer)
                           <tr>
                              <td class="">#{{ $customer->id }}</td>
                              <td class="">{{ $customer->username }}</td>
                              <td>{{ $customer->email }}</td>
                              <td class="">{{ $customer->p_number }}</td>
                              <td class="">{{ $customer->password }}</td>
                              <td>
                                <a href="/admin/delete-customers/{{ $customer->id }}" class="btn btn-danger delete" value="{{ $customer->id }}">Delete</a>
                              </td>
                           </tr>
                        @endforeach
                    </thead>
                  
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
    $(".delete").click(function(event) {
        event.preventDefault();
        var data = confirm("Are You Sure You Want to Delete It?");
        if (data == true) {
            var datas = $(this).attr('value');
            $.ajax({
                type: "DELETE",
                url: "/admin/delete-customers/" + datas,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content') 
                },
                success: function(data) {
                    alert("Delete Customer Successfully!")
                    window.location="/admin/all-customers";
                },

                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Before Delete Customer Please Remove Category From Customer");
                }
            });
        }
    });
});
</script>
</body>
@endsection