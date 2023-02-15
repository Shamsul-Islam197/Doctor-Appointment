<?php
include 'connection.php';
include 'log.php';
$apnt_date = $_SESSION['apnt_date'];


if (isset($_GET['doc_id'])) {
  $_SESSION['doc_id'] = $_GET['doc_id'];
  $doc_id = $_GET['doc_id'];
  $query = "SELECT slot,report_slot FROM `doctor_info` where id='$doc_id'";
  $result = mysqli_query($con, $query);
  while ($row = mysqli_fetch_array($result)) {
    $n = $row['slot'];
    $m = $row['report_slot'];
  }
  $query2 = "DELETE FROM appointment_info WHERE slot_status='selected' and `time` < (NOW() - INTERVAL 01 MINUTE)";
  mysqli_query($con, $query2);
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
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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

    <!-- Slot for New Patient -->
    <div id="New_patient">
      <h3>New Patient</h3>
      <div class="slot-sec">
        <?php
        for ($i = 1; $i <= $n; $i++) {
          $query2 = "SELECT * FROM `appointment_info` where slot='$i' AND date= '$apnt_date' AND doc_id='$doc_id' AND appointment_type='New Patient' AND slot_status='selected'";
          $query3 = "SELECT * FROM `appointment_info` where slot='$i' AND date= '$apnt_date' AND doc_id='$doc_id' AND appointment_type='New Patient' AND slot_status='booked'";
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

    <!-- Slot for Report Check -->
    <div id="report_check">
      <h3>Report Check</h3>
      <div class="report_check">
        <?php
        for ($i = 1; $i <= $m; $i++) {
          $query2 = "SELECT * FROM `appointment_info` where slot='$i' AND date= '$apnt_date' AND doc_id='$doc_id' AND appointment_type='Report Check' AND slot_status='selected'";
          $query3 = "SELECT * FROM `appointment_info` where slot='$i' AND date= '$apnt_date'  AND doc_id='$doc_id' AND appointment_type='Report Check' AND slot_status='booked'";
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
      <select name="app_type" id="app_type" class="apnt_btn">
        <option value="New Patient">New Patient</option>
        <option value="Report Check">Report Check</option>
      </select>
      <input type="text" class="input" name="name" id="name" placeholder="Name">
      <input type="text" class="input" name="age" id="age" placeholder="Age">
      <input type="text" class="input" name="phone" id="phone" placeholder="Phone">
      <input type="text" class="input" name="address" id="address" placeholder="Address">
      <input type="hidden" name="doc_id" id="doc_id" value="<?php echo $doc_id ?>">
      <input type="button" class="apnt_btn" id="apnt_btn" value="Submit">
    </div>





    <div class="modal fade" id="modelWindow" role="dialog">
      <div class="modal-dialog modal-sm vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Heading</h4>
          </div>
          <div class="modal-body">
            Body text here
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
          </div>
        </div>
      </div>
    </div>


    <div id="new_patient" class="table_div">
      <table>
        <thead>
          <tr>
            <th>Slot</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="table_result">
        </tbody>
      </table>
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
      var app_type = $("#app_type").val();
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
            app_type: app_type,
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
              $('#New_patient').load(location.href + ' #New_patient');
              $('#report_check').load(location.href + ' #report_check');
              $('#error').html('Slot ' + slot + ' is not available !');
              $box.prop("checked", false);
            }
          }
        });
      } else {
        $box.prop("checked", false);
        $.ajax({
          url: "function.php",
          type: "POST",
          data: {
            type: "uncheck",
            slot: slot,
            app_type: app_type,
            doc_id: doc_id
          },
          cache: false,
          success: function(dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
              $("#success").show();
              $("#error").hide();
              $('#success').html('Slot ' + slot + ' Deselected');
            }
          }
        });
      }
    });


    $("#apnt_btn").on("click", function() {
      var app_type = $("#app_type").val();
      var name = $("#name").val();
      var age = $("#age").val();
      var phone = $("#phone").val();
      var address = $("#address").val();
      var doc_id = $('#doc_id').val();

      if (app_type != "" && name != "" && slot_id != "") {
        $.ajax({
          url: "function.php",
          type: "POST",
          data: {
            type: "book",
            app_type: app_type,
            slot: slot_id,
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
              $("#name").val("");
              $("#age").val("");
              $("#phone").val("");
              $("#address").val("");
              $("#error").hide();
              $("#success").html("Appointment booked!");
              $('#New_patient').load(location.href + ' #New_patient');
              $('#report_check').load(location.href + ' #report_check');
              showdata();
            } else if (dataResult.statusCode == 201) {
              $("#error").show();
              $("#error").html("Something went wrong !");
            }
          },
        });
      } else {
        $("#error").show();
        $("#error").html("Please fill all the required feild !");
      }
    });

  });



  function showdata() {
    var app_type = $("#app_type").val();
    $.ajax({
      url: "function.php",
      type: "POST",
      data: {
        type: "table",
        app_type: app_type
      },
      cache: false,
      success: function(data) {
        $('#table_result').html(data);
      }
    });
  }
  showdata();





  var select = document.getElementById('app_type');
  var slot = document.getElementById('New_patient');
  var slot2 = document.getElementById('report_check');
  var new_patient_table = document.getElementById('new_patient_table');
  var report_table = document.getElementById('report_table');
  slot2.style.visibility = 'hidden';
  select.addEventListener('change', function handleChange(event) {
    if (event.target.value === 'New Patient') {
      showdata();
      slot.style.visibility = 'visible';
      slot2.style.visibility = 'hidden';

    } else if (event.target.value === 'Report Check') {
      showdata();
      slot.style.visibility = 'hidden';
      slot2.style.visibility = 'visible';

    }

  });
</script>