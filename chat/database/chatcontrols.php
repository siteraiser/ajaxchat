<?php class db_controls
{	
	function newmainchat($db, $link){


		if (1) {
		if ($link->query("CREATE DATABASE $db") === TRUE) {
   		 printf("DB chat successfully created.\n");
		}else {
			 printf("Error: %s\n", $link->error) . "\n";
		}
	
		}

/* Select queries return a resultset */
$query = "SHOW TABLES FROM $db";
$i=0;$match='';
if ($result = $link->query($query)) {
    /* fetch object array */
	while ($row = $result->fetch_row()) {

		if($row[$i++]=='mainchat'){
	
		$mainchat=true;echo 'Match!';
    		}
    		if($row[$i++]=='chatuser'){
	
		$chatuser=true;echo 'Match!';
    		}
	}
    /* free result set */
    $result->close();
}

	


		if($mainchat!==true){
mysqli_select_db($link, $db);//select db if present
$query = "CREATE TABLE mainchat (id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, date FLOAT(50) , user CHAR(100), message TEXT(15000), headline CHAR(250), link TEXT(250))ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";

//----Execute query

if ($link->query($query) === TRUE) {
   		 printf("table mainchat successfully created.\n");
		}else{ printf("Error: %s\n", $link->error);}


	}
	
			if($chatuser!==true){
mysqli_select_db($link, $db);//select db if present
$query = "CREATE TABLE chatuser (id INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY, date FLOAT(50), user CHAR(100), lastdate FLOAT(50))ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;";

//----Execute query

if ($link->query($query) === TRUE) {
   		 printf("table chatuser successfully created.\n");
		}else{ printf("Error: %s\n", $link->error);}


	}
	
	
	
	
	
	
	}
	
		
	function reset_table($db, $link, $table){//-------reset database
		
		$query = "DROP TABLE $table";//drop table user data!
		if ($link->query($query) === TRUE) {
   		 printf("table $table was successfully dropped\n.\n");
		}else{ printf("Error: %s\n", $link->error);}
	
	}
	
	function reset($db, $link){//-------reset database
		
		//$db_selected = mysqli_select_db($link, $db);
		$query = "DROP TABLE mainchat";//drop table
		if ($link->query($query) === TRUE) {
   		 printf("table mainchat was successfully dropped.\n");
		}else{ printf("Error: %s\n", $link->error);}


$query = "DROP TABLE chatuser";//drop table
		if ($link->query($query) === TRUE) {
   		 printf("table chatuser was successfully dropped.\n");
		}else{ printf("Error: %s\n", $link->error);}



		$query = "DROP DATABASE $db";//drop db
		if ($link->query($query) === TRUE) {
   		 printf("Database $db was successfully dropped\n");
		}else{ printf("Error: %s\n", $link->error);}
		
	

	}
	
	
	
	
			function showusers($db, $link){ $output='';
	// echo $lastask;
	/* Select queries return a resultset */
$query = "SELECT date,user,lastdate FROM chatuser ORDER BY date ASC";
/* prepare statement */
if ($stmt = $link->prepare($query)) {
    $stmt->execute();

    /* bind variables to prepared statement */
    $stmt->bind_result($date, $user, $lastdate);

    /* fetch values */ echo'in showusers';
    while ($stmt->fetch()) { 
  
  
 echo'<li><span class="tab">'.$user.': '.$date.''.$lastdate.'</span></li>';
   

  

   // $user, $message;
    }/* close statement */

if (!$stmt->execute()) { echo 'Database execute error'; exit;}
$stmt->close();

    
  }     
}
	
	
	
	
}