<?php

session_start();
require_once 'config/db.php';

if (isset($_POST['signup'])) {
    $usernamel = $_POST['usernamel'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $workex = $_POST['workex'];

    if (empty($usernamel)) {
        $_SESSION['error'] = 'please enter your username';
        header("location: index.php");
    } else if (empty($password)) {
        $_SESSION['error'] = 'please enter your password';
        header("location: index.php");
    } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
        $_SESSION['error'] = 'Password must be between 5 and 20 characters long';
        header("location: index.php");
    } else if (empty($c_password)) {
        $_SESSION['error'] = 'Please confirm your password.';
        header("location: index.php");
    } else if ($password != $c_password) {
        $_SESSION['error'] = 'Passwords do not match';
        header("location: index.php");
    } else if (empty($email)) {
        $_SESSION['error'] = 'please enter your email';
        header("location: index.php");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format';
        header("location: index.php");
    } else if (empty($firstname)) {
        $_SESSION['error'] = 'please enter your firstname';
        header("location: index.php");
    } else if (empty($lastname)) {
        $_SESSION['error'] = 'please enter your lastname';
        header("location: index.php");
    } else if (empty($phone)) {
        $_SESSION['error'] = 'please enter your phone';
        header("location: index.php");
    } else if (empty($dob)) {
        $_SESSION['error'] = 'please enter your date of birth';
        header("location: index.php");
    } else if (empty($gender)) {
        $_SESSION['error'] = 'please enter your gender';
        header("location: index.php");
    } else if (empty($address)) {
        $_SESSION['error'] = 'please enter your address';
        header("location: index.php");
    } else if (empty($workex)) {
        $_SESSION['error'] = 'please enter your work experience';
        header("location: index.php");
    } else {
        try {
            $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $check_email->bindParam(":email", $email);
            $check_email->execute();
            $row = $check_email->fetch(PDO::FETCH_ASSOC);

            if ($row['email'] == $email) {
                $_SESSION['warning'] = "This email address has already been used <a href='signin.php'>Click here</a> to login";
                header("location: index.php");
            } else {
                $dob_timestamp = strtotime($dob);
                $min_age_timestamp = strtotime('-13 years');

                if ($dob_timestamp > $min_age_timestamp) {
                    $_SESSION['error'] = 'Must be 13 years of age or older';
                    header("location: index.php");
                } else {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users(usernamel, password, email, firstname, lastname, phone, dob, gender, address, workex) 
                                            VALUES(:usernamel, :password, :email, :firstname, :lastname, :phone, :dob, :gender, :address, :workex)");
                    $stmt->bindParam(":usernamel", $usernamel);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":phone", $phone);
                    $stmt->bindParam(":dob", $dob);
                    $stmt->bindParam(":gender", $gender);
                    $stmt->bindParam(":address", $address);
                    $stmt->bindParam(":workex", $workex);
                    $stmt->execute();
                    $_SESSION['success'] = "You have successfully applied for membership! <a href='signin.php' class='alert-link'>Click here</a> to login.";
                    header("location: index.php");
                }
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
