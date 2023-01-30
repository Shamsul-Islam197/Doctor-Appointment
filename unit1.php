<?php
include 'connection.php';
include 'log.php';
$query = "SELECT * FROM department where branch_id like '%1%' ";
$result = mysqli_query($con, $query);

if (isset($_POST['search_btn'])) {
  $search = $_POST['search'];
  $query = "SELECT * FROM department where branch_id like '%1%' and dept_name like '%$search%' ";
  $result = mysqli_query($con, $query);
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

      <form action="unit1.php" method="post">
        <div class="search">
          <input type="text" class="searchTerm" name="search" placeholder="Search Here">
          <button type="submit" class="searchButton" name="search_btn">
            <i class='bx bx-search bx-lg'></i>
          </button>
        </div>
    </div>
    </form>

    <div class="card_container" id="dept_list">
      <div class="cards-list">
        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
        ?>
            <a href="doctorview.php?department=<?php echo $row['dept_name'] ?>">
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

  </section>
</body>

</html>
<script>
  $.get("nav.php", function(data) {
    $("#nav-placeholder").replaceWith(data);
  });
</script>