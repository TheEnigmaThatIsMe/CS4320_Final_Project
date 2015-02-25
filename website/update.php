<?php 
include('logic.php');
redirectHTTPS();
session_start();

if(isset($_POST['Save'])){
		update_description($_SESSION['username'],$_POST['description']);
		$username =$_SESSION['username'];
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		$action = "update";
		store_login_data($username, $ipaddress, $action);
		header("Location: log.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>RISK - Update</title>
	<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>
<body class="form-signin">
	<h3>Update Profile</h3>
	<div>Username: <?php echo $_SESSION['username']; ?></div>
	<div class="form-signin">
		Description:
		<form id='update' action="<?= $_SERVER['PHP_SELF'] ?>" method='post'>
			<textarea rows="10" cols="30" name = "description"><?php print_description($_SESSION['username']); ?></textarea>
			<br>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name='Save' value='Save'>Save</button>
			<a class="btn btn-lg btn-primary btn-block" type="home" name='Home' value='Home' href="home.php">Home</a>
			<!--<input type='submit' name='Save' value='Save' />-->
		</form>
	</div>
</body>
</html>