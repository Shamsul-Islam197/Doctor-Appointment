<?php include 'connection.php';

if (isset($_GET['doc_id'])) {
  $doc_id = $_GET['doc_id'];
  $query = "SELECT * FROM `doctor_info` where id='$doc_id'";
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
      <i class='bx bx-menu'></i>
      <span class="text">Appointment Book</span>
    </div>

    <div class="apnt_sec">

      <form id="slotForm" method="post">
        <div class="slot">
          <?php
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
              for ($i = 1; $i <= $row['slot']; $i++) {
                $query2 = "SELECT * FROM `appointment_info` where slot='$i'";
                $result2 = mysqli_query($con, $query2);
                while ($row2 = mysqli_fetch_array($result2)) {
          ?>
                  <div class="<?php echo $row2['slot_status']; ?>">
                    <input type="checkbox" name="slot" value="<?php echo $i; ?>">
                    <label for="slot"><?php echo $i; ?></label><br>
                    <input type="hidden" name="doc_id" id="doc_id" value="<?php echo $doc_id ?>" />
                  </div>
          <?php
                }
              }
            }
          }
          ?>

        </div>
      </form>

      <div class="apnt_form">
        <div class="alert_success" id="success"></div>
        <div class="alert_danger" id="error"></div>
        <input type="text" class="input" name="name" placeholder="Name">
        <input type="text" class="input" name="age" placeholder="Age">
        <input type="text" class="input" name="phone" placeholder="Phone">
        <input type="text" class="input" name="address" placeholder="Address">
        <input type="button" class="apnt_btn" value="Submit">

      </div>

    </div>

    </div>

  </section>


</body>

</html>

<script>
  $.get("nav.php", function(data) {
    $("#nav-placeholder").replaceWith(data);
  });

  $("input:checkbox").on('click', function() {
    var $box = $(this);
    var slot = $(this).val();
    var doc_id = $('#doc_id').val();
    if ($box.is(":checked")) {
      var group = "input:checkbox[name='" + $box.attr("name") + "']";
      $(group).prop("checked", false);
      $box.prop("checked", true);
      $.ajax({
        url: "slot.php",
        type: "POST",
        data: {
          slot: slot,
          doc_id: doc_id
        },
        cache: false,
        success: function(dataResult) {
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 200) {
            $("#success").show();
            $("#error").hide();
            $('#success').html('Slot ' + slot + ' selected');
          } else if (dataResult.statusCode == 201) {
            $("#success").hide();
            $("#error").show();
            $('#error').html('Slot ' + slot + ' is booked !');
            $box.prop("checked", false);
          }
        }
      });
    } else {
      $box.prop("checked", false);
    }
  });
</script>