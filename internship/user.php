<?php 
    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['user_login'])) {
        $_SESSION['error'] = 'Please login';
        header('location: signin.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>

        h3 {
            font-size: 35px;
            color: #007bff;
            margin-bottom: 27px;
        }

        .table td {
            padding: 9px;
        }

    </style>
</head>

<body>
    <div class="container">
        <?php 
            if (isset($_SESSION['user_login'])) {
                $user_id = $_SESSION['user_login'];
                $stmt = $conn->prepare("SELECT * FROM users WHERE id = :user_id");
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                echo '<h3 class="mt-4">Welcome, ' . $row['firstname'] . ' ' . $row['lastname'] . '</h3>';
                echo '<table class="table">';
                echo '<tr><td>Username</td><td>' . $row['usernamel'] . '</td></tr>';
                echo '<tr><td>Firstname</td><td>' . $row['firstname'] . '</td></tr>';
                echo '<tr><td>Lastname</td><td>' . $row['lastname'] . '</td></tr>';
                echo '<tr><td>Email</td><td>' . $row['email'] . '</td></tr>';
                echo '<tr><td>Phone</td><td>' . $row['phone'] . '</td></tr>';
                echo '<tr><td>Date of Birth</td><td>' . $row['dob'] . '</td></tr>';
                echo '<tr><td>Gender</td><td>' . $row['gender'] . '</td></tr>';
                echo '<tr><td>Address</td><td>' . $row['address'] . '</td></tr>';
                echo '<tr><td>Work Experience</td><td>' . $row['workex'] . '</td></tr>';
                echo '</table>';
            }
        ?>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
