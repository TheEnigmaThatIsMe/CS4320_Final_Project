<!DOCTYPE html>
<html>
<head>
	<title>RISK - Register</title>
</head>

<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

<body>
	<script src="js/alert.js"></script>
	<div class="container">
      <form class="form-signin" role="form" id='register' action="<?= $_SERVER['PHP_SELF'] ?>" method='post'>
        <h2 class="form-signin-heading">Please Register</h2>
        <input type="text" class="form-control" placeholder="Username" autofocus name='username' id='username' maxlength="50" required>
        <input type="password" class="form-control" placeholder="Password" name='password' id='password' maxlength="50" required>
        <input type="password" class="form-control" placeholder="Re-enter Password" name='passwordCheck' id='password' maxlength="50" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name='Submit' value='Submit'>Submit</button>
        <a class="btn btn-lg btn-primary btn-block" type="home" name='Home' value='Home' href="index.php">Back to Login</a>
        <!--<input type='submit' name='Submit' value='Submit' />-->
      </form>
    </div>
<?php

	include("logic.php");
	redirectHTTPS();
	//start the session
	session_start();
	
	
	//on form submission
  	if (isset($_POST['Submit'])){
  	
		//collect username and passwords
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		$passwordCheck = htmlspecialchars($_POST['passwordCheck']);
		
		if($password == $passwordCheck){
		//check if the name exists
			if(usernameCheck($username)==0)
			{
				$ipaddress = $_SERVER["REMOTE_ADDR"];
				$action = "register";
			
				//create user if username is unique
				addUser($username,$password);
			
				//log the user in and log the login
				//store_login_data($username, $ipaddress, $action);
				$_SESSION['username'] = $username;
				header("Location: home.php");
			}
			else{
				echo "<script type='text/javascript'>usernameRegistrationAlert();</script>";
			}
		}
		else{
			echo "<script type='text/javascript'>registrationPassCheckAlert();</script>";
			echo "<script type='text/javascript'>resetForm();</script>";
		}
	}
?> 
</body>
</html>
