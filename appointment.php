<?php include 'connection.php';

if(isset($_GET['doc_id'])){
    $doc_id = $_GET['doc_id'];
    $query = "SELECT * FROM `doctor_info` where id='".$doc_id."'";
    $result = mysqli_query($con,$query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Appointment</title>
</head>
<body>
<div id="nav-placeholder">
</div>
<section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <span class="text">Unit-02</span>
    </div>

<form id="slotForm" method="post">
  

<div class="slot" >
<?php
      if(mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
            for($i=1;$i<=$row['slot'];$i++){
                ?>
      <div class="slot_btn">
      <input type="checkbox" name="slot" value="<?php echo $i;?>">
      <label for="slot"><?php echo $i;?></label><br>
      <input type="hidden" name="doc_id" id="doc_id" value="<?php echo $doc_id?>" />
      </div>
      <?php
            }
          }
        }
?>

    </div>
</form>    
  
</section>
   
    
</body>
</html>

<script>
    $.get("nav.php", function(data){
    $("#nav-placeholder").replaceWith(data);
    });

    $("input:checkbox").on('click', function() {
  var $box = $(this);
  if ($box.is(":checked")) {
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});


$(document).ready(function(){
    $("#slotForm").on("change", "input:checkbox", function(){
      var slot = $(this).val();
		var doc_id = $('#doc_id').val();
			$.ajax({
				url: "slot.php",
				type: "POST",
				data: {
					slot: slot,
					doc_id: doc_id						
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
            alert('Slot '+slot+' selected');						
					}
					else if(dataResult.statusCode==201){
						$('#error').html('Slot is booked !');
					}
        }
			});
    });
});
</script>