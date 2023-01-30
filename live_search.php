<!DOCTYPE html>
<html>

<head>
    <title>Live Search Example</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</head>

<body>
    <div id="nav-placeholder">
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Main Branch</span>
            <input type="text" class="form-control" name="live_search" id="live_search" autocomplete="off" placeholder="Search ...">
        </div>



        <table class="fl-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="search_result">

            </tbody>
        </table>



    </section>
</body>

</html>

<script type="text/javascript">
    $.ajax({
        url: "search.php",
        type: "POST",
        cache: false,
        success: function(data) {
            $('#search_result').html(data);
        }
    });
    $(document).ready(function() {
        $("#live_search").keyup(function() {
            var query = $(this).val();
            if (query != "") {
                $.ajax({
                    url: 'search.php',
                    method: 'POST',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#search_result').html(data);
                        $('#search_result').css('display', 'block');
                        $("#live_search").focusout(function() {
                            $('#search_result').css('display', 'none');
                        });
                        $("#live_search").focusin(function() {
                            $('#search_result').css('display', 'block');
                        });
                    }
                });
            } else {
                $.ajax({
                    url: "search.php",
                    type: "POST",
                    cache: false,
                    success: function(data) {
                        $('#search_result').html(data);
                    }
                });
            }
        });
    });

    $.get("nav.php", function(data) {
        $("#nav-placeholder").replaceWith(data);
    });
</script>