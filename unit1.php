<?php
	include 'connection.php';
  $view = 0;

  $query = "SELECT * FROM department where branch_id like '%1%' ";
  $result = mysqli_query($con,$query);

    if(isset($_GET['department'])){
        $dept = $_GET['department'];
        $query = "SELECT * FROM `doctor_info` where department='".$dept."'";
        $result2 = mysqli_query($con,$query);
        $view = 1;
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
    

    
    <title>Unit 01</title>
</head>
<body>
<div id="nav-placeholder">

</div>
<script>
$.get("nav.php", function(data){
    $("#nav-placeholder").replaceWith(data);
});
</script>

<section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <span class="text">Main Branch</span>
    </div>
    
    <div class="card_container" id="dept_list">
    <div class="cards-list">

    <?php
      if(mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
    ?>
    <a href="unit1.php?department=<?php echo $row['dept_name'] ?>">
    <div class="card" id="show_doc">
    <div class="card_image">
    <?php echo '<img src="data:image;base64,'.base64_encode($row['img']).'" >';?>
    </div>
    <div class="card_title title-white">
    <p><?php echo $row['dept_name']; ?></p>
    </div>
    
    </div>
    </a>

    <?php
         }
      }
        ?>
    </div>
    </div>


    <div class="card_container" id="dept_doctor">
    <div class="cards-list" >

    <?php
    if($view==1){
      if(mysqli_num_rows($result2) > 0) {
          while ($row = mysqli_fetch_array($result2)) {
    ?>
    <div class="card" id="myBtn">
    <div class="card_image">
    <?php echo '<img src="data:image;base64,'.base64_encode($row['img']).'" >';?>
    </div>
    <div class="card_title_doctor title-white">
    <p><?php echo $row['name']; ?></p>
    </div>

    </div>
    </a>
    <div id="myModal" class="modal">
<div class="modal-content">
  <span class="close">&times;</span>
  <p><?php echo "Name: ".$row['name']; ?></p>
  <hr>
  <p><?php echo "Department: ".$row['department']; ?></p>
  <hr>
  <p><?php echo "Designation: ".$row['designation']; ?></p>
  <hr>
  <p><?php echo "Degree: ".$row['degree']; ?></p>
  <hr>
  <p><?php echo "Institute: ".$row['institute']; ?></p>
  <hr>
  <p><?php echo "Schedule: ".$row['chamber_day'].", ".$row['chamber_time']; ?></p>
  <hr>
  <p><?php echo "Visit: ".$row['first_visit'].", ".$row['second_visit'].", ".$row['report']; ?></p>
</div>
</div>


    <?php
         }
      }
    }
        ?>
    </div>
    </div>

 



    </section>
</body>
</html>

<script>
if(('<?php echo $view;?>')==0){
      document.getElementById("dept_list").style.display = "block";
      document.getElementById("dept_doctor").style.display = "none";
    
    }else{
        document.getElementById("dept_doctor").style.display = "block";
        document.getElementById("dept_list").style.display = "none";
    }


var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}



</script>
