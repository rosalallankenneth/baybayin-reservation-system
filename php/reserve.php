<?php
    require_once 'dbh.inc.php';
    session_start();

    $date = mysqli_real_escape_string($con, $_POST['date']);
    $time = (int) mysqli_real_escape_string($con, $_POST['time']);
    $type = mysqli_real_escape_string($con, $_POST['type']);

    if(empty($date) || empty($time) || empty($type)) {
        echo 'There are required fields that are empty.';
        exit();
    }
    
    $today = date("Y-m-d");

    if($date < $today) {
        echo "The reservation date has expired.";
        exit();
    }

    date_default_timezone_set("Asia/Manila");
    $now = (int) date("G");

    if($date == $today && $now >= $time) {
        echo "The reservation time has expired.";
        exit();
    }

    $rtime = "";

    if($time == 11) {
        $rtime = $time."AM - ".++$time."PM";
    } else if($time == 12) {
        $rtime = $time."PM - 1PM";
    } else if($time < 12) {
        $rtime = $time."AM - ".++$time."AM";
    } else if($time > 12) {
        $time = $time % 12;
        $rtime = $time."PM - ".++$time."PM";
    }
    
    $email = $_SESSION['user-email'];
    $sql = "INSERT INTO reservations (email, date, time, type, status) VALUES ('$email', '$date', '$rtime', '$type', 'PENDING')";
    mysqli_query($con, $sql) or die ("Unable to execute query. Error: ".mysqli_error($con));

    echo 'Your reservation has been submitted. We will notify you of the confirmation through your email and mobile number. Thank you!';

?>