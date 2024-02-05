<?php 

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['signin'])) {
        $usernamel = $_POST['usernamel'];
        $password = $_POST['password'];

      
        if (empty($usernamel)) {
            $_SESSION['error'] = 'Please enter your username';
            header("location: signin.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'Please enter your password';
            header("location: signin.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'Password must be between 5 and 20 characters long';
            header("location: signin.php");
        } else {
            try {

                $check_data = $conn->prepare("SELECT * FROM users WHERE usernamel = :usernamel");
                $check_data->bindParam(":usernamel", $usernamel);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($usernamel == $row['usernamel']) {
                        if (password_verify($password, $row['password'])) {
                                $_SESSION['user_login'] = $row['id'];
                                header("location: user.php");
                        } else {
                            $_SESSION['error'] = 'Wrong password';
                            header("location: signin.php");
                        }
                    } else {
                        $_SESSION['error'] = 'Wrong user';
                        header("location: signin.php");
                    }
                } else {
                    $_SESSION['error'] = "Account information not found";
                    header("location: signin.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>