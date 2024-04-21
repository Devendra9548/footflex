<div class="row sidebar-popup">
            <div class="col-3"></div>
            <div class="col-6 text-center">
                <h2 class="text-white py-3 fs-5">All Products</h2>
            </div>
            <div class="col-3 text-end">
                <a href="#" class="text-end fs-3 pe-3 mt-2 d-block" id="closeicon">
                <i class="fa-solid fa-circle-xmark" style="color:#fff"></i>
                </a>
            </div>
            <div class="col-12">
            <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
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
                            <td>{{ $product['name'] }}<br><b>{{ $product['catname'] }}</b><br>Rs. {{ $product['price'] }}<br>Quantity : {{ $product['quantity'] }}</td>
                            <td><a href="/add-to-cart" class="btn btn-primary" value="{{ $id }}">
                                    View Cart <i class="fa-solid fa-square-arrow-up-right"></i></a></td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <script>
    document.querySelector("#closeicon").addEventListener('click',function(event){
        event.preventDefault();
        document.querySelector("#sidebarpopup").style.display="none";
    });
    
</script>