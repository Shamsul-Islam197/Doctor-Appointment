<?php
include 'connection.php';
include 'log.php';

if (isset($_GET['department'])) {
    $_SESSION['dept'] = $_GET['department'];
}

$dept = $_SESSION['dept'];
$shift = "";
$search = "";
$date = date("d/m/Y");
$day = date('D');
$query = "SELECT * FROM `doctor_info` Where department like '%$dept%' and chamber_day like '%$day%'";
$result = mysqli_query($con, $query);



if (isset($_POST['search_btn'])) {
    if (isset($_POST['shift'])) {
        $shift = $_POST['shift'];
    }
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
    }
    if (isset($_POST['date'])) {
        $date = $_POST['date'];
        $day = date('D', strtotime($date));
    }
    if (empty($_POST['date'])) {
        $day = date('D');
    }
    $query = "SELECT * FROM `doctor_info` where department='" . $dept . "' and name like '%$search%' and chamber_time like '%$shift%'  and chamber_day like '%$day%'";
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
    <title>Doctor View</title>
</head>

<body>

    <div id="nav-placeholder">
    </div>

    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Doctor View</span>

            <form action="doctorview.php" method="post">
                <div class="search">
                    <select name="shift" class="select">
                        <option value="" disabled selected hidden>Shift</option>
                        <option value="morning">Morning</option>
                        <option value="evening">Evening</option>
                    </select>
                    <input type="date" name="date" class="date" id="date" placeholder="dd-mm-yyyy">
                    <input type="text" class="searchTerm" name="search" placeholder="Search Here">
                    <button type="submit" class="searchButton" name="search_btn">
                        <i class='bx bx-search bx-lg'></i>
                    </button>

                </div>
        </div>
        </form>

        <div class="card_container" id="dept_doctor">
            <div class="cards-list">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
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