@extends('templates.front.main')
@section('customcss')
<link rel="stylesheet" href="/assets/css/front/shop.css">
@endsection
@section('body')
<div class="container-fluid breadcrumbs">
    <div class="row row-2">
        <div class="col-12">
            <p style="margin:0px" class="py-3"><a href="/">Home</a> » <a href="#">Shop</a></p>
        </div>
    </div>
</div>
<div class="container-fluid shop">
    <hr>
    <div class="row row-2">
        <div class="col-2 mb-none" style="border-right:1px solid #0002">
            <h2 class="my-3">Filters</h2>
        </div>
        <div class="col-12 col-md-10 d-flex justify-content-end align-items-center">
            <form action="?orderby=" id="dropDownForm" class="d-flex justify-content-end align-items-center mb-none">
                <div class="sortby">
                    <select name="orderby" id="" class="form-select" onchange="submitForm()">
                        <option value="">Sort By</option>
                        <option value="desc">Price : High to Low</option>
                        <option value="asc">Price : Low to High</option>
                    </select>
                </div>
            </form>
            <form action="" class="d-flex justify-content-end align-items-center search-form">
                <div class="search">
                    <input type="text" placeholder="Search Products" class="form-control search" name="search">
                    <input type="submit" value="search" class="submit">
                </div>
            </form>
        </div>
    </div>

</div>
<div class="container-fluid shop">
    <hr>
    <div class="row row-2">
        <div class="col-12 col-md-2 mb-none" style="border-right:1px solid #0002">
            <form action="" class="my-3" id="catForm">
                <p class="mb-2" style="font-size:14px;font-weight:bold">
                    <input class="form-check-input me-3" name="category" value="mens" type="checkbox" onchange="catForm()"> Men
                </p>
                <p class="mb-2" style="font-size:14px;font-weight:bold">
                    <input class="form-check-input me-3" name="category" value="women" type="checkbox" onchange="catForm()"> Women
                </p>
                <p class="mb-2" style="font-size:14px;font-weight:bold">
                    <input class="form-check-input me-3" name="category" value="kids" type="checkbox" onchange="catForm()"> Kids
                </p>
            </form>

            
        </div>
        <div class="col-12 col-md-10">
            <div class="row mt-3">
                @foreach($products as $product)
                <div class="col-12 col-md-3 mb-4">
                    <div class="productcard">
                        <a href="/shop/{{ $product->productslug }}">
                           <?php 
                              $pimages = json_decode($product->pimages);
                            ?>
                            <img src="/products/{{ $pimages[0] }}" alt="" width="100%">
                            <p class="category"><b>{{ $product->categoryname }}</b></p>
                            <p class="product-name">{{ $product->pname }}</p>
                            <p class="price">₹{{ $product->rprice }} <del>MRP ₹{{ $product->pprice }}</del></p>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <hr>

</div>
<script>
    function submitForm() {
        document.getElementById("dropDownForm").submit();
    }
    function catForm(){
        document.getElementById("catForm").submit();
    }
</script>
@endsection