<?php
include 'connection.php';
$view = 0;
$query = "SELECT * FROM department where branch_id like '%1%' ";
$result = mysqli_query($con, $query);

if (isset($_GET['department'])) {
  $dept = $_GET['department'];
  $query = "SELECT * FROM `doctor_info` where department='" . $dept . "'";
  $result2 = mysqli_query($con, $query);
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="script.js"></script>

  <title>Unit 01</title>
</head>

<body>

  <div id="nav-placeholder">
  </div>

  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu'></i>
      <span class="text">Main Branch</span>
    </div>

    <div class="card_container" id="dept_list">
      <div class="cards-list">

        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
        ?>
            <a href="unit1.php?department=<?php echo $row['dept_name'] ?>">
              <div class="card" id="show_doc">
                <div class="card_image">
                  <?php echo '<img src="data:image;base64,' . base64_encode($row['img']) . '" >'; ?>
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
      <div class="cards-list">

        <?php
        if ($view == 1) {
          if (mysqli_num_rows($result2) > 0) {
            while ($row = mysqli_fetch_array($result2)) {
        ?>
              <div class="card" data-toggle="modal" data-target="#myModal<?php echo $row['id'] ?>">
                <div class="card_image">
                  <?php echo '<img src="data:image;base64,' . base64_encode($row['img']) . '" >'; ?>
                </div>
                <div class="card_title_doctor title-white">
                  <p><?php echo $row['name']; ?></p>
                </div>

              </div>
              </a>

              <div id="myModal<?php echo $row['id'] ?>" class="modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-body">
                      <p>Name : <?php echo $row['name']; ?></p>
                      <hr>
                      <p>Designation : <?php echo $row['designation']; ?></p>
                      <hr>
                      <p>Degree : <?php echo $row['degree']; ?></p>
                      <hr>
                      <p>Institute : <?php echo $row['institute']; ?></p>
                      <hr>
                      <p>Schedule : <?php echo $row['chamber_day'] . " , " . $row['chamber_time']; ?></p>
                      <hr>
                      <p>Visit : <?php echo $row['first_visit'] . ", " . $row['second_visit'] . ", " . $row['report']; ?></p>
                      <a class="apnt_btn" href="appointment.php?doc_id=<?php echo $row['id'] ?>">Book Appointment</a>

                    </div>
                  </div>
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
  if (('<?php echo $view; ?>') == 0) {
    document.getElementById("dept_list").style.display = "block";
    document.getElementById("dept_doctor").style.display = "none";

  } else {
    document.getElementById("dept_doctor").style.display = "block";
    document.getElementById("dept_list").style.display = "none";
  }

  $.get("nav.php", function(data) {
    $("#nav-placeholder").replaceWith(data);
  });
</script>