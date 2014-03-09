<?php 
$host="localhost";
$username="cool1234_chat";
$password="fuck you!";
$database="cool1234_chat";
/*$link = mysql_connect($host, $username, $password);
if (!$link) {
	die('Could not connect: ' . mysql_error());
}*/
$link = new mysqli($host, $username, $password, $database);
/* check connection */
if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}
