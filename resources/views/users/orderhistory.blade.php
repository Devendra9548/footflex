@extends('templates.front.main')
@section('customcss')
<link rel="stylesheet" type="text/css" href="/assets/css/admin/rte_theme_default.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('customcss')
<link rel="stylesheet" href="/assets/css/front/dashboard.css">
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
                                    <td style="color:red">{{ $order->status }}</td>
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
            <div class="col-12 d-flex justify-content-center align-items-end my-5">
                <a href="/dashboard" class="btn btn-success text-center me-3"><i class="fa-solid fa-backward-step"></i> Back to Dashboard</a>
                
            </div>
        </div>
    </div>
</section>

@endsection