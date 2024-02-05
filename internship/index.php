<?php 

    session_start();
    require_once 'config/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h3 class="mt-4">Register</h3>
        <hr>
        <form action="signup_db.php" method="post">
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php 
                        echo $_SESSION['warning'];
                        unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="usernamel" class="form-label">Username</label>
                <input type="text" class="form-control" name="usernamel">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="mb-3">
                <label for="confirm password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="c_password">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="email">
            </div>

            <div class="mb-3">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" class="form-control" name="firstname" aria-describedby="firstname">
            </div>

            <div class="mb-3">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" class="form-control" name="lastname" aria-describedby="lastname">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" name="phone" id="phoneInput" pattern="[0-9]{10}" title="Please enter a valid 10-digit phone number" oninput="validatePhone()">
                <small id="phoneError" class="text-danger"></small>
            </div>
            <script>
            function validatePhone() {
                var phoneInput = document.getElementById('phoneInput');
                var phoneError = document.getElementById('phoneError');

                    if (!/^[0-9]{10}$/.test(phoneInput.value)) {
                        phoneError.textContent = 'Please enter a valid 10-digit phone number';
                    } else {
                        phoneError.textContent = '';
                    }
            }
            </script>

            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="dob">
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                    <div>
                         <input type="radio" name="gender" value="male" class="gender-input"> Male
                        <input type="radio" name="gender" value="female" class="gender-input"> Female
                    </div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address">
            </div>

            <div class="mb-3">
                <label for="workex" class="form-label">Work Experience</label>
                <input type="text" class="form-control" name="workex">
            </div>
            

            <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
        </form>
        <hr>
        <p>Do you already have an account? Click here to <a href="signin.php">Login</a></p>
    </div>
    
</body>
</html>