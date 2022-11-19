 <?php
  session_start();
  ?>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
 <div class="sidebar close">
   <div class="logo-details">
     <i class='bx bx-plus-medical'></i>
     <span class="logo_name">Aalok</span>
   </div>
   <ul class="nav-links">
     <li>
       <a href="#">
         <i class='bx bx-grid-alt'></i>
         <span class="link_name">Dashboard</span>
       </a>
       <ul class="sub-menu blank">
         <li><a class="link_name" href="#">Dashboard</a></li>
       </ul>
     </li>
     <li>
       <div class="iocn-link">
         <a href="#">
           <i class='bx bx-buildings'></i>
           <span class="link_name">Branch</span>
         </a>
         <i class='bx bxs-chevron-down arrow'></i>
       </div>
       <ul class="sub-menu">
         <li><a class="link_name" href="#">Branch</a></li>
         <li><a href="unit1.php">Unit-1</a></li>
         <li><a href="hospital.php">Hospital</a></li>
         <li><a href="unit2.php">Unit-2</a></li>
         <li><a href="unit3.php">Unit-3</a></li>
         <li><a href="unit4.php">Unit-4</a></li>
       </ul>
     </li>


     <li>
       <div class="profile-details">
         <div class="profile-content">
           <img src="user.png" alt="profileImg">
         </div>
         <div class="name-job">
           <div class="profile_name"><?php echo $_SESSION['username'] ?></div>
           <div class="job">Agent</div>
         </div>
         <a href="#" id="logout">
           <i class='bx bx-log-out'></i>
         </a>
       </div>
     </li>
   </ul>
 </div>

 <script>
   let arrow = document.querySelectorAll(".arrow");
   for (var i = 0; i < arrow.length; i++) {
     arrow[i].addEventListener("click", (e) => {
       let arrowParent = e.target.parentElement.parentElement;
       arrowParent.classList.toggle("showMenu");
     });
   }
   let sidebar = document.querySelector(".sidebar");
   let sidebarBtn = document.querySelector(".bx-menu");
   console.log(sidebarBtn);
   sidebarBtn.addEventListener("click", () => {
     sidebar.classList.toggle("close");
   });

   $("#logout").click(function() {
     swal({
         title: "Are you sure?",
         text: "",
         type: "warning",
         showCancelButton: true,
         confirmButtonColor: "#DD6B55",
         confirmButtonText: "Yes, log out!",
         cancelButtonText: "Cancel!",
         closeOnConfirm: false,
         closeOnCancel: true
       },
       function(isConfirm) {
         if (isConfirm) {
           $.ajax({
             url: "function.php?logout",
             success: function() {
               window.location.href = 'login.php';
             },
           });
         }
       });
   });
 </script>