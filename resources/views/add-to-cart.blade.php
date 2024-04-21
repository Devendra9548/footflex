<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add To Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</head>

<body class="single-product-page">
    <x-header />
    <div class="container mt-5">
        <div class="row my-5">
            <div class="col-12">
                <h2 class="text-center">Add To Cart</h2>
            </div>
            <div class="col-12" >
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total = 0;
                        @endphp
                        @if(session()->has('cart'))
                        @foreach(session('cart') as $id=>$product)
                        <tr>
                            <td><img src="/recent-products-thumb/{{ $product['image'][0] }}"
                                    alt="{{ $product['image'][0] }}"></td>
                            <td>{{ $product['name'] }}<br><b>{{ $product['catname'] }}</b></td>
                            <td>Rs. {{ $product['price'] }}</td>
                            <td>{{ $product['quantity'] }}</td>
                            <td>{{ $product['color'] }}</td>
                            <td>{{ $product['size'] }}</td>
                            <td><a href="/add-to-cart/{{ $id }}" class="delete" value="{{ $id }}">
                                    <i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-6"></div>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <a href="/shop" class="btn btn-primary me-3">Back to Shop</a>
                <a href="/checkout" class="btn btn-primary">Checkout Now!</a>
            </div>

        </div>
    </div>
    <x-footer facebook="{{ isset($gseo->facebook) ? $gseo->facebook : '' }}"
        linkedin="{{ isset($gseo->linkedin) ? $gseo->linkedin : '' }}"
        instagram="{{ isset($gseo->instagram) ? $gseo->instagram : '' }}"
        twitter="{{ isset($gseo->twitter) ? $gseo->twitter : '' }}"
        youtube="{{ isset($gseo->youtube) ? $gseo->youtube : '' }}"
        mail="{{ isset($gseo->whatsapp) ? $gseo->whatsapp : '' }}" />


    <script type="text/javascript" src="/assets/js/front/footer.js"></script>
    <script>
    $(document).ready(function() {
        $(".delete").click(function(event) {
            event.preventDefault();
            var data = confirm("Are You Sure You Want to Delete It?");
            if (data == true) {
                var datas = $(this).attr('value');
                $.ajax({
                    type: "DELETE",
                    url: "/add-to-cart/" + datas,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Include CSRF token for Laravel protection
                    },
                    success: function(data) {
                        alert("Deleted Successfully!")
                        location.reload();
                    },

                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("Before Delete Please Remove Category From Blogs");
                    }
                });
            }
        });
    });
    </script>

  </body>

</html>