<!DOCTYPE html>
<html>
<head>
	<title>RISK - Log</title>
	
	<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
	
</head>
<body>
<?php
//include logic functions file
	include('logic.php');
	redirectHTTPS();
	
	//start the session
	session_start();
	
	//if session doesnt exist
	if($_SESSION['username']==NULL)
	{
		//Redirect to index
		header("Location: index.php");
	}
	//otherwise welcome signed in user
	else
	{
		echo "<h3>Welcome ".$_SESSION['username']."</h3><br>";
		echo "Description: ";
		print_description($_SESSION['username']);
		echo "<br>";
	}
?>

<!-- Print out tables of information pertaining to user -->
	<br>You registered on <?php echo registration_date($_SESSION['username']); ?></br>
	Registration IP address <?php echo first_ip($_SESSION['username']); ?> </br>
<div>
	<br>Past logins<?php print_logs($_SESSION['username']); ?>
</div>
<div class="form-signin">
<a class="btn btn-lg btn-primary btn-block" type="update" name='Update' value='Update' href="update.php">Update</a>
<a class="btn btn-lg btn-primary btn-block" type="home" name='Home' value='Home' href="home.php">Home</a>
<a class="btn btn-lg btn-primary btn-block" type="logout" name='logout' value='logout' href="logout.php">Logout</a>
</div>
</body>
</html>