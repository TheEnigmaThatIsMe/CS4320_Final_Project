<?php
//start session
session_start();
include('logic.php');
$username =$_SESSION['username'];
$ipaddress = $_SERVER["REMOTE_ADDR"];
$action = "logout";
//store_login_data($username, $ipaddress, "logout");
//destroy session and send Sauron back to the pits of Mordor
session_destroy();

//after session destoryed direct user back to index page
header("Location: index.php");
?>