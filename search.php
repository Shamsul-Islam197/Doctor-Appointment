<?php
require_once "connection.php";

if (isset($_POST['query'])) {
    $query = "SELECT * FROM department WHERE dept_name LIKE '{$_POST['query']}%' LIMIT 100";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($res = mysqli_fetch_array($result)) { ?>

            <tr>
                <td><?= $res['id']; ?></td>
                <td>
                    <?php echo '<img class="table_img" src="data:image;base64,' . base64_encode($res['img']) . '" >'; ?>
                    <?php echo '<p>' . $res['dept_name'] . '</p>'; ?>
                </td>
                <td>View Doctor</td>
            </tr>
        <?php
        }
    }
} else {
    $query = "SELECT * FROM department";
    $result = mysqli_query($con, $query);
    while ($res = mysqli_fetch_array($result)) { ?>

        <tr>
            <td><?= $res['id']; ?></td>
            <td>
                <?php echo '<img class="table_img" src="data:image;base64,' . base64_encode($res['img']) . '" >'; ?>
                <?php echo '<p>' . $res['dept_name'] . '</p>'; ?>
            </td>
            <td>View Doctor</td>
        </tr>
<?php
    }
}
