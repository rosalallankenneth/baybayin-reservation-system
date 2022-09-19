<?php
    require_once 'dbh.inc.php';
    session_start();

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);


    if(empty($email) || empty($password)) {
        echo 'There are required fields that are empty.';
        exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email.';
        exit();
    } else if((strlen($password) < 6)) {
        echo 'Invalid password. It must contain at least 6 characters.';
        exit();
    }
    
    $sql = "SELECT email, password FROM customers WHERE email='$email'";
    $result = mysqli_query($con, $sql) or die ("Cannot execute query. Error: ".mysqli_error($con));
    $row = mysqli_fetch_assoc($result);
    
    if(mysqli_num_rows($result) == 0) {
        echo 'The email you entered is not registered.';
        exit();
    } else {
        $checkPwrd = password_verify($password, $row['password']);
        if($checkPwrd == false) {
            echo 'Wrong username and password combination';
            exit();
        }
        $_SESSION['user-email'] = $email;
        echo 'success';
    }

?>