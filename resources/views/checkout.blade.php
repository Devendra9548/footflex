<!DOCTYPE html>
<html lang="en">

<head>
    <title>Checkout</title>
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
    <style>
    .needs-validation input,
    .needs-validation .input-group-prepend {
        border: 1px solid #5555554d !important;
    }

    .needs-validation select {
        padding: 6px 8px !important;
        border-radius: 5px !important;
    }
    </style>
</head>

<body>
    <x-header />
    <div class="container">
        <div class="py-5 text-center">

            <h2>Checkout form</h2>
            <hr>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill" style="color:#000!important">Total Items :
                        {{ count(session('cart')) }}</span>
                </h4>
                <ul class="list-group mb-3">
                    @php
                    $total = 0;
                    @endphp
                    @foreach(session('cart') as $id=>$product)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{ $product['name'] }}</h6>
                            <small class="text-muted">{{ $product['catname'] }}</small><br>
                            <small class="text-muted">Quantity : {{ $product['quantity'] }}</small>
                        </div>
                        @php
                        $price = $product['price'] * $product['quantity'];
                        @endphp
                        <span class="text-muted text-end">Original Price : {{ $product['price'] }}<br><b> Total :
                                {{ $price }}</b></span>
                    </li>
                    @php
                    $total = $total + $price;
                    @endphp
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>EXAMPLECODE</small>
                        </div>
                        <span class="text-success">Rs.0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span style="margin-top: 8px!important;"><b>Grand Total</b></span>
                        <strong class="text-success fs-3" style="font-weight:400!important">Rs. {{ $total }}</strong>
                    </li>
                </ul>

                <form class="card p-2" action="" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Redeem</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form id="purchased" action="" class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" value="{{ $userid }}" name="userid">
                    @php 
                     $productname=json_encode(session('cart'));
                    @endphp
                    
                    <input type="hidden" value="{{  $productname }}" name="cart">
                    <input type="hidden" value="{{ $total }}" name="amount">
                    <input type="hidden" value="Pending" name="status">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" name="firstname" placeholder=""
                                value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="lastname" placeholder=""
                                value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" id="username" placeholder="Username"
                                value="{{session('cusername')}}" readonly required>
                            <div class="invalid-feedback" style="width: 100%;">
                                Your username is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted"></span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone">Phone Number <span class="text-muted"></span></label>
                        <input type="phone" class="form-control" id="phone" name="phone" placeholder="+919548161909">
                        <div class="invalid-feedback">
                            Please enter a valid Phone Number for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St"
                            required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" id="address2" name="altaddress"
                            placeholder="Apartment or suite">
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" id="country" name="country" required>
                                <optgroup label="Select Country">
                                    <option value="IN">India</option>
                                    <option value="US">United States</option>
                                </optgroup>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select class="custom-select d-block w-100" id="state" name="state" required>
                                <optgroup label="Select State">
                                    <option value="">Select a State</option>
                                    <option value="uttarakhand">Uttarakhand</option>
                                    <option value="uttar_pradesh">Uttar Pradesh</option>
                                    <option value="west_bengal">West Bengal</option>
                                    <option value="maharashtra">Maharashtra</option>
                                    <option value="kerala">Kerala</option>
                                    <option value="karnataka">Karnataka</option>
                                    <option value="telangana">Telangana</option>
                                    <option value="andhra_pradesh">Andhra Pradesh</option>
                                    <option value="tamil_nadu">Tamil Nadu</option>
                                    <option value="odisha">Odisha</option>
                                    <option value="rajasthan">Rajasthan</option>
                                    <option value="madhya_pradesh">Madhya Pradesh</option>
                                    <option value="gujarat">Gujarat</option>
                                    <option value="punjab">Punjab</option>
                                    <option value="haryana">Haryana</option>
                                    <option value="delhi">Delhi</option>
                                    <option value="jammu_and_kashmir">Jammu and Kashmir</option>
                                    <option value="himachal_pradesh">Himachal Pradesh</option>
                                    <option value="bihar">Bihar</option>
                                    <option value="jharkhand">Jharkhand</option>
                                    <option value="chhattisgarh">Chhattisgarh</option>
                                    <option value="assam">Assam</option>
                                    <option value="meghalaya">Meghalaya</option>
                                    <option value="manipur">Manipur</option>
                                    <option value="tripura">Tripura</option>
                                    <option value="arunachal_pradesh">Arunachal Pradesh</option>
                                    <option value="mizoram">Mizoram</option>
                                    <option value="nagaland">Nagaland</option>
                                    <option value="sikkim">Sikkim</option>
                                    <option value="goa">Goa</option>
                                    <option value="lakshadweep">Lakshadweep</option>
                                    <option value="puducherry">Puducherry</option>
                                </optgroup>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <label for="paymentmethod">Select Payment Method</label>
                    <select name="paymentmethod" id="paymentmethod" class="form-control">
                        <optgroup label="Select Payment Method">
                            <option value="COD">Cash On Delivery</option>
                        </optgroup>
                    </select>
                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="same-address">
                        <label class="custom-control-label" for="same-address">Shipping address is the same as my
                            billing address</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-info">
                        <label class="custom-control-label" for="save-info">Save this information for next time</label>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-success btn-lg btn-block mb-5 me-2" type="submit">Continue to
                        checkout</button>
                    <button class="btn btn-primary btn-lg btn-block mb-5" type="button"
                        onclick="window.location='/shop'">Back to Shop</button>
                </form>
            </div>
        </div>

    </div>
    
<script>
$(document).ready(function() {
    $("#purchased").submit(function(event) {
        event.preventDefault();
        var form = $("#purchased")[0];
        var formData = new FormData(form);
        $.ajax({
            type: "POST",
            url: "/purchased",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res == true) {
                    alert("Purchased successfully!");
                    window.location="/dashboard";
                } else {
                    alert("Error!" + res);
                }
            }
        });
    });
});
</script>

    <x-footer facebook="{{ isset($gseo->facebook) ? $gseo->facebook : '' }}"
        linkedin="{{ isset($gseo->linkedin) ? $gseo->linkedin : '' }}"
        instagram="{{ isset($gseo->instagram) ? $gseo->instagram : '' }}"
        twitter="{{ isset($gseo->twitter) ? $gseo->twitter : '' }}"
        youtube="{{ isset($gseo->youtube) ? $gseo->youtube : '' }}"
        mail="{{ isset($gseo->whatsapp) ? $gseo->whatsapp : '' }}" />
</body>

</html>