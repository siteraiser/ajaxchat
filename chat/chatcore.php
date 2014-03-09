<?php session_start();
include_once('db_conn.inc.php');		
include_once('database/dbcontrol.php');
$db=$database;$usercheck='';
$action = new db_actions(); 
header("Expires: Sun, 19 Nov 1978 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_write_close();$lastask = microtime(true);if(!$_GET['time']){$action->usersmaintain($db, $link, $lastask);}
/*$lastask = microtime(true);*//**/if($_SESSION['user_name'] and $_GET['user'] !== $_SESSION['user_name']){
$authuser=$_GET['user'];
$action->update($db, $link, $authuser);$allusers=$action->allusers($db, $link);

$obj = array();
$obj['allusers'] = $allusers; 
$obj['newuser'] = $_SESSION['user_name'];
$obj['time'] = $lastask;
//$obj['restart'] = 'rsrtagain123';
$response = json_encode($obj); 
 print $response; 
   exit();}
if($_GET['time']){
	$_GET['time']= str_replace('%2F','/',$_GET['time']);
	
	$lastask=$_GET['time'];

}else{
if(isset($_GET['user'])){//check to see user cookie matches users in database,
$_GET['user']= str_replace('%2F','/',$_GET['user']);
$usercheck=$_GET['user'];$date=$_GET['date'];
$authuser=$action->register($db, $link, $usercheck,$date);

}

 //if not, create new user to store in cookie...  send new user list
$action->all($db, $link, $authuser);

}
$i=0;

while($i++ <13){sleep(2);
$action->ask($db, $link, $lastask);
}
$lastask = microtime(true);
//recheck users table, send new table
$authuser=$_GET['user'];

$action->update($db, $link, $authuser);
$allusers=$action->usersmaintain($db, $link, $lastask);

$obj = array(); 
$obj['allusers'] = $allusers;
$obj['time'] = $lastask;
$obj['restart'] = 'rsrtagain123';
$response = json_encode($obj); 
 print $response; 
   exit();

 ?>