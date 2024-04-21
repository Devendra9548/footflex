@extends('templates.admin.admin-main')
@section('title')
Pages Seo
@endsection

@section('body')
<x-admintopheader />
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Page Model</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id="getformdata" class="m-4"></div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="fs-3">Pages: <a href="#" class="btn btn-dark addpage" data-bs-toggle="modal" data-bs-target="#exampleModal"> Add New Page</a></p>
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Page Name</th>
                            <th>Slug</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->pagename}}</td>
                            <td>{{$data->slug}}</td>
                            <td>{{$data->title}}</td>
                            <td>{{$data->author}}</td>
                            <td>{{$data->updated_at}}</td>
                            <td class="">
                                <a href="#" class="btn btn-dark text-white edit" value="{{ $data->id }}"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                        class="fa-solid fa-pen-to-square"></i>
                                    SEO</a> 
                                <a id="views" target="_blank" href="/{{ $data->slug }}" class="btn btn-success text-white reads views"><i
                                        class="fa-solid fa-eye"></i> View</a>
                                <a href="#" class="btn btn-danger text-white delete" value="{{ $data->id }}"><i
                                        class="fa-solid fa-trash"></i> </a>
                            </td>
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
    $(".addpage").click(function(event) {
        event.preventDefault();
        $.ajax({
            type: "GET",
            url: "/admin/add-page",
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
        var datas = $(this).attr('value');

        $.ajax({
            type: "GET",
            url: "/admin/edit-page/" + datas,
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
        var datas = $(this).attr('value');

        $.ajax({
            type: "GET",
            url: "/admin/delete-page/" + datas,
            success: function(data) {
               alert("Delete Page Successfully!");
               window.location.reload('/admin/page-seo');
            }
        });
    });
});
</script>
</body>
@endsection