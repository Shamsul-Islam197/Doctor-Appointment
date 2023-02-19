<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="login.CSS" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>User Log</title>
</head>

<body>
  <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
        <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 55%)">
          Doctor Appointment<br />
          <span style="color: hsl(218, 81%, 55%)">Aalok Healthcare & Hospital Ltd </span>
        </h1>
        <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 65%)">
          Aalok Healthcare Limited is fastest growing healthcare organization in Health Sector.
          Aalok Healthcare offers you the best service. Aalok offers diagnostic service and as well as the Hospital Service.
        </p>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

        <div class="card bg-glass">
          <div class="card-body px-4 py-5 px-md-5">

            <div class="alert alert-success alert-dismissible" id="success" style="display:none;"></div>
            <div class="alert alert-danger alert-dismissible" id="error" style="display:none;"></div>


            <form id="regForm" method="post" style="display:none;">

              <!-- Name input -->
              <div class="form-outline mb-1">
                <label class="form-label" for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" />
              </div>

              <!-- Designation input -->
              <div class="form-outline mb-1">
                <label class="form-label" for="designation">Designation</label>
                <input type="text" name="designation" id="designation" class="form-control" />
              </div>

              <!-- Phone input -->
              <div class="form-outline mb-1">
                <label class="form-label" for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" />
              </div>

              <!-- Password input -->
              <div class="form-outline mb-1">
                <label class="form-label" for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" />
              </div>

              <!--Confirm Password input -->
              <div class="form-outline mb-1">
                <label class="form-label" for="confPass">Confirm Password</label>
                <input type="password" name="confPass" id="confPass" class="form-control" />
              </div>

              <!-- Username input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" />
              </div>

              <!-- Submit button -->
              <input type="button" value="Sign up" id="but_Signup" class="btn btn-primary btn-block mb-4" />

              <!-- Signin Link -->
              <p class="signin">Already registered?<a class="link" href="#" id="loginShow"> Sign in here</a></p>

            </form>

            <form id="loginForm" method="post">

              <div class="alert alert-success alert-dismissible" id="success" style="display:none;"></div>
              <div class="alert alert-danger alert-dismissible" id="error" style="display:none;"></div>

              <!-- Username input -->
              <div class="form-outline mb-1">
                <label class="form-label" for="username">Username</label>
                <input type="Username" id="log_username" name="username" class="form-control" />
              </div>
              <!--Password input -->
              <div class="form-outline mb-1">
                <label class="form-label" for="Pass">Password</label>
                <input type="password" id="log_Pass" name="password" class="form-control" />
              </div>

              <!-- Submit button -->
              <input type="button" id="but_Signin" value="Sign in" class="btn btn-primary btn-block mb-4" />

              <!-- Signin Link -->
              <p class="signin">Not registered?<a class="link" href="#" id="regShow"> Sign up here</a></p>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  </section>


</body>

</html>

<script>
  $(document).ready(function() {
    $("#loginShow").on("click", function() {
      $("#loginForm").show();
      $("#regForm").hide();
      $("#error").hide();
      $("#success").hide();
    });
    $("#regShow").on("click", function() {
      $("#regForm").show();
      $("#loginForm").hide();
      $("#error").hide();
      $("#success").hide();
    });
    $('#loginForm').keyup(function(e) {
      if (e.keyCode == 13) {
        login();
      }
    });
    $('#regForm').keyup(function(e) {
      if (e.keyCode == 13) {
        reg();
      }
    });
  });

  $("#but_Signin").on("click", function() {
    login();
  });

  $("#but_Signup").on("click", function() {
    reg();
  });


  function reg() {
    var name = $("#name").val();
    var designation = $("#designation").val();
    var phone = $("#phone").val();
    var password = $("#password").val();
    var confPass = $("#confPass").val();
    var username = $("#username").val();

    if (
      name != "" &&
      designation != "" &&
      phone != "" &&
      password != "" &&
      confPass != "" &&
      username != ""
    ) {
      if (password != confPass) {
        alert("Password didn't match !");
      } else {
        $.ajax({
          url: "function.php",
          type: "POST",
          data: {
            type: 1,
            name: name,
            designation: designation,
            phone: phone,
            password: password,
            username: username,
          },
          cache: false,
          success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
              $("#but_Signup").removeAttr("disabled");
              $("#regForm").find("input:text").val("");
              $("#regForm").find("input:password").val("");
              $("#success").show();
              $("#error").hide();
              $("#success").html("Successfully registered!");
            } else if (dataResult.statusCode == 201) {
              $("#error").show();
              $("#error").html("Username already exists !");
            }
          },
        });
      }
    } else {
      $("#error").show();
      $("#error").html("Please fill all the required feild !");
    }
  }


  function login() {
    var username = $("#log_username").val();
    var password = $("#log_Pass").val();
    if (username != "" && password != "") {
      $.ajax({
        url: "function.php",
        type: "POST",
        data: {
          type: 2,
          username: username,
          password: password,
        },
        cache: false,
        success: function(dataResult) {
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {
            location.href = "index.php";
          } else if (dataResult.statusCode == 201) {
            $("#error").show();
            $("#error").html("Invalid Username or Password !");
          }
        },
      });
    } else {
      $("#error").show();
      $("#error").html("Please fill all the required feild !");
    }
  }
</script>