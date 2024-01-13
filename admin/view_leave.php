<?php    
    session_start();
    if($_SESSION['email']){
    include('../includes/connection.php');
?>
<html>
    <style>html,
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
h3{
    text-align: center;
    color:white ;
}

.button-container {
    display: flex;
}
}.approve-button {
    background-color: rgb(138, 255, 168);
 
}

.reject-button {
    background-color: red;
   
}
.button-container {
    display: flex;
}

.approve-button, .reject-button {
    border: none;
    opacity: 0.4;
    border-radius: 50%;
    color: white;
    width: 20px;
    height: 20px;
    font-size: 10px;
    cursor: pointer;
    margin-right: 10px;
}
.approve-button:hover {
    background-color: green;
}

.reject-button:hover {
    background-color: darkred; /* Change the color on hover */
    opacity: 1; /* Make it fully opaque on hover */
}

</style>
<body>
<h3 style="  margin-bottom: 500px; color:white; ">All leave applications</h3><br>
    <table class="container" >
        <tr>
            <th>S.No</th>
            <th>User</th>
            <th>Subject</th>
            <th style="width:40%;">Message</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        
            $sno = 1;  
            $query = "select * from leaves";
            $query_run = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($query_run)){
                ?>
                <tr>
                    <td><?php echo $sno; ?></td>
                    <?php  
                        $query1 = "select name from users where uid = $row[uid]";
                        $query_run1 = mysqli_query($connection,$query1);
                        while($row1 = mysqli_fetch_assoc($query_run1)){
                            ?>
                            <td><?php echo $row1['name']; ?></td>
                            <?php
                        }
                    ?>  
                    <td><?php echo $row['subject']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <div class="button-container">
                        <a href="approve_leave.php?id=<?php echo $row['lid']; ?>">
                             <button class="approve-button"><i class="fa-solid fa-check"></i></button>
                        </a>
                        <a href="reject_leave.php?id=<?php echo $row['lid']; ?>">
                            <button class="reject-button"><i class="fa-solid fa-x"></i></button>
                        </a></div>
                    </td>
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
    header('Location:admin_login.php');
}
?>