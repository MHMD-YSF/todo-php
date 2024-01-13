<?php
session_start();
if (isset($_SESSION['email'])) {
    include('includes/connection.php');

    // Initialize variables for the filter form
    $selectedPriority = isset($_POST['priority']) ? $_POST['priority'] : "all"; // Default to "all" priorities
    $selectedStatus = isset($_POST['status']) ? $_POST['status'] : "all"; // Default to "all" statuses

    // Handle filter form submission
    if (isset($_POST['filter'])) {
        $selectedPriority = $_POST['priority'];
        $selectedStatus = $_POST['status'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        html,
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
	top:300px;
    bottom:200px;
	transform: translate(-50%, -50%);
    margin-left: 57%;
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
    
}  .form-control {
    
    display: inline-block;
        margin-right: 20px;
			width: 30%;
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
            display: inline-block;
            font-size:13px;
            width:50px;
            border-radius:20% ;
			background: #ED9AD6;
			backdrop-filter: blur(20px);
			opacity:0.5 ;
            border: none; 
            padding: 10px;
            color: white; 
			
		}label {
    color: white;
    display: inline-block;
        width: 40%; /* Adjust the width as needed */
        margin-right: 20px; 
}
</style>
</head>
<body>

    
    <form   style="margin-bottom: 500px;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="priority">Filter by Priority:</label>
        <select class="form-control" name="priority" id="priority">
            <option value="all" <?php if ($selectedPriority == "all") echo "selected"; ?>>All</option>
            <option value="high" <?php if ($selectedPriority == "high") echo "selected"; ?>>High</option>
            <option value="medium" <?php if ($selectedPriority == "medium") echo "selected"; ?>>Medium</option>
            <option value="low" <?php if ($selectedPriority == "low") echo "selected"; ?>>Low</option>
        </select>

        <label for="status">Filter by Status:</label>
        <select  class="form-control" name="status" id="status">
            <option value="all" <?php if ($selectedStatus == "all") echo "selected"; ?>>All</option>
            <option value="in progress" <?php if ($selectedStatus == "in progress") echo "selected"; ?>>In Progress</option>
            <option value="completed" <?php if ($selectedStatus == "completed") echo "selected"; ?>>Completed</option>
        </select>
        <input  class="btn-warning" type="submit" name="filter" value="Filter">
        
    </form>

    <table class="container " >
        <tr>
            <th>S.No</th>
            <th>Task ID</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        $sno = 1;

        // Modify the SQL query based on the selected priority and status
        $sql = "SELECT * FROM tasks WHERE uid = $_SESSION[uid]";

        if ($selectedPriority != "all") {
            $sql .= " AND ptiority = '$selectedPriority'";
        }

        if ($selectedStatus != "all") {
            $sql .= " AND status = '$selectedStatus'";
        }

        $sql .= " ORDER BY
    CASE
        WHEN ptiority = 'low' THEN 3
        WHEN ptiority = 'medium' THEN 2
        WHEN ptiority = 'high' THEN 1
        ELSE 4
    END";

        $query_run = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
            <tr>
                <td><?php echo $sno; ?></td>
                <td><?php echo $row['tid']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['start_date']; ?></td>
                <td><?php echo $row['end_date']; ?></td>
                <td><?php echo $row['ptiority']; ?></td>
                <td><center><?php echo $row['status']; ?></center></td>
                <td><a  style="color :white;text-decoration: none;"href="update_status.php?id=<?php echo $row['tid']; ?>">Update</a></td>
            </tr>
            <?php
            $sno = $sno + 1;
        }
        ?>
    </table>
</body>
</html>
<?php
} else {
    header('Location:user_login.php');
}
?>
