<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="//code.jquery.com/jquery.min.js"></script>
    <title>Home</title>
</head>

<body>
    <div id="nav-placeholder">

    </div>
    <script>
        $.get("nav.php", function(data) {
            $("#nav-placeholder").replaceWith(data);
        });
    </script>

    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Doctor Appointment</span>
        </div>

    </section>
</body>

</html>