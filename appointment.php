<?php
include 'connection.php';
include 'log.php';

if (isset($_GET['doc_id'])) {
  $doc_id = $_GET['doc_id'];
  $query = "SELECT * FROM `doctor_info` where id='$doc_id'";
  $result = mysqli_query($con, $query);
  while ($row = mysqli_fetch_array($result)) {
    $n = $row['slot'];
  }
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

    <div class="slot-sec">
      <div id="slot_load">
        <?php
        for ($i = 1; $i <= $n; $i++) {
          $query2 = "SELECT * FROM `appointment_info` where slot='$i' AND doc_id='$doc_id' AND slot_status='selected'";
          $query3 = "SELECT * FROM `appointment_info` where slot='$i' AND doc_id='$doc_id' AND slot_status='booked'";
          $result2 = mysqli_query($con, $query2);
          $result3 = mysqli_query($con, $query3);
          if (mysqli_num_rows($result2) > 0) {
        ?>
            <div class="check-div">
              <input type="checkbox" class="checkbox" name="slot" id="slot" value="<?php echo $i; ?>">
              <div><label for="slot" class="selected"><?php echo $i; ?></label></div>
            </div>
            <br>
          <?php
          } else if (mysqli_num_rows($result3) > 0) {
          ?>
            <div class="check-div">
              <input type="checkbox" class="checkbox" name="slot" id="slot" value="<?php echo $i; ?>">
              <div><label for="slot" class="booked"><?php echo $i; ?></label></div>
            </div>
            <br>
          <?php
          } else { ?>
            <div class="check-div">
              <input type="checkbox" class="checkbox" name="slot" id="slot" value="<?php echo $i; ?>">
              <div><label for="slot" class="empty"><?php echo $i; ?></label></div>
            </div>
            <br>
        <?php
          }
        }
        ?>
      </div>
    </div>

    <div class="apnt_form">
      <div class="alert_success" id="success"></div>
      <div class="alert_danger" id="error"></div>
      <input type="date" class="input" name="date" id="date" placeholder="dd-mm-yyyy">
      <input type="text" class="input" name="name" id="name" placeholder="Name">
      <input type="text" class="input" name="age" id="age" placeholder="Age">
      <input type="text" class="input" name="phone" id="phone" placeholder="Phone">
      <input type="text" class="input" name="address" id="address" placeholder="Address">
      <input type="hidden" name="doc_id" id="doc_id" value="<?php echo $doc_id ?>" />
      <input type="button" class="apnt_btn" id="apnt_btn" value="Submit">
    </div>


  </section>
</body>

</html>

<script>
  $.get("nav.php", function(data) {
    $("#nav-placeholder").replaceWith(data);
  });

  $(document).ready(function() {
    var slot_id;
    $("input:checkbox").on('click', function() {
      var $box = $(this);
      var slot = $(this).val();
      slot_id = slot;
      var doc_id = $('#doc_id').val();
      if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);
        $.ajax({
          url: "function.php",
          type: "POST",
          data: {
            type: "select",
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
              $('#slot_load').load(location.href + ' #slot_load');
              $('#error').html('Slot ' + slot + ' is not available !');
              $box.prop("checked", false);
            }
          }
        });
      } else {
        $box.prop("checked", false);
      }
    });


    $("#apnt_btn").on("click", function() {
      var date = $("#date").val();
      var name = $("#name").val();
      var age = $("#age").val();
      var phone = $("#phone").val();
      var address = $("#address").val();
      var doc_id = $('#doc_id').val();

      if (date != "" && name != "" && slot_id != "") {
        $.ajax({
          url: "function.php",
          type: "POST",
          data: {
            type: "book",
            slot: slot_id,
            date: date,
            name: name,
            age: age,
            phone: phone,
            address: address,
            doc_id: doc_id
          },
          cache: false,
          success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
              $("#date").val("");
              $("#name").val("");
              $("#age").val("");
              $("#phone").val("");
              $("#address").val("");
              $("#error").hide();
              $("#success").html("Appointment booked!");
              $('#slot_load').load(location.href + ' #slot_load');
            } else if (dataResult.statusCode == 201) {
              $("#error").show();
              $("#error").html("Something went wrong !");
            }
          },
        });
      } else {
        $("#error").show();
        $("#error").html("Please fill all the required feild !");
        alert(slot_id);
      }
    });

  });
</script>