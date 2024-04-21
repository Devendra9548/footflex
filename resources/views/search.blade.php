<!DOCTYPE html>
<html lang="en">

<head>
    <title>Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="/assets/css/front/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/front/header.css">
    <link rel="stylesheet" href="/assets/css/front/footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <x-header />
    <div class="container-fluid bg-dark breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p style="margin:0px" class="py-3"><a href="#" class="fs-3">Search Results For : {{ $result }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            @foreach($blog as $blog)
            <div class="col-12 col-md-3 mb-3">
                <div class="">
                    <a href="/blog/{{ $blog->slug }}">
                        <img src="/blogs-thumb/{{ $blog->file }}" alt="{{ $blog->file }}" width="100%"
                            class="img-thumbnail">
                        <p class="fs-4 text-center">{{ $blog->title }}</p>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <x-footer />

    <script type="text/javascript" src="/assets/js/front/footer.js"></script>
    @yield('customjs')

</body>

</html>


