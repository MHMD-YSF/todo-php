<?php
$connection = mysqli_connect("localhost", "root", "", "tms_db2");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $uid = $_POST['uid'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if a new password is provided
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Update the user's profile with the new hashed password
            $sql = "UPDATE users SET name=?, email=?, password=? WHERE uid = ?";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $hashedPassword, $uid);
        } else {
            // Update the user's profile without changing the password
            $sql = "UPDATE users SET name=?, email=? WHERE uid = ?";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $uid);
        }

        if (mysqli_stmt_execute($stmt)) {
            header('Location: admin_dashboard.php');
            exit;
        } else {
            $error_message = 'Error updating user: ' . mysqli_error($connection);
        }

        mysqli_stmt_close($stmt);
    }
}

if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    $user = mysqli_query($connection, "SELECT * FROM users WHERE uid =" . $uid);
    $meta = mysqli_fetch_assoc($user);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
<style>/* Apply basic styling to the body */
body 
        .form-control {
			width: 100%;
            background: #ED9AD6;
			backdrop-filter: blur(20px);
			opacity:0.5 ;
            border: none; /* Add an optional bottom border if needed */
            padding: 10px; /* Increase the padding to make the input larger */
            color: white; /* Set the text color */
			
           
        }
		.form-control::placeholder {
            color: white; /* Set the placeholder color */
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.7); /* Slightly opaque when focused */
        }.btn-warning{
			background: #ED9AD6;
			backdrop-filter: blur(20px);
			opacity:0.5 ;
            border: none; /* Add an optional bottom border if needed */
            padding: 10px; /* Increase the padding to make the input larger */
            color: white; /* Set the text color */
			
		}label {
    color: white; /* Change this to the color you prefer, e.g., red (#ff0000) */
}h3{color:white;}
		
  
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>
    <!-- Include your CSS and JavaScript dependencies here -->
</head>
<body>
    <div class="container-fluid">
        <div id="msg"><?php echo isset($error_message) ? '<div class="alert alert-danger">' . $error_message . '</div>' : ''; ?></div>
        
        <form action="" id="manage-user" method="post">    
		<input type="hidden" name="uid" value="<?php echo isset($uid) ? $uid : ""; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="<?php echo isset($meta['email']) ? $meta['email']: '' ?>" required autocomplete="off">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
            </div>
            
                <button type="submit" class="btn btn-warning" name="submit">Save</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            
        </form>
    </div>
</body>
</html>
