@extends('templates.front.main')
@section('customcss')
<link rel="stylesheet" href="/assets/css/front/home.css">
@endsection

@section('body')
<div class="main-container" style="margin-top:-5px">

            <div class="hero-section-slider">
                <div>
                    <img src="/assets/imgs/1.png" alt="2" width="100%">
                </div>
                <div>
                    <img src="/assets/imgs/2.png" alt="2" width="100%">
                </div>
                <div>
                    <img src="/assets/imgs/3.png" alt="2" width="100%">
                </div>
            </div>
</div>

<section class="d-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-7 col-md-10 d-flex justify-content-start align-items-center">
                <h2>Shop By Sport Shoes</h2>
            </div>
            <div class="col-5 col-md-2 d-flex justify-content-end align-items-center">
                <a href="/shop?category=sport-shoes" class="globalbtn">See More <i class="fa-solid fa-angles-right"></i></a>
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="shopbycategory">
                    @foreach($products as $product)
                    @if($product->category_name == 'Sport Shoes')
                    <div class="slide-cols">
                        <div class="scard">
                            <a href="/shop/{{ $product->slug }}">
                            @php
                             $image = json_decode($product->p_image);
                            @endphp
                            <img src="/products/{{ $image[0] }}" alt="2" width="100%">
                            
                            <p class="title">{{ $product->p_name }}</p>
                            <p class="offer">Min. <?php
                      $actval = $product->p_price; // 12000
                      $relval = $product->r_price; // 11000
                      $percentage = ($relval * 100)/$actval;
                      echo (int)(100-$percentage); 
                    ?> OFF</p>
                            </a>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


<section class="d-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-7 col-md-10 d-flex justify-content-start align-items-center">
                <h2>Shop By Casual Shoes</h2>
            </div>
            <div class="col-5 col-md-2 d-flex justify-content-end align-items-center">
                <a href="/shop?category=casual-shoes" class="globalbtn">See More <i class="fa-solid fa-angles-right"></i></a>
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="shopbycategory">
                    @foreach($products as $product)
                    @if($product->category_name == 'Casual Shoes')
                    <div class="slide-cols">
                        <div class="scard">
                            <a href="/shop/{{ $product->slug }}">
                            @php
                             $image = json_decode($product->p_image);
                            @endphp
                            <img src="/products/{{ $image[0] }}" alt="2" width="100%">
                            
                            <p class="title">{{ $product->p_name }}</p>
                            <p class="offer">Min. <?php
                      $actval = $product->p_price; // 12000
                      $relval = $product->r_price; // 11000
                      $percentage = ($relval * 100)/$actval;
                      echo (int)(100-$percentage); 
                    ?> OFF</p>
                            </a>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>


<section class="d-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-7 col-md-10 d-flex justify-content-start align-items-center">
                <h2>Shop By Formal Footwear</h2>
            </div>
            <div class="col-5 col-md-2 d-flex justify-content-end align-items-center">
                <a href="/shop?formal-footwear" class="globalbtn">See More <i class="fa-solid fa-angles-right"></i></a>
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="shopbycategory">
                    @foreach($products as $product)
                    @if($product->category_name == 'Formal Footwear')
                    <div class="slide-cols">
                        <div class="scard">
                            <a href="/shop/{{ $product->slug }}">
                            @php
                             $image = json_decode($product->p_image);
                            @endphp
                            <img src="/products/{{ $image[0] }}" alt="2" width="100%">
                            
                            <p class="title">{{ $product->p_name }}</p>
                            <p class="offer">Min. <?php
                      $actval = $product->p_price; // 12000
                      $relval = $product->r_price; // 11000
                      $percentage = ($relval * 100)/$actval;
                      echo (int)(100-$percentage); 
                    ?> OFF</p>
                            </a>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>






@endsection

@section('customjs')
<script src="/assets/js/front/home.js"></script>
@endsection