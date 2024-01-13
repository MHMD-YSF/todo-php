<?php  
	session_start();
	if(isset($_SESSION['email'])){
	include('../includes/connection.php');
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	
        .form-control {
			width: 200%;
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
	<h3>Create a new Task</h3><br>
	<div class="row">
		<div class="col-md-6">
			<form  backaction="" method="post">
				<div class="form-group">
					<label>Select user:</label>
					<select name="id" class="form-control">
						<option>-Select-</option>
						<?php  
							$query = "select uid,name from users";
					        $query_run = mysqli_query($connection,$query);
					        if(mysqli_num_rows($query_run)){
					            while($row = mysqli_fetch_assoc($query_run)){
					                ?>
					                <option value="<?php echo $row['uid']; ?>"><?php echo $row['name']; ?></option>
					            <?php
					            }
					        }
						?>
					</select>
				</div>
				<div   class="form-group">
					<label>Description:</label>
					<textarea class="form-control" rows="3" cols="50" name="description" placeholder="Mention the task"></textarea>
				</div>
				<div class="form-group">
					<label>Start date:</label>
					<input  type="date" class="form-control" name="start_date" />
				</div>
				<div class="form-group">
					<label>End date:</label>
					<input type="date" class="form-control" name="end_date" placeholder="Start date" />
				</div>
				<div class="form-group">
    				<label>Priority:</label>
   					<select name="priority" class="form-control">
        			<option value="high">High</option>
        			<option value="medium">Medium</option>
       				<option value="low">Low</option>
    				</select>
				</div>

				<input  type="submit" class="btn btn-warning" name="create_task" value="Create" placeholder="End date" />
			</form>
		</div>
	</div>
</body>
</html>
<?php  
}
else{
    header('Location:admin_login.php');
}
?>