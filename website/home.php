<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="icons/die.ico">

    <title>RISK - Home</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>
<body>
	<script src="js/alert.js"></script>
	<div class="container">

      <form class="form-signin" role="form" id='login' action="<?= $_SERVER['PHP_SELF'] ?>" method='post'>
        <h2 class="form-signin-heading">Risk Home</h2>
		<a class="btn btn-lg btn-primary btn-block" type="submit" name='Submit' value='Submit' href="creategame.php">Create Game</a>
        <a class="btn btn-lg btn-primary btn-block" type="joingame" name='joingame' value='joingame' href="joingame.php">Join Game</a>
		<a class="btn btn-lg btn-primary btn-block" type="logout" name='logout' value='logout' href="logout.php">Logout</a>
	  </form>
    	
    </div>
	
<?php
//include logic functions file
	session_start();
	include('logic.php');
	redirectHTTPS();
	//if session doesnt exist
	if($_SESSION['username']==NULL){
		//Redirect to index
		header("Location: index.php");
	}
?>
</body>
</html>
