@extends('templates.front.main')

@section('customcss')
<link rel="stylesheet" href="/assets/css/front/dashboard.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
footer,
header {
    display: none !important;
}

.orderhistory,
body {
    background: #Fff !important;
}
body,section{
    background:#f6f6f6!important;
}
.container{
    background:#fff!important;
}
</style>
@endsection
@section('body')

<section class="my-5">
    <div class="container my-5">
        <div class="row" style="position: relative;">
            <div class="col-12">
                <div class="orderhistory">
                    <h2 class="text-center fs-3 mt-5">Orders</h2>
                    <a href="#" class="text-center me-3" onclick="window.print()" style="position: absolute;top: 30px;right: 30px;"><i class="fa-solid fa-print" style="font-size:26px"></i></a>
                    <hr>
                    <table class="table table-hover">
                        <tr style="height: 55px !important;">
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Details</th>
                            <th>Product Price</th>
                        </tr>
                        @foreach($orders as $order)
                        @php
                        $carts = json_decode($order->cart);
                        @endphp
                        @foreach($carts as $id=>$item)
                        <tr>
                            <td><img src="/recent-products-thumb/{{ $item->image[0] }}" alt="" width="30%"></td>
                            <td>
                                Name : {{ $item->name }}</br>
                                Category : {{ $item->catname }}</br>
                            </td>
                            <td>
                                Quantity : {{ $item->quantity }}</br>
                                Color : {{ $item->color }}</br>
                                Size : {{ $item->size }}</br>
                            </td>
                            <td>
                                Price : {{ $item->price }}</br>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                        @foreach($orders as $order)
                        <tr style="background:#000!important">
                            <td></td>
                            <td></td>
                            <td><b>Grand Total</b></td>
                            <td style="color: green;font-weight: bold;font-size: 20px;">Rs. {{ $order->amount }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2 class="text-center fs-3 my-5">Account Details</h2>
                @foreach($orders as $order)
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><b>Invoice</b></td>
                                    <td>#{{ $order->orderid }}</td>
                                    <td><b>Address</b></td>
                                    <td>{{ $order->address }}</td>
                                </tr>
                                <tr>
                                    <td><b>First Name</b></td>
                                    <td>{{ $order->firstname }}</td>
                                    <td><b>Alt. Address</b></td>
                                    <td>{{ $order->altaddress }}</td>
                                </tr>
                                <tr>
                                    <td><b>Last Name</b></td>
                                    <td>{{ $order->lastname }}</td>
                                    <td><b>Country</b></td>
                                    <td>{{ $order->country }}</td>
                                </tr>
                                <tr>
                                    <td><b>Email</b></td>
                                    <td>{{ $order->email }}</td>
                                    <td><b>State</b></td>
                                    <td>{{ $order->state }}</td>
                                </tr>
                                <tr>
                                    <td><b>Phone Number</b></td>
                                    <td>{{ $order->phonenumber }}</td>
                                    <td><b>Zip Code</b></td>
                                    <td>{{ $order->zip }}</td>
                                </tr>
                                <tr>
                                    <td><b>Payment Method</b></td>
                                    <td>{{ $order->paymethod }}</td>
                                    <td><b>Payment Status</b></td>
                                    <td>
                                        @if($order->status == "Pending")
                                        <span style="color:orange;font-weight:bold">{{ $order->status }}</span>
                                        @endif
                                        @if($order->status == "Completed")
                                        <span style="color:green;font-weight:bold">{{ $order->status }}</span>
                                        @endif
                                        @if($order->status == "On The Way")
                                        <span style="font-weight:bold" class="text-info">{{ $order->status }}</span>
                                        @endif
                                        @if($order->status == "Cancel")
                                        <span style="color:red;font-weight:bold">{{ $order->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6"></div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="background: #000;padding: 30px;">
            <form action="" id="updatestatus">
                    @csrf
                    @foreach($orders as $order)
                    <input id="hiddenid" type="hidden" name="userid" value="{{ $order->orderid }}">
                    <label for="" style="color:#fff"><b>Change Status</b></label><br>
                    <select name="status" id="" class="form-control">
                        <option value="Pending">Pending</option>
                        <option value="On The Way">On The Way</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancel">Cancel</option>
                    </select>
                    @endforeach
                    <input type="submit"  value="Update Status" class="btn btn-warning mt-2">
                </form>
            </div>
        </div>
        <div class="row" style="background: #0001;">
            <div class="col-12 d-flex justify-content-center align-items-end my-5">
                 <a href="/admin/all-orders" class="btn btn-success text-center me-3"><i class="fa-solid fa-backward-step"></i> Back to Dashboard</a>
                 <a href="#" class="btn btn-danger text-center delete" value="{{ $order->orderid }}"><i class="fa-solid fa-circle-xmark"></i> Are You Want to Cancel this Order?</a>
            </div>
        </div>
    </div>
</section>
<script>
$(document).ready(function() {
    $("#updatestatus").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var hiddenid = document.querySelector("#hiddenid").value;
        $.ajax({
            type: "POST",
            url: "/admin/all-orders/"+hiddenid,
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res == true) {
                    $("#updatestatus")[0].reset();
                    alert("Update Status successfully!");
                    window.location.reload('/admin/all-orders');
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
    $("#deleteorder").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var hiddenid = document.querySelector("#hiddenid").value;
        $.ajax({
            type: "POST",
            url: "/admin/all-orders/"+hiddenid,
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res == true) {
                    $("#updatestatus")[0].reset();
                    alert("Update Status successfully!");
                    window.location.reload('/admin/all-orders');
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
                url: "/admin/delete-order/" + datas,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content') 
                },
                success: function(data) {
                    alert("Deleted Successfully!")
                    window.location="/admin/all-orders";
                },

                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Before Delete Please Remove Category From Blogs");
                }
            });
        }
    });
});
</script>


@endsection