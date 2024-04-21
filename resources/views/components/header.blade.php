<header class="header ds-header">
    <div class="container-fluid">
        <div class="row py-3">
            <div class="col-1">
                <div class="logo">
                    <a href="/">
                        <img src="/assets/imgs/logo.png" alt="logo" width="50%">
                    </a>
                </div>
            </div>
            <div class="col-5 d-flex align-items-center">
                <nav class="navbar">
                    <ul class="">
                        <li><a href="/shop?category=mens">Men</a></li>
                        <li><a href="/shop?category=women">Women</a></li>
                        <li><a href="/shop?category=kids">Kids</a></li>
                        <li><a href="/shop">Shop</a></li>
                        <li><a href="/blog">Fashion Tips</a></li>
                        <li><a href="/contact-us">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-4 d-flex align-items-center">
                <form action="" class="w-100 col-4 d-flex align-items-center position-relative">
                    <input type="text" class="form-control ps-5 py-2"
                        placeholder="Search for products, cloths and more." name="search" style="background:#f9f9f9">
                    <button type="submit" class="btn btn-transparent position-absolute left-0 top-0"><i
                            class="fa-solid fa-magnifying-glass fs-5 mt-1"></i></button>

                </form>
            </div>
            <div class="col-2 d-flex align-items-center justify-content-end" style="padding-right:30px">
                <div class="cards d-flex align-items-center">
                    <div class="wishlist text-center me-4">
                        <p><a href="#"><i class="fa-solid fa-circle-question"></i></a></p>
                        <p class="name"><a href="/faq">FAQ</a></p>
                    </div>
                    <div class="cart text-center me-4 position-relative">
                        <p><a href="/add-to-cart"><i class="fa-solid fa-cart-shopping"></i></a></p>
                        <p class="name"><a href="/add-to-cart">Cart 
                        @if(session('cart'))
                            @if(count(session('cart')) > 0)
                            <span style="position: absolute;top: -7px;background: #fff !important;border: 1px solid #000;padding: 0px !important;height: 20px;width: 20px;font-size: 12px !important;display: flex;justify-content: center;align-items: center;border-radius: 100px;left: 18px;">
                            {{ count(session('cart')) }}
                            </span>
                            @endif
                        @endif
                    </a>

                        </p>
                    </div>
                    <div class="login text-center">
                        <p><a href="{{ route('login.dashboard')}}"><i class="fa-regular fa-user"></i></a></p>
                        <p class="name"><a href="{{ route('login.dashboard')}}">
                                @if((session()->has('cusername') || session()->has('cemail')) &&
                                session()->has('cpassword'))
                                {{ session('cusername') }}
                                @else
                                Profile
                                @endif
                            </a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <hr style="margin: 0px!important;"> -->
</header>

<header class="header mb-header">
    <div class="container-fluid">
        <div class="row py-3">
            <div class="col-4">
                <div class="logo">
                    <a href="/">
                        <img src="/assets/imgs/myntra.png" alt="myntra" width="90px">
                    </a>
                </div>
            </div>
            <div class="col-8 d-flex align-items-center justify-content-end">
                <p class="text-end pe-2" id="menuburgar"><a href="#"><i class="fa-solid fa-bars fs-2"></i></a></p>
                <nav class="navbar" id="mbnav">
                    <ul class="">
                        <li id="closeiconmenu" class="text-end" style="position: absolute;right: 0;z-index: 223;"><a href=""><i class="fa-solid fa-rectangle-xmark" style="color:#fff;font-size:32px!important"></i></a></li>
                        <li><a href="/shop?category=mens">Men</a></li>
                        <li><a href="/shop?category=women">Women</a></li>
                        <li><a href="/shop?category=kids">Kids</a></li>
                        <li><a href="/shop">Shop</a></li>
                        <li><a href="/blog">Fashion Tips</a></li>
                        <li><a href="/contact-us">Contact Us</a></li>
                        <li><a href="/faq">FAQ</a></li>
                        <li><a href="/add-to-cart">Cart</a></li>
                        <li><a href="/dashboard">Profile</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <hr style="margin: 0px!important;">
</header>

<script>
    document.querySelector("#menuburgar").addEventListener('click',function(event){
    event.preventDefault();
    document.querySelector("#mbnav").style.display = "block";    
});

document.querySelector("#closeiconmenu").addEventListener('click',function(event){
    event.preventDefault();
    document.querySelector("#mbnav").style.display = "none";    
});

</script>