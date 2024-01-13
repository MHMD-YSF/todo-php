<?php
    session_start();
    if(isset($_SESSION['email'])){
    include('includes/connection.php');
    if(isset($_POST['submit_leave'])){
        $query = "insert into leaves values(null,$_SESSION[uid],'$_POST[subject]','$_POST[message]','No Action')";
        $query_run = mysqli_query($connection,$query);
        if($query_run){
          echo "<script type='text/javascript'>
              alert('Form submitted successfully....');
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
        <title>User Dashboard</title>
        <script src="includes/juqery_latest.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/527a10858c.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/styleadmin.css">
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <script type="text/javascript">

            $(document).ready(function(){
                $("#manage_task").click(function(){
                $("#right_sidebar").load("task.php");
                });
            });

            $(document).ready(function(){
                $("#apply_leave").click(function(){
                $("#right_sidebar").load("leaveForm.php");
                });
            });

            $(document).ready(function(){
                $("#view_leave").click(function(){
                $("#right_sidebar").load("leave_status.php");
                });
            });

        </script>
<style>
body {
	margin: 0;
	padding: 0;
	font-family: 'Montserrat', sans-serif;
	 background: -webkit-linear-gradient(left, #a445b2, #fa4299);
}
nav ul {
	margin: 0;
	padding: 0;
	height: 100%;
	width: 260px;
	position: fixed;
	top: 0;
	left: 0;
	background-color: #262626;
}
nav ul li {
	list-style: none;
}
nav ul li a {
	display: block;
	font-family: 'Montserrat', sans-serif;
	text-decoration: none;
	text-transform: uppercase;
	font-size: 20px;
	color: #fff;
	position: relative;
	padding: 25px 0 25px 38px;
}
nav ul li a:before {
	content: '';
	position: absolute;
	top: 0px;
	right: 0px;
	width: 0%;
	height: 100%;
	background:-webkit-linear-gradient(left, #a445b2, #fa4299);
	border-radius: 40px 0px 0px 40px;
	z-index: -1;
	transition: all 300ms ease-in-out;
}
nav ul li a:hover {
	color: #2b2626;
}
nav ul li a:hover:before {
	width: 95%;
}
.wrapper {
	margin-left: 260px;
}
.section {
	display: grid;
	place-items: center;
	min-height: 100vh;
	text-align: center;
}
.box-area h2 {
	text-transform: uppercase;
	font-size: 50px;
}
.box-area p {
	line-height: 2;
}
.box-area {
	width: 75%;
}
.logo {
	width: 150px;
	height: 150px;
	border-radius: 50%;
	overflow: hidden;
	margin: 25px auto;
}
.logo img {
	width: 100%;
}
a {
  text-decoration: none;
}


    </style>
    </head>
    <body>
        <!-- Header code starts here -->
        <div class="row" id="header">
            <div class="col-md-12">
                <div class="col-md-4" style="display: inline-block;">
                    
                </div>
                <div class="col-md-6" style= "text-align: right;display: inline-block;color:white">
                    <b>Email: </b><?php echo $_SESSION['email']; ?>
                    <span style="margin-left:25px;"><b>Name: </b><?php echo $_SESSION['name']; ?></span>
                </div>
            </div>
        </div>
        <nav>
		<div class="row">
			<div id="left_sidebar" class="col-md-2">
		<ul>
			<li class="logo"><img alt="" src="https://i.postimg.cc/WzkCM20g/logo1.png"></li>
			<li>
                <a  style="text-decoration: none;" href="user_dashboard.php"  href="#"  type="button" id="logout_link"><i class="fa fa-home"></i>   Dashboard</a>
			</li>
			<li>
				<a style="text-decoration: none;" type="button"  href="#" id="manage_task"><i class="fa fa-book"></i>   Update  Task</a>
			</li>
			<li>
                <a style="text-decoration: none;" type="button" href="#"  id="apply_leave"><i class="fa fa-users"></i>   Apply Leave </a>
			</li>
			<li>
                <a style="text-decoration: none;" type="button" href="#" id="view_leave"><i class="fa fa-picture-o"></i>   Leave Status</a>
			</li>
			<li>
				<a style="text-decoration: none;" type="button" href="logout.php" id="logout_link"><i class="fa fa-phone"></i>   Logout</a>
			</li>
			</ul>
		</div>
		</div>
	</nav>
    <div class="wrapper">
		<div class="section">
			<div class="box-area">
				<div id="right_sidebar" class="col-md-10">
					<h4>Instructions for Employees</h4>
					<ul style="line-height: 3em;font-size: 1.2em;list-style-type: none;">
						<li>1. All the employee should mark their attendance daily.</li>
						<li>2. Everyone must complete the tasks assigned to them.</li>
						<li>3. Kindly maintain decorum of the office.</li>
						<li>4. Keep office and your area neat and clean.</li>
					</ul>
				</div>
			</div>
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
