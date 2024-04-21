@extends('templates.front.main')
@section('customcss')
<link rel="stylesheet" href="/assets/css/users/user.css">
@endsection
@section('body')
<div class="form-modal mb-5">

    <div class="form-toggle">
        <button id="login-toggle" onclick="toggleLogin()">log in</button>
        <button id="signup-toggle" onclick="toggleSignup()">sign up</button>
    </div>

    <div id="login-form">
        <form id="login">
            @csrf
            <input type="text" name="username" placeholder="Enter email or username" />
            <input type="password" name="password" placeholder="Enter password" />
            <button type="submit" class="btn login">login</button>
        </form>
    </div>

    <div id="signup-form">
        <form id="signupnow">
            @csrf
            <input type="text" name="username" placeholder="Choose username" />
            <input type="email" name="email" placeholder="Enter your email" />
            <input type="number" name="phonenumber" placeholder="Phone Number" />
            <input type="password" name="password" placeholder="Create password" />
            <input type="password" name="repassword" placeholder="Re-Password" />
            <button type="submit" class="btn signup">create account</button>
        </form>
    </div>

</div>

<script>
$(document).ready(function() {
    $("#login").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        
        $.ajax({
            type: "POST",
            url: "/checklogin",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res == true) {
                    $("#login")[0].reset();
                    alert("Login successfully!");
                    window.location.reload();
                } else {
                    alert(res);
                }
            }
        });
    });
});
</script>


<script>
$(document).ready(function() {
    $("#signupnow").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        
        $.ajax({
            type: "POST",
            url: "/login",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res == true) {
                    $("#signupnow")[0].reset();
                    alert("User added successfully!");
                    window.location.reload('/login');
                } else {
                    alert("Error!" + res);
                }
            }
        });
    });
});
</script>

@endsection

<script>
function toggleSignup() {
    document.getElementById("login-toggle").style.backgroundColor = "#fff";
    document.getElementById("login-toggle").style.color = "#222";
    document.getElementById("signup-toggle").style.backgroundColor = "#131921";
    document.getElementById("signup-toggle").style.color = "#fff";
    document.getElementById("login-form").style.display = "none";
    document.getElementById("signup-form").style.display = "block";
}

function toggleLogin() {
    document.getElementById("login-toggle").style.backgroundColor = "#131921";
    document.getElementById("login-toggle").style.color = "#fff";
    document.getElementById("signup-toggle").style.backgroundColor = "#fff";
    document.getElementById("signup-toggle").style.color = "#222";
    document.getElementById("signup-form").style.display = "none";
    document.getElementById("login-form").style.display = "block";
}
</script>
