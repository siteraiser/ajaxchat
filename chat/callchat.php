<?php 

function chathead(){?><script type="text/javascript" charset="utf-8" src="/js/jquery-uiv1.8.9.js"></script> 
<link rel="stylesheet" type="text/css" href="/js/ui.css"/> 
 <link rel="stylesheet" type="text/css" href="/styles/chatstyle.css"/>
 <script type="text/javascript" src="/chat/java/chatdisplay.js"></script> 
<script type="text/javascript" src="/chat/java/jcookie.js"></script> 

<?php }

function showchat(){
?>
<div class="window" id="window1"> 
   
    <div class="bar"> 
        <div class="icon"><p>Site Raiser Chat</p></div> 
        <div class="buttons"> 
            <div onclick="minimize();" class="min"></div> 
             <!--<div class="max"></div> -->
            <div class="close"></div> 
        </div> 
    </div> <div class="main"><span style="margin:3px 0px 0px 5px ;"> Users:</span>
    <div id="content" class="box"> 
    	<ul>
       		<li>Welcome</li>	
	</ul>
    </div>
      <div id="userbox" class="userbox">
      <ul id="users">      
      </ul>      
      </div>
    </div> 
<br style="clear:both;"/>
<div class="bottom" >
    <form id="inform" method="post">
	<input id="msg1" type="text" autocomplete="off"/>
	 <input class="send" type="submit" name="submit" value="Send" />
</form>
</div> </div> 
 <div class="minibar1" id="minibar1">   
    <div class="minibar"> 
        <div class="icon"><div class="favicon"><p>Site Raiser Chat</p></div></div> 
        <div class="buttons"> 
            <!--   <div onclick="minimize();" class="min"></div> -->
            <div onclick="maximize();" class="max"></div> 
           <!-- <div class="close"></div>--> 
        </div> 
    </div>
</div><script>
	
	
	  var add = $('#msg1').val();
  
   var time = '';

  function reask() {  
  
  if($.cookie('user') != null){
    user = $.cookie('user');
}
if($.cookie('date') != null){
    date = $.cookie('date');
}
var ask='1';/*Store new html*/
var url = 'http://'+location.host+"/chat/chatcore.php?user="+user+"&time="+time+"&"+Math.floor((Math.random()*10000)+1)+"="+Math.floor((Math.random()*10000)+1);

if (window.XMLHttpRequest)
  {/* code for IE7+, Firefox, Chrome, Opera, Safari*/
  xmlhttp=new XMLHttpRequest();
  }
else
  {/* code for IE6, IE5*/
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    str=xmlhttp.responseText;var data = JSON.parse(str);

 
     var msg = ''; var usr = ''; var restart = '';
        for(var key in data) { 
           if(key=='msg') {msg = data[key];}
    	 if(key=='usr') {usr = data[key];} 
    	 if(key=='time') {time = data[key];}
    	 if(key=='restart') {restart = data[key];} 
   if(key=='allusers') {allusers = data[key];document.getElementById("users").innerHTML=allusers;}
     if(key=='newuser') {newuser = data[key];$.cookie("user", newuser);} /*Store*/
   
    
     }
    	 
   
    if(restart !='rsrtagain123' ){
    $("#content ul").append('<li><span class="tab">'+usr+': '+msg+'</span></li>');/*append new Items*/
	 	$(".box").scrollTop($(".box")[0].scrollHeight);	}
	reask();
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
  
	
	var user='';
	var sdate='';
	
 $(document).ready(function() {
 
 if($.cookie('user') != null){
    user = $.cookie('user');
}
 if($.cookie('date') != null){
    sdate = $.cookie('date');
}
 
 
 var str='1';var ask='1';/*Store new html*/
var url = 'http://'+location.host+"/chat/chatcore.php?user="+user+"&date="+sdate+"&"+Math.floor((Math.random()*10000)+1)+"="+Math.floor((Math.random()*10000)+1);
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {/* code for IE7+, Firefox, Chrome, Opera, Safari*/
  xmlhttp=new XMLHttpRequest();
  }
else
  {/* code for IE6, IE5*/
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    { str=xmlhttp.responseText;var data = JSON.parse(str);

 
     var msg = ''; var usr = ''; var restart = '';var all='';var newuser='';var allusers='';
        for(var key in data) { 
           if(key=='msg') {msg = data[key];}
    	 if(key=='usr') {usr = data[key];} 
    	 if(key=='time') {time = data[key];}
    	 if(key=='restart') {restart = data[key];}   
    	 if(key=='all') {all = data[key];} 
    	 if(key=='allusers') {allusers = data[key];$("#userbox ul").append(allusers);}
   if(key=='newuser') {newuser = data[key];} 
   if(key=='date') {sdate = data[key];}
   
    $.cookie("user", newuser);/*Store*/
     $.cookie("date", sdate);/*Store*/
    
    
     }
    	
$("#content ul").append(all);$(".box").scrollTop($(".box")[0].scrollHeight);
   
	 	reask();	  
	 
    }
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();

});

var ajaxInProgress = false;
$('#inform').submit(function() {  
 /* alert('Handler for .submit() called.');*/
 
  var add = $('#msg1').val();
 

 var str='1';
  function sendform() {ajaxInProgress = true;var url1 = 'http://'+location.host+"/chat/chatadd.php?user="+user+"&add="+add+"&"+Math.floor((Math.random()*10000)+1)+"="+Math.floor((Math.random()*10000)+1);
if (add=="") 
  {
ajaxInProgress = false;
  return false; 
  }   
if (window.XMLHttpRequest)
  {
  xmlhttp1=new XMLHttpRequest();
  }
else
  {
  xmlhttp1=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp1.onreadystatechange=function()
  { 
  if (xmlhttp1.readyState==4 && xmlhttp1.status==200)
    {/*$("#content ul").append('<li><a href="/user/messages"><span class="tab">'+xmlhttp1.responseText+'</span></a></li>');append new Items*/
	 document.getElementById("msg1").value="";	$(".box").scrollTop($(".box")[0].scrollHeight);	
	
ajaxInProgress = false;
    }
  }
xmlhttp1.open("GET",url1,true);
xmlhttp1.send();
}
  if (ajaxInProgress !==true) 
  {

 	sendform();
  }
 return false; 

});
</script>


<?php
}?>