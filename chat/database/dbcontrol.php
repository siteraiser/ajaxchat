<?php class db_actions
{	
	


		
function addnew($db, $link){
	$query = "INSERT INTO mainchat (date,user,message)
	VALUES
	( ?, ?, ?)
       ";

if (!$stmt = $link->prepare($query)) {
    echo 'Database prepare error';
    exit;
}

$stmt->bind_param('sss', $date, $user, $message);



$date = microtime(true);
$user=$_GET['user'];
/*if(@$_SESSION['user_name']){
$user = $_SESSION['user_name'];
}*/
$message = $_GET['add'];



if (!$stmt->execute()) {
    echo 'Database execute error';
    exit;
}

$stmt->close();	$authuser=$user;
 $this->update($db, $link, $authuser);
}	
	

function usersmaintain($db, $link, $lastask){ $output='';
	// echo $lastask;
	/* Select queries return a resultset */

$lastask=($lastask - 30);
$link->query("DELETE FROM chatuser WHERE lastdate < $lastask");




$query = "SELECT date,user,lastdate FROM chatuser ORDER BY date ASC";
/* prepare statement */
if ($stmt = $link->prepare($query)) {
    $stmt->execute();

    /* bind variables to prepared statement */
    $stmt->bind_result($date, $user, $lastdate);

    /* fetch values echo'in showusers';*/ 
    while ($stmt->fetch()) { 
  

 $output.='<li><span class="tab">'.$user.'</span></li>';
   
   
    }/* close statement */
$allusers = $output;
if (!$stmt->execute()) { echo 'Database execute error'; exit;}
$stmt->close();


    
  }  return $allusers; 
}


	
function allusers($db, $link){ $output1='';
	// echo $lastask;
	/* Select queries return a resultset */
$query = "SELECT date,user,lastdate FROM chatuser ORDER BY date ASC";
/* prepare statement */
if ($stmt = $link->prepare($query)) {
    $stmt->execute();

    /* bind variables to prepared statement */
    $stmt->bind_result($date, $user, $lastdate);

    /* fetch values echo'in showusers';*/ 
    while ($stmt->fetch()) { 
  
  
 $output1.='<li><span class="tab">'.$user.'</span></li>';
   


   // $user, $message;
    }/* close statement */
$allusers = $output1;
if (!$stmt->execute()) { echo 'Database execute error'; exit;}
$stmt->close();


    
  }  return $allusers; 
}
	
	
	
	
	
function all($db, $link, $authuser){ $output='';
	// echo $lastask;
	/* check to see when user registered */
$AUser=$authuser["user"];
	$query = "SELECT date FROM chatuser WHERE user='$AUser'";
/* prepare statement */
if ($stmt = $link->prepare($query)) {
    $stmt->execute();

    /* bind variables to prepared statement */
    $stmt->bind_result($date);

    /* fetch values echo'in showusers';*/ 
    while ($stmt->fetch()) { 
  
  $regDate=$date;




    }/* close statement */

if (!$stmt->execute()) { echo 'Database execute error'; exit;}
$stmt->close();


    
  } 
  
  if(isset($regDate)){   // retrieve all comments after user date
$query = "SELECT date,user,message FROM mainchat WHERE date > $regDate ORDER BY date ASC";
/* prepare statement */
if ($stmt = $link->prepare($query)) {
    $stmt->execute();

    /* bind variables to prepared statement */
    $stmt->bind_result($date, $user, $message);

    /* fetch values */
    while ($stmt->fetch()) { 
  
   
 $output.='<li><span class="tab">'.$user.': '.$message.'</span></li>';
 

   // $user, $message;
    }/* close statement */

if (!$stmt->execute()) { echo 'Database execute error'; exit;}
$stmt->close();}  }
$allusers=$this->allusers($db, $link);
$obj = array(); 
$obj['all'] =  $output;
$obj['time'] = microtime(true);

if($authuser['date'] !==''){
$obj['date'] = $authuser['date'];}
$obj['newuser'] = $authuser['user'];
$obj['allusers'] = $allusers;
$response = json_encode($obj); 
 print $response; 
   exit();
    

}	
	
	
	
		
function ask($db, $link, $lastask){  $update=false;  
	
	// echo $lastask;
	/* Select queries return a resultset */
$query = "SELECT date,user,message FROM mainchat ORDER BY date ASC";
/* prepare statement */
if ($stmt = $link->prepare($query)) {
    $stmt->execute();

    /* bind variables to prepared statement */
    $stmt->bind_result($date, $user, $message);

    /* fetch values */
    while ($stmt->fetch()) { 
  
  
  
   if($date > $lastask){

$update=true;

   $obj = array(); 
$obj['usr'] = $user;
$obj['msg'] = $message;
$obj['time'] = microtime(true);


$response = json_encode($obj); 
 print $response; 
  
   
    }
   // $user, $message;
    }if($update==true){ $authuser=$_GET['user'];
 $this->update($db, $link, $authuser);
exit();}
if (!$stmt->execute()) { echo 'Database execute error'; exit;}
    /* close statement */
    $stmt->close();
}
}
	
	function update($db, $link, $authuser){$donothing='';
	$query = "SELECT date,user,lastdate FROM chatuser ORDER BY date ASC";
/* check to see if logged in user is in database if so update current guest name */
if ($stmt = $link->prepare($query)) {
    $stmt->execute();

    /* bind variables to prepared statement */
    $stmt->bind_result($dated, $user, $lastdate);
  
    /* fetch values */
    while ($stmt->fetch()) {
  
    	if($_SESSION['user_name'] and $_SESSION['user_name'] ==$user){
$donothing=1;
	}
	}if (!$stmt->execute()) { echo 'Database execute error'; exit;}
$stmt->close();
}
	
	
	
	
	
	if($_SESSION['user_name'] and $_SESSION['user_name'] !==$authuser and $donothing !==1){//update guest to logged in users name
	
	$signedin=$_SESSION['user_name'];
	
	$query="UPDATE chatuser SET user='$signedin' WHERE user='$authuser'";

if ($link->query($query) === TRUE) {
   		// printf("table mainchat successfully created.\n");
		}else{ printf("Error: %s\n", $link->error);}
	
	$authuser=$signedin;
	
	}
$lastdate = microtime(true);

$query="UPDATE chatuser SET lastdate='$lastdate' WHERE user='$authuser'";

if ($link->query($query) === TRUE) {
   		// printf("table mainchat successfully created.\n");
		}else{ printf("Error: %s\n", $link->error);}
}




	
	
	
	
	
		
function register($db, $link, $usercheck, $date){
$authuser='';$count=0;$done=false;$counted=1;$guests= array();

	/* Select queries return a resultset */
$query = "SELECT date,user,lastdate FROM chatuser ORDER BY date ASC";
/* prepare statement */
if ($stmt = $link->prepare($query)) {
    $stmt->execute();

    /* bind variables to prepared statement */
    $stmt->bind_result($dated, $user, $lastdate);
  
    /* fetch values */
    while ($stmt->fetch()) {
  
    	if($user == $usercheck and $date == $dated){

	$authuser = $user;
 if(@$_SESSION['user_name']){$authuser=$_SESSION['user_name'];}
    	}
    $user1=$user; $user2=$user;
  if(substr($user2, 0, 5)== 'Guest'){ 
  $guests[] = substr($user1, 5);}
    }

if($guests[0]>0){
while($done!==true){$count++;$test= 0;
 	 foreach($guests as $key => $value){
  	if($count == $value){$test= 1;break;}
	}
	if($test==0){$done=true;}
}$counted=$count;}
  /* close statement */if (!$stmt->execute()) { echo 'Database execute error'; exit;}
$stmt->close();
}

if($authuser !==''){
$this->update($db, $link, $authuser);
return array("user"=>$authuser, "date"=>'');//send with all
    
}else{//---if new user

	$query = "INSERT INTO chatuser (date,user,lastdate)
	VALUES
	( ?, ?, ?)
       ";

if (!$stmt = $link->prepare($query)) {
    echo 'Database prepare error';
    exit;
}

$stmt->bind_param('sss', $date, $newuser, $lastdate);



$date = microtime(true);
$lastdate = $date;
$newuser='Guest'.$counted.'';
/*if(@$_SESSION['user_name']){
$newuser = $_SESSION['user_name'];
}*/



$authuser=$newuser;



if (!$stmt->execute()) { echo 'Database execute error'; exit;}
$stmt->close();
return array("user"=>$authuser, "date"=>$lastdate);//send with all
}			
		
	

}


}	