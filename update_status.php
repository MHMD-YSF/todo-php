<?php 
    session_start();
    if(isset($_SESSION['email'])){
    include('includes/connection.php');
    if(isset($_POST['update'])){
        $query = "update tasks set status = '$_POST[status]' where tid = $_GET[id]";
        $query_run = mysqli_query($connection,$query);
        if($query_run){
          echo "<script type='text/javascript'>
              alert('Status updated successfully...');
            window.location.href = 'user_dashboard.php';  
          </script>";
        }
        else{
          echo "<script type='text/javascript'>
              alert('Error...Plz try again.');
              window.location.href = 'user_dashboard.php';
          </script>";
        }
    }
?>
<html>
<head>
    <title>ETMS</title>
    <!-- jQuery file -->
    <script src="includes/juqery_latest.js"></script>
    <!-- Bootstrap files -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- External CSS file -->
    <link rel="stylesheet" href="css/styleadmin.css">
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
</head>
<body>
    <div class="row">
        <div class="col-md-3 m-auto" id="home_page">
            <center>
                <h3>Update task status</h3>
                <?php 
                    $query = "select * from tasks where tid = $_GET[id]";
                    $query_run = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($query_run)){
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="hidden" name="id" class="form-control" />
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="status">
                                <option>-Select-</option>
                                <option>Complete</option>
                                <option>In-Progress</option>
                            </select>
                            </div>
                            <button type="submit" class="btn btn-danger btn-warning" name="update">Update</button>
                            <a href="user_dashboard.php" class="btn btn-primary btn-warning">Dashboard</a>
                        </form>
                        <?php
                    }
                 ?>
            </center>
        </div>
    </div>
</body>
</html> 
<?php  
}
else{
    header('Location:user_login.php');
}
?>