<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
      html,body{
        background:#f9f9f9;
      }
      form{
      background:#fff;
      box-shadow:0px 2px 7px 2px #0003;
      width: 357px;
    margin-left: auto;
    margin-right: auto;
    display: flex;
    justify-content: center;
    flex-direction: column;
    border: 1px solid #0002;
    padding: 20px 20px;
}
    .showpwd{
       display:none;
    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="row d-flex align-items-center vh-100">
            <div class="col-12">
               <form id="login">
                @csrf
                    <h2>Login</h2>
                    <div class="mb-3 mt-3">
                        <label for="email" class="mb-2">Username | Email</label>
                        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="mb-2">Password</label>
                        <div class="showhidepwd" style="position:relative">
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
                        <div style="position:absolute;right:12px;top:6px">
                           <a href="#" class="showpwd"><i class="fa-solid fa-eye"></i></a>
                           <a href="#" class="hidepwd"><i class="fa-solid fa-eye-slash"></i></a>
                        </div>
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember"> Remember me
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script>
$(document).ready(function() {
    $("#login").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/admin/login",
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res == true) {
                    $("#login")[0].reset();
                    window.location.reload('/admin/dashboard');
                } else {
                    alert("Username and Password is incorrect");
                }
            }
        });
    });
});

</script>

<script>
$(document).ready(function() {
    $('.hidepwd').click(function(){
      $('.showhidepwd input').attr("type", "text");
      $('.showpwd').show();
      $('.hidepwd').hide();
    });
});
</script>

<script>
$(document).ready(function() {
    $('.showpwd').click(function(){
      $('.showhidepwd input').attr("type", "password");
      $('.showpwd').hide();
      $('.hidepwd').show();
    });
});
</script>

</body>

</html>