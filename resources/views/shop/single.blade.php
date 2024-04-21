<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $product->p_name }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/front/header.css">
    <link rel="stylesheet" href="/assets/css/front/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/front/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="/assets/css/slick.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/front/single-product.css" />



    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {

        $('.slideshow-thumbnails').hover(function() {
            changeSlide($(this));
        });

        $(document).mousemove(function(e) {
            var x = e.clientX;
            var y = e.clientY;

            var x = e.clientX;
            var y = e.clientY;

            var imgx1 = $('.slideshow-items.active').offset().left;
            var imgx2 = $('.slideshow-items.active').outerWidth() + imgx1;
            var imgy1 = $('.slideshow-items.active').offset().top;
            var imgy2 = $('.slideshow-items.active').outerHeight() + imgy1;

            if (x > imgx1 && x < imgx2 && y > imgy1 && y < imgy2) {
                $('#lens').show();
                $('#result').show();
                imageZoom($('.slideshow-items.active'), $('#result'), $('#lens'));
            } else {
                $('#lens').hide();
                $('#result').hide();
            }

        });



        function imageZoom(img, result, lens) {

            result.width(img.innerWidth());
            result.height(img.innerHeight());
            lens.width(img.innerWidth() / 2);
            lens.height(img.innerHeight() / 2);

            result.offset({
                top: img.offset().top,
                left: img.offset().left + img.outerWidth() + 50
            });

            var cx = img.innerWidth() / lens.innerWidth();
            var cy = img.innerHeight() / lens.innerHeight();

            result.css('backgroundImage', 'url(' + img.attr('src') + ')');
            result.css('backgroundSize', img.width() * cx + 'px ' + img.height() * cy + 'px');

            lens.mousemove(function(e) {
                moveLens(e);
            });
            img.mousemove(function(e) {
                moveLens(e);
            });
            lens.on('touchmove', function() {
                moveLens();
            })
            img.on('touchmove', function() {
                moveLens();
            })

            function moveLens(e) {
                var x = e.clientX - lens.outerWidth() / 2;
                var y = e.clientY - lens.outerHeight() / 2;
                if (x > img.outerWidth() + img.offset().left - lens.outerWidth()) {
                    x = img.outerWidth() + img.offset().left - lens.outerWidth();
                }
                if (x < img.offset().left) {
                    x = img.offset().left;
                }
                if (y > img.outerHeight() + img.offset().top - lens.outerHeight()) {
                    y = img.outerHeight() + img.offset().top - lens.outerHeight();
                }
                if (y < img.offset().top) {
                    y = img.offset().top;
                }
                lens.offset({
                    top: y,
                    left: x
                });
                result.css('backgroundPosition', '-' + (x - img.offset().left) * cx + 'px -' + (y - img.offset()
                        .top) * cy +
                    'px');
            }
        }


        function changeSlide(elm) {
            $('.slideshow-items').removeClass('active');
            $('.slideshow-items').eq(elm.index()).addClass('active');
            $('.slideshow-thumbnails').removeClass('active');
            $('.slideshow-thumbnails').eq(elm.index()).addClass('active');
        }

    });
    </script>

</head>

<body class="single-product-page">
    <x-header />
    <?php
     $valData = '0';
                if (isset($_GET['color'])) {
                    $valData = $_GET['color'];
                    if($valData == 3)
                    {
                        unset($mainimage);
                        $mainimage = $thirdimage;
                    }

                    if($valData == 1)
                    {
                        unset($mainimage);
                        $mainimage = $firstimage;
                    }
                    if($valData == 2)
                    {
                        unset($mainimage);
                        $mainimage = $secondimage;
                    }
                }
    ?>
    <div class="container-fluid mt-4 main-content">
        <form action="" id="singleProduct">
            @csrf
            <input type="hidden" value="{{ $product->slug }}" id="slug">
            <input type="hidden" name="color" value="{{ $valData }}">
            <input type="hidden" name="pid" value="{{ $product->id }}">
            <input type="hidden" name="catname" value="{{ $member->category_name}}">
            <div class="row row-2 mb-3">
                <div class="col-12">
                    <p><a href="#">Home</a> /<a href="#"> Shop / </a><a href="#">{{ $product->p_name }}</a>{{ session('pcolor') }}</p>
                </div>
            </div>
            <div class="row row-2">
                <div class="col-1">
                    <img src="/recent-products-thumb/{{ $mainimage[0] }}" alt="Main Image" id="mainImage"
                        class="slideshow-thumbnails active" width="100%">
                    <img src="/recent-products-thumb/{{ $mainimage[1] }}" alt="Main Image" id="mainImage"
                        class="slideshow-thumbnails" width="100%">
                    <img src="/recent-products-thumb/{{ $mainimage[2] }}" alt="Main Image" id="mainImage"
                        class="slideshow-thumbnails" width="100%">
                    <img src="/recent-products-thumb/{{ $mainimage[3] }}" alt="Main Image" id="mainImage"
                        class="slideshow-thumbnails" width="100%">
                    <img src="/recent-products-thumb/{{ $mainimage[4] }}" alt="Main Image" id="mainImage"
                        class="slideshow-thumbnails" width="100%">
                </div>
                <div class="col-4">

                    <div id='lens'></div>

                    <div id='slideshow-items-container'>

                        <img class='slideshow-items active' src='/products/{{ $mainimage[0] }}' />
                        <img class='slideshow-items' src='/products/{{ $mainimage[1] }}' />
                        <img class='slideshow-items' src='/products/{{ $mainimage[2] }}' />
                        <img class='slideshow-items' src='/products/{{ $mainimage[3] }}' />
                        <img class='slideshow-items' src='/products/{{ $mainimage[4] }}' />

                    </div>

                    <div id='result'></div>

                </div>

                <div class="col-4">
                    <h2 class="product-category">{{ $member->category_name}}</h2>
                    <p class="product-name">{{ $product->p_name }}</p>
                    <hr>
                    <p class="price">₹{{ $product->r_price }} <span><del>MRP ₹{{ $product->p_price }}</del>
                            (<?php
                      $actval = $product->p_price; // 12000
                      $relval = $product->r_price; // 11000
                      $percentage = ($relval * 100)/$actval;
                      echo (int)(100-$percentage); 
                    ?>
                            % OFF)
                        </span></p>
                    <span style="color:green">inclusive of all taxes</span>
                    <p class="mt-4 mb-2"><b>More Colors</b></p>
                    <div class="morecolor d-flex justify-content-start">
                        <a href="?color=1" onclick="location.reload();">
                            <img src="/products-thumb/{{ $firstimage[0] }}" alt="" width="100%">
                        </a>
                        <a href="?color=2" onclick="location.reload();">
                            <img src="/products-thumb/{{ $secondimage[0] }}" alt="" width="100%">
                        </a>
                        <a href="?color=3" onclick="reloadAfterDelay(3000);">
                            <img src="/products-thumb/{{ $thirdimage[0] }}" alt="" width="100%">
                        </a>
                    </div>
                    <p class="mt-4 mb-2"><b>Select Size</b></p>
                    <?php
                      $string = $product->sizes;
                      $words = explode(", ", $string); 
                      ?>
                    
                    <div class="sizes d-flex justify-content-start">
                        @foreach($words as $word)
                        @if($word == 's')
                        <div class="size me-3">
                            <input id="size" class="form-check-input" value="S" type="radio" name="size" checked>
                            <p>S</p>
                        </div>
                        @endif
                        @if($word == 'm')
                        <div class="size me-3">
                            <input id="size" class="form-check-input" value="M" type="radio" name="size" required>
                            <p>M</p>
                        </div>
                        @endif
                        @if($word == 'l')
                        <div class="size me-3">
                            <input id="size" class="form-check-input" value="L" type="radio" name="size" required>
                            <p style="left: 20px;">L</p>
                        </div>
                        @endif
                        @if($word == 'xl')
                        <div class="size me-3">
                            <input id="size" class="form-check-input" value="XL" type="radio" name="size" required>
                            <p style="left: 14px;">XL</p>
                        </div>
                        @endif
                        @if($word == 'xxl')
                        <div class="size me-3">
                            <input id="size" class="form-check-input" value="XXL" type="radio" name="size" required>
                            <p style="left: 8px;">XXL</p>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <div class="buttons d-flex justify-content-start mt-4">
                        <button type="button" class="add-to-card button1 globalbtn me-3" id="addtocart"><i class="fa-solid fa-bag-shopping"></i>
                            Add to Bag</button>
                        <a href="/faq" class="wishlist button2"><i class="fa-solid fa-circle-question"></i> F.A.Q</a>
                    </div>
                    <hr>
                    <div class="product-details mt-4">
                        <p class="mt-3 mb-3"><b>Product Details</b></p>
                        {!! $product->description !!}
                    </div>
                </div>
                <div class="col-3">
                    <div class="offercard">
                        <label for="">
                        <?php
                          $currentTimestamp = time();
                          $oneWeekLaterTimestamp = $currentTimestamp + (7 * 24 * 60 * 60);
                          $oneWeekLaterFormatted = date("l jS \of F Y h:i:s A", $oneWeekLaterTimestamp);
                          ?>

                            FREE delivery {{ $oneWeekLaterFormatted }}
                        </label>
                        <label for="">
                            Or fastest delivery {{ $oneWeekLaterFormatted }}. Order within 4 hrs 41 mins.
                        </label>
                        <label for="">
                            Delivering to Meerut 250002 - Update location
                        </label>
                        <hr>
                        <label for="" style="color:green;font-size:28px">In stock</label>
                        <label for="">
                            Ships from : Amazon <br>
                            Sold by : Appario Retail Private Ltd
                        </label>


                    </div>
                </div>
            </div>
        </form>
    </div>
    <hr>
    <div class="container-fluid similar-product mb-5">
        <div class="row row-2 mb-3">
            <div class="col-12">
                <h3>Similar Products</h2>
            </div>
        </div>
        <div class="row row-2">
            @foreach($simproducts as $simproduct)
            @if($simproduct->category_name == $member->category_name)
            <div class="col-2 mb-4">
                <div class="productcard">
                    <a href="/shop/{{ $simproduct->slug }}">
                            @php
                            $image = json_decode($simproduct->p_image);
                            @endphp
                        <img src="/products/{{ $image[0] }}" alt="" width="100%">
                        <p class="category"><b>{{ $simproduct->category_name }}</b></p>
                        <p class="product-name">{{ $simproduct->p_name }}</p>
                        <p class="price">Rs. {{ $simproduct->r_price }}</p>
                    </a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>

    <div id="sidebarpopup" class="container container-sidebar-popup">
       <div id="getformdata"></div>
    </div>

    <x-footer facebook="{{ isset($gseo->facebook) ? $gseo->facebook : '' }}"
        linkedin="{{ isset($gseo->linkedin) ? $gseo->linkedin : '' }}"
        instagram="{{ isset($gseo->instagram) ? $gseo->instagram : '' }}"
        twitter="{{ isset($gseo->twitter) ? $gseo->twitter : '' }}"
        youtube="{{ isset($gseo->youtube) ? $gseo->youtube : '' }}"
        mail="{{ isset($gseo->whatsapp) ? $gseo->whatsapp : '' }}" />

    <script type="text/javascript" src="/assets/js/slick.min.js"></script>
    <script type="text/javascript" src="/assets/js/front/footer.js"></script>

</body>

<script>
$('.slideshow-thumbnails').hover(function() {
    changeSlide($(this));
});

$(document).mousemove(function(e) {
    var x = e.clientX;
    var y = e.clientY;

    var x = e.clientX;
    var y = e.clientY;

    var imgx1 = $('.slideshow-items.active').offset().left;
    var imgx2 = $('.slideshow-items.active').outerWidth() + imgx1;
    var imgy1 = $('.slideshow-items.active').offset().top;
    var imgy2 = $('.slideshow-items.active').outerHeight() + imgy1;

    if (x > imgx1 && x < imgx2 && y > imgy1 && y < imgy2) {
        $('#lens').show();
        $('#result').show();
        imageZoom($('.slideshow-items.active'), $('#result'), $('#lens'));
    } else {
        $('#lens').hide();
        $('#result').hide();
    }

});



function imageZoom(img, result, lens) {

    result.width(img.innerWidth());
    result.height(img.innerHeight());
    lens.width(img.innerWidth() / 2);
    lens.height(img.innerHeight() / 2);

    result.offset({
        top: img.offset().top,
        left: img.offset().left + img.outerWidth() + 50
    });

    var cx = img.innerWidth() / lens.innerWidth();
    var cy = img.innerHeight() / lens.innerHeight();

    result.css('backgroundImage', 'url(' + img.attr('src') + ')');
    result.css('backgroundSize', img.width() * cx + 'px ' + img.height() * cy + 'px');

    lens.mousemove(function(e) {
        moveLens(e);
    });
    img.mousemove(function(e) {
        moveLens(e);
    });
    lens.on('touchmove', function() {
        moveLens();
    })
    img.on('touchmove', function() {
        moveLens();
    })

    function moveLens(e) {
        var x = e.clientX - lens.outerWidth() / 2;
        var y = e.clientY - lens.outerHeight() / 2;
        if (x > img.outerWidth() + img.offset().left - lens.outerWidth()) {
            x = img.outerWidth() + img.offset().left - lens.outerWidth();
        }
        if (x < img.offset().left) {
            x = img.offset().left;
        }
        if (y > img.outerHeight() + img.offset().top - lens.outerHeight()) {
            y = img.outerHeight() + img.offset().top - lens.outerHeight();
        }
        if (y < img.offset().top) {
            y = img.offset().top;
        }
        lens.offset({
            top: y,
            left: x
        });
        result.css('backgroundPosition', '-' + (x - img.offset().left) * cx + 'px -' + (y - img.offset().top) * cy +
            'px');
    }
}


function changeSlide(elm) {
    $('.slideshow-items').removeClass('active');
    $('.slideshow-items').eq(elm.index()).addClass('active');
    $('.slideshow-thumbnails').removeClass('active');
    $('.slideshow-thumbnails').eq(elm.index()).addClass('active');
}
</script>



<script>
    $(document).ready(function() {
        $("#addtocart").click(function(){
            var slug = $("#slug").val(); 
            var form = $("#singleProduct")[0];
            var formData = new FormData(form);
           

            $.ajax({
                type: "POST",
                url: "/shop/" + slug,
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    document.querySelector("#sidebarpopup").style.display="block";
                    $("#getformdata").html(res);
                   }
            });
        });
    });
</script>




</html>