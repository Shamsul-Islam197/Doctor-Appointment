<?php
	include 'connection.php';
	$query = "SELECT * FROM department";
	$result = mysqli_query($con,$query);
	
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="home.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <title>Home</title>
<body>
  <div class="sidebar close">
    <div class="logo-details">
      <i class='bx bx-plus-medical'></i>
      <span class="logo_name">Aalok</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="#">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-buildings' ></i>
            <span class="link_name">Branch</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Branch</a></li>
          <li><a href="#">Unit-1</a></li>
          <li><a href="#">Hospital</a></li>
          <li><a href="#">Unit-2</a></li>
          <li><a href="#">Unit-3</a></li>
          <li><a href="#">Unit-4</a></li>
          <li><a href="#">Unit-5</a></li>
        </ul>
      </li>
      
      
      <li>
    <div class="profile-details">
      <div class="profile-content">
        <!--<img src="image/profile.jpg" alt="profileImg">-->
      </div>
      <div class="name-job">
        <div class="profile_name">User</div>
        <div class="job">Agent</div>
      </div>
      <i class='bx bx-log-out' ></i>
    </div>
  </li>
</ul>
  </div>

  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <span class="text">Doctor Appointment</span>
    </div>

    <div class=card_container>
    <div class="cards-list">

    <?php
      if(mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
    ?>

    <div class="card">
    <div class="card_image">
    <?php echo '<img src="data:image;base64,'.base64_encode($row['img']).'" >';?>
    </div>
    <div class="card_title title-white">
    <p><?php echo $row['dept_name']; ?></p>
    </div>
    </div>

    <?php
         }
      }
        ?>


    </div>
    </div>
  </section>
  
</body>
</html>




  <script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });

  </script>
