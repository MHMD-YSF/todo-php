<?php
session_start();
include('includes/connection.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve the hashed password and role from the database
    $query = "SELECT email, password, name, uid, role FROM users WHERE email = '$email'";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $row = mysqli_fetch_assoc($query_run);
        $hashedPassword = $row['password'];
        $userRole = $row['role'];

        // Verify the entered password against the hashed password using password_verify
        if (password_verify($password, $hashedPassword)) {
            // Password is correct

            $_SESSION['email'] = $email;
            $_SESSION['name'] = $row['name'];
            $_SESSION['uid'] = $row['uid'];

            if ($userRole === 'admin') {
                // Redirect to the admin dashboard
                header("Location: admin/admin_dashboard.php");
                exit();
            } else {
                // Redirect to the user dashboard
                header("Location: user_dashboard.php");
                exit();
            }
        } else {
            // Password is incorrect
            echo "<script type='text/javascript'>
                alert('Please enter correct email and password.');
            </script>";
        }
    } else {
        // No user with the provided email found
        echo "<script type='text/javascript'>
            alert('Please enter correct email and password.');
        </script>";
    }
}

if (isset($_POST['userRegistration'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $mobile = $_POST['mobile'];

    $query = "INSERT INTO users (name, email, password, mobile) VALUES ('$name', '$email', '$hashedPassword', '$mobile')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo "<script type='text/javascript'>
            alert('User registered successfully....');
            window.location.href = 'index.php';  
        </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Error...Plz try again.');
            window.location.href = 'index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login & Signup Form | CodingNepal</title>
    <link rel="stylesheet" href="css/stylelogin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="wrapper">
    <div class="title-text">
        <div class="title login">Login Form</div>
        <div class="title signup">Signup Form</div>
    </div>
    <div class="form-container">
        <div class="slide-controls">
            <input type="radio" name="slide" id="login" checked>
            <input type="radio" name="slide" id="signup">
            <label for="login" class="slide login">Login</label>
            <label for="signup" class="slide signup">Signup</label>
            <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
            <form action="index.php" class="login" method="POST">
                <div class="field">
                    <input type="text" placeholder="Email Address" name="email" required>
                </div>
                <div class="field">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="pass-link"><a href="#">Forgot password?</a></div>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Login" name="login">
                </div>
                <div class="signup-link">Not a member? <a href="#">Signup now</a></div>
            </form>
            <form action="index.php" class="signup" method="POST">
                <div class="field">
                    <input type="text" placeholder="Email Address" name="email" required>
                </div>
                <div class="field">
                <input type="text"  name="name" placeholder="Enter Username" required>
                </div>
                <div class="field">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="field">
                    <input type="password" placeholder="Confirm password" name="confirm_password" required>
                </div>
                <div class="field">
                    <input type="mobile" placeholder="mobile" name="mobile" required>
                </div>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Signup" name="userRegistration">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const loginText = document.querySelector(".title-text .login");
    const loginForm = document.querySelector("form.login");
    const loginBtn = document.querySelector("label.login");
    const signupBtn = document.querySelector("label.signup");
    const signupLink = document.querySelector("form .signup-link a");
    signupBtn.onclick = (() => {
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
    });
    loginBtn.onclick = (() => {
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
    });
    signupLink.onclick = (() => {
        signupBtn.click();
        return false;
    });
</script>

</body>
</html>