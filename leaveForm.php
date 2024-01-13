<?php 
	session_start();
	if(isset($_SESSION['email'])){
?>
<head><style>/* Apply basic styling to the body */
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
		
  
</style></head>
<h3>Apply Leave</h3><br>
<div class="row">
	<div class="col-md-6">
		<form action="" method="post">
			<div class="form-group">
			<input class="form-control" type="text" name="subject" placeholder="Enter Subject" />
			</div>
			<div class="form-group">
				<textarea class="form-control" rows="5" cols="50" name="message" placeholder="Type Message"></textarea>
			</div>
			<input type="submit"  class="btn btn-warning" name="submit_leave" />
		</form>
	</div>
</div>
<?php  
}
else{
	header('Location:user_login.php');
}
?>