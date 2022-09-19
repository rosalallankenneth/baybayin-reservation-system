<?php
    require_once "dbh.inc.php";
    session_start();

    $oldPass = mysqli_real_escape_string($con, $_POST['oldPass']);
    $newPass = mysqli_real_escape_string($con, $_POST['newPass']);
    $retype = mysqli_real_escape_string($con, $_POST['retype']);
    $newMobile = mysqli_real_escape_string($con, $_POST['mobile']);

    $email = $_SESSION['user-email'];

    $sql = "SELECT * FROM customers WHERE email='$email'";
    $results = mysqli_query($con, $sql) or die("Unable to execute query: ".mysqli_error($con));
    $row = mysqli_fetch_assoc($results);
    $match = password_verify($oldPass, $row['password']);

    $sqlm = "SELECT * FROM customers WHERE mobile='$newMobile'";
    $resultsm = mysqli_query($con, $sqlm) or die("Unable to execute query: ".mysqli_error($con));

    if(empty($oldPass) || empty($newPass) || empty($retype) || empty($newMobile)) {
        echo "Empty field(s)";
        exit();
    } else if($match == false) {
        echo "Incorrect old password.";
        exit();
    } else if(strlen($newPass) < 6 || strlen($oldPass) < 6) {
        echo "Invalid password(s). Password must consist of at least 6 characters.";
        exit();
    } else if($newPass != $retype) {
        echo "Your new password and retyped new password does not match.";
        exit();
    } else if(strlen($newMobile) < 11 && is_numeric($mobile)) {
        echo 'Invalid mobile number.';
        exit();
    } else if($newMobile != $row['mobile'] && mysqli_num_rows($resultsm) > 0) {
        echo 'Mobile number already exists.';
        exit();
    }
    
    $hashedPass = password_hash($newPass, PASSWORD_DEFAULT);

    $sql = "UPDATE customers SET password='$hashedPass', mobile='$newMobile' WHERE email='$email'";
    $results = mysqli_query($con, $sql) or die("Unable to execute query: ".mysqli_error($con));

    echo "Account settings was updated successfully.";

?>