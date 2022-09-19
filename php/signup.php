<?php
    require_once 'dbh.inc.php';

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);


    if(empty($email) || empty($password) || empty($lname) || empty($fname) || empty($mobile)) {
        echo 'There are required fields that are empty.';
        exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email.';
        exit();
    } else if((strlen($password) < 6)) {
        echo 'Invalid password. It must contain at least 6 characters.';
        exit();
    } else if(strlen($mobile) < 11 && is_numeric($mobile)) {
        echo 'Invalid mobile number.';
        exit();
    }
    
    $sql = "SELECT email, mobile FROM customers WHERE email='$email' OR mobile='$mobile'";
    $result = mysqli_query($con, $sql) or die ("Cannot execute query. Error: ".mysqli_error($con));
    $row = mysqli_fetch_assoc($result);
    
    if(mysqli_num_rows($result) > 0) {
        echo 'The email and/or mobile number is already taken.';
        exit();
    } else {
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO customers VALUES ('$email', '$lname', '$fname', '$mobile', '$hashedPass')";
        mysqli_query($con, $sql) or die ("Unable to execute query. Error: ".mysqli_error($con));

        echo 'Your account with an email of '.$email.' was registered successfully.';
    }

?>