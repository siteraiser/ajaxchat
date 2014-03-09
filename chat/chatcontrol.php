<?php session_start();
include_once('db_conn.inc.php');		
include_once('database/chatcontrols.php');
$db=$database;

$action = new db_controls(); 

$action->reset($db, $link);

$table='mainchat';$action->reset_table($db, $link, $table);
$table='chatuser';
$action->reset_table($db, $link, $table);
//////
$action->newmainchat($db, $link);

$action->showusers($db, $link);

$lastask = microtime(true);
//$action->addnew($db, $link);
//$action->ask($db, $link, $lastask);
?>