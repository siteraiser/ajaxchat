$(document).ready(function() {
	$('.window').css('display', 'block');//hidden in css, for no java
	$('.window').resize(function() {	$(".box").scrollTop($(".box")[0].scrollHeight);
	});

//for body resize

window.onresize=function(){if($.cookie('div1v') !='block'){
	wndsize();document.getElementById('minibar1').style.top = (h-35) +'px';
wndsize();document.getElementById('minibar1').style.left = (w-180) +'px';
	}
	};
	
	//$("#content ul").html($.cookie('content'));on reload set saved html
	
	//$("#content ul").append('<li><a href="/user/messages"><span class="tab">Welcome</span></a></li>');//append new Items
			
	//$.cookie("content", $("#content ul").html())Store new html
	
	
	//declare class window resizable and draggable, also define the values to be saved in cookie on resize and drag
	
	$('.window').resizable({
	
	containment: 'parent',
	handles: 'all',
	stop: function(event, ui) {
       $.cookie('div1w', $(this).width());
 $.cookie('div1h', $(this).height());
   $.cookie('div1x', $(this).css('left'));
       $.cookie('div1y', $(this).css('top')); 
       
        }
	
	
	}).draggable({
  containment: 'parent',
	handle:	'div.bar',
	 stop: function(event, ui) { 
        $.cookie('div1w', $(this).width());
 $.cookie('div1h', $(this).height());
   $.cookie('div1x', $(this).css('left'));
       $.cookie('div1y', $(this).css('top'));  
       }
	
	
	
	});
// n,e,s,w,se,sw,ne,nw, and you can also use 'all'
if($.cookie('div1x') != null){
    $('.window').css('left', $.cookie('div1x'));
}else{
    $('.window').css('left', '50px');
}
if($.cookie('div1y') != null){
    $('.window').css('top', $.cookie('div1y'));
}else{
    $('.window').css('top', '100px');
}

if($.cookie('div1w') != null){
    $('.window').css('width', $.cookie('div1w')+'px');
}else{
    $('.window').css('top', '100px');
}
if($.cookie('div1h') != null){
    $('.window').css('height', $.cookie('div1h')+'px');
}else{
    $('.window').css('top', '100px');
}




$(".box").scrollTop($(".box")[0].scrollHeight); //define all sizes then scroll to bottom (after loading a new page)




if($.cookie('div1v') !='block'){
$.cookie('div1v', 'none');
document.getElementById('window1').style.display = 'none';
document.getElementById('minibar1').style.display = 'block';
wndsize();document.getElementById('minibar1').style.top = (h-35) +'px';
wndsize();document.getElementById('minibar1').style.left = (w-180) +'px';
}

});

	
function wndsize(){	//retrieve current window width	and height	

if(!window.innerWidth){
    if(!(document.documentElement.clientWidth == 0)){
        //strict mode
        w = document.documentElement.clientWidth;h = document.documentElement.clientHeight;
    } else{
        //quirks mode
        w = document.body.clientWidth;h = document.body.clientHeight;
    }
} else {
    //w3c
    w = window.innerWidth;h = window.innerHeight;
}
return {width:w,height:h};
}
	
function minimize(){

 $.cookie('div1v', 'none');
document.getElementById('window1').style.display = 'none';
document.getElementById('minibar1').style.display = 'block';
wndsize();document.getElementById('minibar1').style.top = (h-35) +'px';
wndsize();document.getElementById('minibar1').style.left = (w-180) +'px';
}

function maximize(){ $.cookie('div1v', 'block');
document.getElementById('minibar1').style.display = 'none';
document.getElementById('window1').style.display = 'block';
}

/* $.cookie.settings = {
        path : "/"
       // domain : "example.com",
      //  expires : 2
    };
*/