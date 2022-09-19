<?php
    require_once 'dbh.inc.php';
    session_start();

    date_default_timezone_set("Asia/Manila");
    $today = date("Y-m-d");

    $email = $_SESSION['user-email'];
    $sql = "SELECT * FROM reservations WHERE date >= CURDATE() AND email='$email' ORDER BY date";
    $result = mysqli_query($con, $sql) or die("Database error: ".mysqli_error($con));

    if(mysqli_num_rows($result) > 0) {
        echo "<tr><th>ID</th><th>Date</th><th>Time</th><th>Table type</th><th>Status</th><th>Action</th></tr>";

		while($row = mysqli_fetch_assoc($result)) {

            $date = date("F j, Y", strtotime($row['date']));

            echo "<tr><td>".$row['id']."</td><td>".$date."</td><td>".$row['time']."</td><td>Table for ".$row['type']."</td><td>".$row['status']."</td>";
            if($row['status'] != "CANCELED") {
                echo "<td><button id='cancel-".$row['id']."' class='btn-cancel btn btn-danger btn-sm'>Cancel</button></td></tr>";
            } else {
                echo "<td></td></tr>";
            }
        }
        
    } else {
        echo "No reservations";
    }

?>