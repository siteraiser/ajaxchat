<?php session_start();
header("Expires: Sun, 19 Nov 1978 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include_once('db_conn.inc.php');		
include_once('database/dbcontrol.php');
$db=$database;
$action = new db_actions(); 


if($_GET['add']){
$action->addnew($db, $link);

//echo'1';	$_SESSION['add']= $_GET['add']; //echo $_GET['test']; 
}



 ?>