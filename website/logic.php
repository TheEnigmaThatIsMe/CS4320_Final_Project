<?php
//establish database connection

$conn = pg_connect("host=dbhost-pgsql.cs.missouri.edu user=cs4320f14grp3 password=DL5dQFbH dbname=cs4320f14grp3");

//add a user to user_info and authentication tables
function addUser($username,$password)
{
	global $conn;
	$username = pg_escape_string(htmlspecialchars($username));
	$password = pg_escape_string(htmlspecialchars($password));
	$salt = sha1(rand());
	$hash = sha1($password . $salt);

	$query = "INSERT INTO risk.user_info (username) VALUES ($1)";
	pg_prepare($conn, "addUserInfo",$query);

	$query = "INSERT INTO risk.authentication (username, password_hash,salt) VALUES ($1,$2,$3)";
	pg_prepare($conn, "addUserAuth",$query);
	
	//$query = "INSERT INTO risk.player VALUES ('1', $1, 'red, '1', '0','1')";
	//pg_prepare($conn, "addPlayer",$query);
	
	pg_execute($conn, "addUserInfo",array($username));
	pg_execute($conn,"addUserAuth",array($username, $hash, $salt));
	//pg_execute($conn, "addPlayer",array($username));
}

//check if a username exists
function usernameCheck($username)
{
	global $conn;
	$username = pg_escape_string(htmlspecialchars($username));
	$password = pg_escape_string(htmlspecialchars($password));
	$query = "SELECT * FROM risk.user_info WHERE username LIKE $1";
	pg_prepare($conn, "checkName",$query);
	$result = pg_execute($conn,"checkName",array($username));
	echo $result;
	if(pg_num_rows($result) == 0){
		return 0;
	}
	else{
		return 1;
	}
}

//check username and password
function usernamePasswordCheck($username,$password)
{
	global $conn;
	//prepare statement
	$query = "SELECT salt, password_hash FROM risk.authentication WHERE username LIKE $1";
	pg_prepare($conn,"login",$query);

	$username = pg_escape_string(htmlspecialchars($username));
	$password = pg_escape_string(htmlspecialchars($password));
	
	//get salt and hash from database
	$result = pg_execute($conn, "login", array($username));
	$line = pg_fetch_array($result, null, PGSQL_ASSOC);
	$salt = $line['salt'];
	$db_hash = $line['password_hash'];

	//generate a hash with salt and password
	$hash = sha1($password . $salt);
	//check salt and hash
	if($hash == $db_hash){
		return 1;
	}
	else{ 
		return 0;
	}
}

//returns first ip when registered
function first_ip($username)
{
	global $conn;
	$username = pg_escape_string(htmlspecialchars($username));
	$query = "SELECT ip_address FROM risk.log WHERE username LIKE $1 ORDER BY log_date LIMIT 1";
	pg_prepare($conn,"get_ip",$query);
	$result = pg_execute($conn,"get_ip",array($username));
	$line = pg_fetch_array($result, null, PGSQL_ASSOC);
	return $line['ip_address'];	
}

//returns regestration date
function registration_date($username)
{
	global $conn;
	$username = pg_escape_string(htmlspecialchars($username));
	$query = "SELECT registration_date FROM risk.user_info WHERE username LIKE $1";
	pg_prepare($conn,"reg_date",$query);
	$result = pg_execute($conn,"reg_date",array($username));
	$line = pg_fetch_array($result, null, PGSQL_ASSOC);
	return $line['registration_date'];
}

//stores the login data
/*function store_login_data($username, $ip, $action)
{
	global $conn;
	$username = pg_escape_string(htmlspecialchars($username));
	$ip = pg_escape_string(htmlspecialchars($ip));
	$action = pg_escape_string(htmlspecialchars($action));
	$query = "INSERT INTO risk.log (username, ip_address, action) VALUES ($1, $2, $3)";
	pg_prepare($conn, "store_login", $query);
	pg_execute($conn, "store_login", array($username,$ip,$action));
}*/

//prints the log files
function print_logs($username)
{
	global $conn;
	$username = pg_escape_string(htmlspecialchars($username));
	$query = "SELECT action, ip_address, log_date FROM risk.log WHERE username LIKE $1 ORDER BY log_date desc";
	pg_prepare($conn,"get_logs",$query);
	$result = pg_execute($conn,"get_logs",array($username));
	
	//Print table
    echo "\n<table border=\"1\">\n\t<tr>\n";
    
    //print field names
    $i = 0;
    $numFields = pg_num_fields($result);
    
    while ($i < $numFields){
      $fieldName = pg_field_name($result, $i);
      echo "\t\t<th>" . $fieldName . "</th>\n";
      $i ++;
    }
    echo "\t</tr>\n";
    
    //print rows and columns
    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
    
      echo "\t<tr>\n";
      foreach($line as $col_value){
        echo "\t\t<td>$col_value</td>\n";
      }
      echo "\t</tr>\n";
    }
    echo "</table>\n";
}

//print the description
function print_description($username)
{
	global $conn;
	$username = pg_escape_string(htmlspecialchars($username));
	$query = "SELECT description FROM risk.user_info where username LIKE $1";
	pg_prepare($conn, "print_description", $query);
	$result = pg_execute($conn,"print_description",array($username));
	$line = pg_fetch_array($result, null, PGSQL_ASSOC);
	echo $line['description'];

}

//update the description
function update_description($username, $description)
{
	global $conn;
	$username = pg_escape_string(htmlspecialchars($username));
	$description = pg_escape_string(htmlspecialchars($description));
	$query = "UPDATE risk.user_info SET description = $1 WHERE username LIKE $2";
	pg_prepare($conn,"update_description",$query);
	pg_execute($conn,"update_description",array($description,$username));

}

function redirectHTTPS()
{
  if($_SERVER['HTTPS'] != "on")
  {
     $redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
     header("Location:$redirect");
  }
}
function lobbyCheck($Lname)
{
	global $conn;
	$Lname = pg_escape_string(htmlspecialchars($Lname));
	$Query = "SELECT * FROM risk.gameSetup";
	$result = pg_query($conn, $Query);
	$row = pg_num_rows($result);
	//var_dump($row);
	if(($row) == 0)
	{
		return 0;
	}
	else if (($row) != 0)
	{
		return 1;
	}
}
function joinCheck($Lname)
{
	global $conn;
	$Lname = pg_escape_string(htmlspecialchars($Lname));
	$Query = "SELECT * FROM risk.gameSetup WHERE gameName LIKE $1";
	pg_prepare($conn, "checkName", $Query);
	$result = pg_execute($conn, "checkName", array($Lname));
	if(pg_num_rows($result) == 1){
		return 1;
	}
	else{
		return 0;
	}
}

function insertLobbyName($Lname, $Username){
	global $conn;
	$Lname = pg_escape_string(htmlspecialchars($Lname));
	$Username = pg_escape_string(htmlspecialchars($Username));
	$Query = "INSERT INTO risk.gameSetup (gameName) VALUES ($1)";
	$Query2 = "INSERT INTO risk.player (name) VALUES ('$Username')";
	pg_prepare($conn, "insertLobby", $Query);
	$result2 = pg_query($conn, $Query2);
	//pg_prepare($conn, "insertPname", $Query2);
	$result = pg_execute($conn, "insertLobby", array($Lname));
	//$result2 = pg_execute($conn, "insertPname", array($Username));
}

function joinLobby($Lname){
	global $conn;
	$Lname = pg_escape_string(htmlspecialchars($Lname));
	$Query = "SELECT gameID FROM risk.gameSetup WHERE gameName = $1";
	pg_prepare($conn, "joinPlayer", $Query);
	$result = pg_execute($conn, "joinPlayer", array($Lname));
	$array = pg_fetch_array($result);
	//var_dump($array);
	//var_dump($array[0]);
	$result = $array[0];
	//var_dump($result);
	return $result;
	
}
/*function insertLobbyID($result, $tempName){
	global $conn;
	//$result = pg_escape_string(htmlspecialchars($result));
	$tempName = pg_escape_string(htmlspecialchars($tempName));
	$Query = "INSERT INTO risk.player (gameID, name) VALUES ($1, $2)";
	pg_prepare($conn, "insertLobbyID", $Query);
	$result2 = pg_execute($conn, "insertLobbyID", array($result, $tempName));
	//var_dump($result);
}*/

function insertLobbyID($tempName){
	global $conn;
	$Query = "SELECT COUNT(name) FROM risk.player WHERE name = $1";
	$test = pg_query($conn, $Query);
	$result = pg_fetch_assoc($test);
	$row = (int)$result;
	var_dump($row);
	if(($row) == 1)
	{
		//echo "<script language='javascript'>alreadyIn();</script>";
	}
	else
	{
		//$hey = "we made it inside the first";
		//$hey1 = "we made it inside the second";
		$Query = "SELECT name FROM risk.player";
		$val = pg_query($conn, $Query);
		$result = pg_num_rows($val);
		//$result = intval($result);
		//var_dump($result);
		if(($result) == 1)
		{
			//var_dump($hey);
			$Query2 = "INSERT INTO risk.player (color, name) VALUES ('blue', '$tempName')";
			$result2 = pg_query($conn, $Query2);
		}
		else if(($result) == 2)
		{
			//var_dump($hey1);
			$Query3 = "INSERT INTO risk.player (color, name) VALUES ('green', '$tempName')";
			$result3 = pg_query($conn, $Query3);
		}
		else
		{
			echo "<script language='javascript'>cant();</script>";
			header("Location: home.php");
		}
	}
}
?>
