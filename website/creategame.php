<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="icons/die.ico">

    <title>Create Game</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    
  </head>
  <body>
	<script src="js/alert.js"></script>
    <div class="container">
	    <form class="form-signin" role="form" id='creategame' action="<?= $_SERVER['PHP_SELF'] ?>" method='post'>
		<h2 class="form-creategame-heading">Create Game</h2>
		<input type="text" class="form-control" placeholder="USE TEST AS GAME LOBBY NAME" autofocus name='Lobby_Name' id='Lobby_Name' maxlength="50" required>
		<button class="btn btn-lg btn-primary btn-block" type="submit" name='Submit' value='Submit'>Create Game</button>
	    <a class="btn btn-lg btn-primary btn-block" type="home" name='Home' value='Home' href="home.php">Home</a>
		</form>
	</div>
	<?php 
		include("logic.php");
		redirectHTTPS();
		session_start();
		
		if($_SESSION['username']==NULL){
		//Redirect to index
		header("Location: index.php");
		}
		$Username = $_SESSION['username'];
		if(isset($_POST['Submit'])){
			$Lname = htmlspecialchars($_POST['Lobby_Name']);
			
			if(lobbyCheck($Lname) == 0){
				insertLobbyName($Lname, $Username);
				//var_dump($Username);
				header("Location: lobby.php");
			}
			else if(lobbycheck($Lname) != 0){
				echo "<script language='javascript'>invalidLobby();</script>";
				//header("Location: home.php");
			}
		}
	?>
	</body>
</html>
