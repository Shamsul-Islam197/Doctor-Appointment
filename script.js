$(document).ready(function() {
  $('#loginShow').on('click', function() {
		$("#loginForm").show();
		$("#regForm").hide();
    $("#error").hide();
    $("#success").hide();
	});
	$('#regShow').on('click', function() {
		$("#regForm").show();
		$("#loginForm").hide();
    $("#error").hide();
    $("#success").hide();
	});

    $('#but_Signup').on('click', function() {
    var name = $('#name').val();
    var designation = $('#designation').val();
    var phone = $('#phone').val();
    var password = $('#password').val();
    var confPass = $('#confPass').val();
    var username = $('#username').val();

    if(name!="" && designation!="" && phone!="" && password!="" && confPass!="" && username!=""){
      if(password!=confPass){
        alert("Password didn't match !");
      }else{
      $.ajax({
        url: "function.php",
        type: "POST",
        data: {
          type: 1,
          name: name,
          designation: designation,
          phone: phone,
          password: password,	
          username: username			
        },
        cache: false,
          success: function(dataResult){
              var dataResult = JSON.parse(dataResult);
              if(dataResult.statusCode==200){
                  $("#but_Signup").removeAttr("disabled");
                  $('#regForm').find('input:text').val('');
                  $('#regForm').find('input:password').val('');
                  $("#success").show();
                  $("#error").hide();
                  $('#success').html('Successfully registered!');					
              }
              else if(dataResult.statusCode==201){
                $("#error").show();
                $('#error').html('Username already exists !');
              }
              
          }
      });
    }
      }else{
        alert("Please fill all the reqired field !");
      }
  });
  $('#but_Signin').on('click', function() {
		var username = $('#log_username').val();
		var password = $('#log_Pass').val();
		if(username!="" && password!=""){
			$.ajax({
				url: "function.php",
				type: "POST",
				data: {
					type: 2,
					username: username,
					password: password						
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
            alert('Successfully logged in !');
            location.href = "index.php";						
					}
					else if(dataResult.statusCode==201){
						$("#error").show();
						$('#error').html('Invalid Username or Password !');
					}
        }
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
  });

    

