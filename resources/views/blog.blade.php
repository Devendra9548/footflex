@extends('templates.front.main')
@section('customcss')
<link rel="stylesheet" href="/assets/css/front/blog.css">
@endsection
@section('body')
<div class="container-fluid breadcrumbs">
    <div class="container">
    <div class="row">
        <div class="col-12">
            <p style="margin:0px" class="py-3"><a href="/">Home</a> » <a href="#">Our Blogs</a></p>
        </div>
    </div>
    </div>
</div>
<section>
    <div class="container mt-5">
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-12 col-md-3 mb-3">
                <div class="blog-single"><a href="/blog/{{ $blog->slug }}">
                        <img src="/blogs-thumb/{{ $blog->file }}" alt="{{ $blog->file }}" width="100%"
                            class="img-thumbnail" style="height: 238px !important;object-fit: cover!important;">
                        <p class="fs-5 text-center">{{ $blog->title }}</p>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
        <div id="navMenu" class="mt-5 text-center">
            @if($blogs->lastPage() > 1)
            {{ $blogs->links() }}
            @endif
        </div>
    </div>
</section>
@endsection