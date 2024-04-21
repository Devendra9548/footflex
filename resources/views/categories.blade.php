@extends('templates.front.main')
@section('body')
<div class="container-fluid bg-dark breadcrumbs">
    <div class="container">
    <div class="row">
        <div class="col-12">
            <p style="margin:0px" class="py-3"><a href="/">Home</a> » <a href="#">Our Categories</a></p>
        </div>
    </div>
    </div>
</div>
<section>
    <div class="container">
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-12 col-md-3">
                <div class="blog-single"><a href="/categories/{{ strtolower($blog->bcslug) }}">
                        <img src="/blogs/{{ $blog->bcfile }}" alt="{{ $blog->bcfile }}" width="100%"
                            class="img-thumbnail">
                        <p class="fs-4 text-center">{{ $blog->bcname }}</p>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endsection