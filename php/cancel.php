<?php
    require_once "dbh.inc.php";

    $id = mysqli_real_escape_string($con, $_POST['id']);

    $sql = "UPDATE reservations SET status='CANCELED' WHERE id='$id'";
    $results = mysqli_query($con, $sql) or die("Unable to execute query: ".mysqli_error($con));

    echo "Reservation was canceled successfully.";

?>