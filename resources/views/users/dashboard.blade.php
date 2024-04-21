@extends('templates.front.main')
@section('customcss')
<link rel="stylesheet" href="/assets/css/front/dashboard.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
footer {
    display: none !important;
}
.showpwd{
       display:none;
    }
label{
    color: #fff;
}
</style>
@endsection
@section('body')

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Purchased History</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="getformdata"></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<section class="tg-may-account-wrapp tg" style="margin-bottom:100px">
    <div class="inner">
        <div class="tg-account">

            <!-- Accont banner start -->
            <div class="account-banner">
                <div class="inner-banner">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 detail">
                                <div class="inner">
                                    <h1 class="page-title">My Account</h1>
                                    <h3 class="user-name">Hello {{ session('cusername')}} </h3>
                                    <p class="description">Welcome to Our Dashboard</p>
                                </div>
                            </div>
                            <!-- Column end -->
                            <div class="col-md-4 profile">
                                <div class="profile">
                                    <span class="image">

                                        <a href="/logout" style="color:#fff!important"><i
                                                class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
                                    </span>
                                </div>
                            </div>
                            <!-- Column end -->
                        </div>
                        <!-- Row end -->

                        <!-- Navbar Start -->
                        <div class="nav-area">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="dashboard-link" data-toggle="tab" href="#dashboard"
                                        role="tab" aria-controls="dashboard" aria-selected="true"><i
                                            class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="my-order" data-toggle="tab" href="#my-orders" role="tab"
                                        aria-controls="my-orders" aria-selected="false"><i
                                            class="fas fa-file-invoice"></i> <span>Orders</span></a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="my-address" data-toggle="tab" href="#address" role="tab"
                                        aria-controls="address" aria-selected="false"><i
                                            class="fas fa-map-marker-alt"></i> <span>Address</span></a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" id="account-detail" data-toggle="tab" href="#account-details"
                                        role="tab" aria-controls="account-details" aria-selected="false"><i
                                            class="fas fa-user-alt"></i> <span>Account Details</span></a>
                                </li>
                                <li>

                                </li>
                            </ul>
                        </div>
                        <!-- Navbar End -->
                    </div>
                </div>
            </div>
            <!-- Banner end   -->

            <!-- Tabs Content start -->
            <div class="tabs tg-tabs-content-wrapp">
                <div class="inner">
                    <div class="container">
                        <div class="inner">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-link">
                                    <div class="my-account-dashboard">
                                        <div class="inner">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <div class="card" area-toggle="my-order">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <a><img
                                                                        src="https://res.cloudinary.com/templategalaxy/image/upload/v1631257421/codepen-my-account/images/orders_n2aopq.png"></a>
                                                            </div>
                                                            <h2>Your Orders</h2>
                                                            <p>{{ count($orders) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-4 mb-3">
                                                    <div class="card" area-toggle="my-address">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <a><img
                                                                        src="https://res.cloudinary.com/templategalaxy/image/upload/v1631257421/codepen-my-account/images/notebook_psrhv5.png"></a>
                                                            </div>
                                                            <h2>Your Addresses</h2>
                                                            <p>Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry.</p>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="col-md-4 mb-3">
                                                    <div class="card" area-toggle="account-detail">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <a><img
                                                                        src="https://res.cloudinary.com/templategalaxy/image/upload/v1631257421/codepen-my-account/images/login_aq9v9z.png"></a>
                                                            </div>
                                                            <h2>Account Details</h2>
                                                            <p> Know More.</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="my-orders" role="tabpanel" aria-labelledby="my-order">
                                    <table id="my-orders-table"
                                        class="table table-striped table-bordered dt-responsive nowrap"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Order</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th class="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $id=>$order)
                                            @php
                                            $carts = json_decode($order->cart);
                                            @endphp
                                            <tr>
                                                <td>#{{ $order->orderid }}</td>
                                                <td>{{ $order->status }}</td>
                                                <td>Rs. {{ $order->amount }}</td>
                                                <td class="action"><a href="dashboard/{{ $order->orderid }}"
                                                        class="view-order getorderhistory btn btn-primary">View Order <i class="fa-solid fa-square-up-right" style="font-size:32"> </i></a>
                                                        <a href="dashboard/{{ $order->id }}" value="{{ $order->orderid }}"
                                                        class="view-order delete btn btn-danger">Delete <i class="fa-solid fa-trash-can" style="font-size:32"></i></a>
                                                    </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="account-details" role="tabpanel"
                                    aria-labelledby="account-detail">
                                    <div class="account-detail-form">
                                        <div class="inner">
                                            <form class="tg-form" id="accountDetails" action="" method="" style="width:50%;background:#000">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $customer->id }}">
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="inputfname">Username(You Can't change username)</label>
                                                        <input type="text" class="form-control" id="inputfname"
                                                            placeholder="Username" name="username"
                                                            value="{{ $customer->username }}" readonly>
                                                    </div>

                                                    <div class="form-group col-md-12 mt-3">
                                                        <label for="inputEmail4">Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            id="inputEmail4" placeholder="Email"
                                                            value="{{ $customer->email }}">
                                                    </div>

                                                    
                                                    <div class="form-group col-md-12 mt-3">
                                                        <label for="inputEmail4">Phone Number</label>
                                                        <input type="phone" class="form-control" name="phone"
                                                            id="inputEmail4" placeholder="Phone Number"
                                                            value="{{ $customer->p_number }}">
                                                    </div>

                                                    <div class="mb-3 mt-3">
                                                        <label for="pwd" class="mb-2">Password</label>
                                                        <div class="showhidepwd" style="position:relative">
                                                            <input type="password" class="form-control" id="pwd"
                                                                placeholder="Enter password" name="pswd" value="{{ $customer->password }}">
                                                            <div style="position:absolute;right:12px;top:6px">
                                                                <a href="#" class="showpwd"><i
                                                                        class="fa-solid fa-eye"></i></a>
                                                                <a href="#" class="hidepwd"><i
                                                                        class="fa-solid fa-eye-slash"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
$('#myTab a').on('click', function(e) {
    e.preventDefault()
    $(this).tab('show')
});

/**
 * Datatable call
 */
$(document).ready(function() {
    $('#my-orders-table').DataTable();
});

/**
 * My account nav click
 */
$(document).ready(function() {
    $('.tg-tabs-content-wrapp .my-account-dashboard .card').click(function() {

        var ariaClick = $(this).attr('area-toggle');
        $('.tg-account .account-banner .nav-area  a#' + ariaClick).click();
    });
});
</script>
<script>
$(document).ready(function() {
    $('.hidepwd').click(function(event){
        event.preventDefault();
      $('.showhidepwd input').attr("type", "text");
      $('.showpwd').show();
      $('.hidepwd').hide();
    });
});
</script>

<script>
$(document).ready(function() {
    $('.showpwd').click(function(event){
        event.preventDefault();
      $('.showhidepwd input').attr("type", "password");
      $('.showpwd').hide();
      $('.hidepwd').show();
    });
});
</script>
<script>
$(document).ready(function() {
    $("#accountDetails").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/dashboard/userupdate",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res == true) {
                    alert("User updated successfully!");
                    window.location.reload();
                } else {
                    alert("Error!" + res);
                }
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    $(".delete").click(function(event) {
        event.preventDefault();
        var data = confirm("Are You Sure You Want to Delete It?");
        if (data == true) {
            var datas = $(this).attr('value');
            $.ajax({
                type: "DELETE",
                url: "/dashboard/" + datas,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content') 
                },
                success: function(data) {
                    alert("Delete Order Successfully!");
                    window.location.reload();
                },

                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Before Delete Order Please Remove Category From Customer");
                }
            });
        }
    });
});
</script>
@endsection