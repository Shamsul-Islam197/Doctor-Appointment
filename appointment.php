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

    
<div class="slot">
<?php
      if(mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
            for($i=1;$i<=$row['slot'];$i++){
                ?>
      <div class="slot_btn">
      <input type="checkbox" id="slot" name="slot" value="<?php echo $i;?>">
      <label for="slot"><?php echo $i;?></label><br>
      </div>
      <?php
            }
          }
        }
?>
    </div>
  
</section>
   
    
</body>
</html>

<script>
    $.get("nav.php", function(data){
    $("#nav-placeholder").replaceWith(data);
    });

    $("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
</script>