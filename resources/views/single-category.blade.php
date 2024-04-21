@extends('templates.front.singlecatblog')

@section('body')
<div class="container-fluid bg-dark breadcrumbs">
    <div class="container">
    <div class="row">
        <div class="col-12">
            <p style="margin:0px" class="py-3"><a href="/">Home</a> » <a href="#">{{ $cblog[0]->bcname }}</a></p>
        </div>
    </div>
    </div>
</div>
<section>

<div class="container">
    <div class="row">
        @foreach($cblog as $blog)
        <div class="col-3">
            <div class="blog-single"><a href="/blog/{{ $blog->slug }}">
                    <img src="/blogs-thumb/{{ $blog->file }}" alt="{{ $blog->file }}" width="100%" class="img-thumbnail">
                    <p class="fs-4 text-left">{{ $blog->title }}</p>
                </a>
            </div>
        </div>
        @endforeach

    </div>
</div>
</section>
@endsection