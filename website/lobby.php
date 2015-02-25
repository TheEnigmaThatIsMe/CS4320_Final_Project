<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="icons/die.ico">

    <title>Start Game</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    
  </head>
  <body>
	<script src="js/alert.js"></script>
    <div class="container">
	     <form class="form-signin" role="form" id='creategame' action="<?= $_SERVER['PHP_SELF'] ?>" method='post'>
		<!--<form class="creategame" role="form" id='creategame' action=
		-->
		<h2 class="form-Start Game-heading">Start Game</h2>
		<a class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value='Submit' href="../User_Interface/Risk_map_UI/RiSK_UI.php">Start Game</a>
		</form>
	</div>
	</body>
</html>
