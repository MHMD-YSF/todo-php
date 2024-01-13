<?php
    session_start();    
    if(isset($_SESSION['email'])){
    include('includes/connection.php');
?>
<head> <style>html,
body {
	height: 100%;
}

body {
	margin: 0;
	background:-webkit-linear-gradient(left, #a445b2, #fa4299);
	font-family: sans-serif;
	font-weight: 100;
}

.container {

	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
    margin-left: 100px;
}

table {
	width: 800px;
	border-collapse: collapse;
	overflow: hidden;
	box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

th,
td {
	padding: 15px;
	background-color: rgba(255,255,255,0.2);
	color: #fff;
}

th {
	text-align: left;
}

thead {
	th {
		background-color: #55608f;
	}
}

tbody {
	tr {
		&:hover {
			background-color: rgba(255,255,255,0.3);
		}
	}
	td {
		position: relative;
		&:hover {
			&:before {
				content: "";
				position: absolute;
				left: 0;
				right: 0;
				top: -9999px;
				bottom: -9999px;
				background-color: rgba(255,255,255,0.2);
				z-index: -1;
			}
		}
	}
    .container {
    text-align: right; /* Align the content to the right */
    }
}
h3{
    text-align: center;
    color:white ;
    margin-bottom: 500px;
}

.button-container {
    display: flex;
}
.approve-button {
    background-color:#A4A4A4;
 
}

.reject-button {
    background-color: red;
   
}
.button-container {
    display: flex;
}

.approve-button, .reject-button {
    border: none;
    opacity: 0.5;
    border-radius: 50%;
    color: white;
    width: 30px;
    height: 30px;
    font-size: 15px;
    cursor: pointer;
    margin-right: 10px;
}
.approve-button:hover {
    background-color: #5C5A5A;
}

.reject-button:hover {
    background-color: darkred; /* Change the color on hover */
    opacity: 1; /* Make it fully opaque on hover */
}
</style>
</head>
<html>
<body>
    <center><h3>Your leave applications</h3></center><br>
    <table class="container" >
        <tr>
            <th>S.No</th>
            <th>Subject</th>
            <th style="width:40%;">Message</th>
            <th>Status</th>
        </tr>
        <?php
            $sno = 1;  
            $query = "select * from leaves where uid = $_SESSION[uid]";
            $query_run = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($query_run)){
                ?>
                <tr>
                    <td><?php echo $sno; ?></td>
                    <td><?php echo $row['subject']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
                <?php
                $sno = $sno + 1;
            }
        ?>
    </table>
</body>
</html>
<?php 
}
else{
    header('Location:user_login.php');
}
?>