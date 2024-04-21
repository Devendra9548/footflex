@extends('templates.admin.admin-main')
@section('title')
All memberss
@endsection

@section('customcss')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('body')
<x-admintopheader />
<div class="main-container">

    <!-- second section -->
    <div class="container mt-5">
     
        <div class="row bg-white mx-1">
            <div class="col-12">
                <table class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $members)
                        <tr>
                            <td> {{ $members->id }}</td>
                            <td> {{ $members->fullname }}</td>
                            <td> {{ $members->email }}</td>
                            <td> {{ $members->phone }}</td>
                            <td> {{ $members->message }}</td>
                            <td> <a href="#" class="btn btn-danger delete" value="{{ $members->id }}">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<script>
$(document).ready(function() {
    $(".delete").click(function(event) {
        event.preventDefault();
        var data = confirm("Are You Sure You Want to Delete It?");
        if (data == true) {
            var datas = $(this).attr('value');
            $.ajax({
                type: "DELETE",
                url: "/admin/delete-contact/" + datas,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content') // Include CSRF token for Laravel protection
                },
                success: function(data) {
                    alert("Deleted Successfully!")
                    location.reload();
                },

                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Before Delete Please Remove Category From memberss");
                }
            });
        }
    });
});
</script>
</body>
@endsection