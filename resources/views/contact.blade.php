@extends('templates.front.main')

@section('body')
<div class="container-fluid breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p style="margin:0px" class="py-3"><a href="/">Home</a> » <a href="#">Contact Us</a></p>
            </div>
        </div>
    </div>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="fs-3 fw-bold">Our Dedicated Teams Are Ready To Help.</h1>
            <p class="fs-5 mb-3">Ready To Assist:Team Assistance</p>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <div class="card text-center text-dark py-3">
                <a href="mailto:{{$gseo->whatsapp}}">
                    <div class="card-body px-3">
                        <i class="fa-regular fa-envelope display-1 mb-3" style="color:#000!important"></i>
                        <h2 class="card-title mb-3 fs-3" style="color:#000!important">admin@dpsshop.com</h2>
                        <p class="card-text fs-5" style="color:#000!important">Having Trouble With Any Blog? We Welcome
                            Your Inputs.</p>
                </a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 mb-3">
        <div class="card text-center text-dark py-3">
            <a href="mailto:{{$gseo->whatsapp}}">
                <div class="card-body px-3">
                    <i class="fa-solid fa-phone-volume display-1 mb-3" style="color:#000!important"></i>
                    <h2 class="card-title mb-3 fs-3" style="color:#000!important">{{$gseo->whatsapp}}</h2>
                    <p class="card-text fs-5" style="color:#000!important">Have A Question For Our Team ? We Welcome
                        Your Inputs.</p>
            </a>
        </div>
    </div>
</div>
<div class="col-12 col-md-4 mb-3">
    <div class="card text-center text-dark py-3">
        <a href="mailto:{{$gseo->whatsapp}}">
            <div class="card-body px-3">
                <i class="fa-regular fa-envelope display-1 mb-3" style="color:#000!important"></i>
                <h2 class="card-title mb-3 fs-3" style="color:#000!important">admin@dpsshop.com</h2>
                <p class="card-text fs-5" style="color:#000!important">Have A Question For Our Organization ? We Welcome
                    Your Inputs.</p>
        </a>
    </div>
</div>
</div>
</div>
<div class="row mt-5">
    <div class="col-12 col-md-6">
        <h2>Give Us A Message For Any Query</h2>
        <hr style="width:50%">
        <form action="" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="mb-3">
                <label class="form-label" for="textarea">Message</label>
                <textarea name="message" id="textarea" rows="5" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-light text-dark fw-bold">Send Message</button>
        </form>
    </div>
    <div class="col-12 col-md-6 ps-md-5">
        <h2>Contact Info</h2>
        <hr style="width:20%">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3481.4305851304666!2d79.52632147497958!3d29.240298956223352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39a09b22b3d94e25%3A0x1540164bf111fa37!2sDQ%20Learnings%20(DQL)%20-%20Digital%20Skills%20Institute!5e0!3m2!1sen!2sin!4v1713551456382!5m2!1sen!2sin"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
</div>
@endsection