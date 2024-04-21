@extends('templates.front.main')

@section('body')
<div class="container-fluid bg-dark breadcrumbs">
    <div class="container">
    <div class="row">
        <div class="col-12">
            <p style="margin:0px" class="py-3"><a href="/">Home</a> » <a href="#">404 Page</a></p>
        </div>
    </div>
    </div>
</div>
<div class="container my-5 text-center">
  <h1 style="font-size:55px" class="text-center mt-5">404 Page Not Found</h1>
  <a href="/" class="btn btn-light text-dark fs-2 text-center mt-3 mb-5">Back to Home Page <i class="fa-solid fa-up-right-from-square"></i></a>
</div>
@endsection