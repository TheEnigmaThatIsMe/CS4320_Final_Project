<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="icons/die.ico">
		
		<!-- Formatting for mobile devices -->
		<link href="css/mobile.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 320px)" >
		<link href="css/mobile.css" rel="stylesheet" type="text/css"  media="only screen and (min-width: 321px) and (max-width: 768px)" >
		
		<!-- Custom styles for this template -->
		<link href="css/signin.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 769px)">
	
		<title>RISK - Login</title>
	
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
	
		<!-- Custom styles for this template -->
		<link href="css/signin.css" rel="stylesheet">
		<?php
			if(strpos($_SERVER['HTTP_USER_AGENT'], "iPhone")){
    			?><link rel="stylesheet" href="iphone.css" type="text/css" /><?php
			}
			else{
    			?><link rel="stylesheet" href="style.css" type="text/css" /><?php
			}
		?>
	</head>
  <body>
	<script src="js/alert.js"></script>
	<div class= "banner">
		<center><img src="images/riskLogo.png" width=850 height=125 border=1></center>
	</div>
    <div class="indexContainer">
      <form class="form-signin" role="form" id='login' action="<?= $_SERVER['PHP_SELF'] ?>" method='post'>
        <h2 class="form-signin-heading">Please Log in or Register</h2>
        <input type="text" class="form-control" placeholder="Username" autofocus name='username' id='username' maxlength="50" required>
        <input type="password" class="form-control" placeholder="Password" name='password' id='password' maxlength="50" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name='Submit' value='Submit'>Log in</button>
        <a class="btn btn-lg btn-primary btn-block" type="register" name='Register' value='Register' href="registration.php">Register</a>
        <!--<input type='submit' name='Submit' value='Submit' />-->
      </form>
      <!--<button a class="btn btn-lg btn-primary btn-block" type="register" name='Register' value='Register' href="registration.php">Register</button>-->
    	
    </div> <!-- /container -->
	<?php
	//include logic functions file
	session_start();
	include('logic.php');
	
	//direct page to https
	redirectHTTPS();
	session_start();
	
	//if a session exists redirect to home
	if(isset($_SESSION['username']))
		header("Location: home.php");
	
	//on form submission
	if (isset( $_POST['Submit'] ) )
	{
		//collect username and password from post and sanitize
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		
		//get ip address from server
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		
		//set the action
		$action = "login";
		
		//check input credentials		
		if(usernamePasswordCheck($username,$password,$conn) == 1){
	  		//set username
	  		$_SESSION['username'] = $username;
	  		//log the login
	  		//store_login_data($username, $ipaddress, $action);
	  		header("Location: home.php");
	  	}
	  	else{
	  		echo "<script type='text/javascript'>userNamePassCheckAlert();</script>";
	  	}
	}
?>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
