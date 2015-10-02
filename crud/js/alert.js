$(document).ready(function(){
	var mod = window.location.search.replace("?mod=", "");
	if(mod == 1)
	{	
		$("#alert").fadeIn(1000);
		setTimeout(function(){$("#alert").fadeOut(1000);}, 2000);
		
		setTimeout(function(){
			window.location.href = window.location.href.replace("?mod=1","")	
		}, 3000);
	}
	if(mod == 0 && mod != "")
	{
		$("#alert").fadeIn(1000);
		setTimeout(function(){$("#alert").fadeOut(1000);}, 2000);
		
		setTimeout(function(){
			window.location.href = window.location.href.replace("?mod=0","")	
		}, 3000);
	}
	
	var del = window.location.search.replace("?del=", "");
	if(del == 1)
	{	
		$("#alert").fadeIn(1000);
		setTimeout(function(){$("#alert").fadeOut(1000);}, 2000);
		
		setTimeout(function(){
			window.location.href = window.location.href.replace("?del=1","")	
		}, 3000);
	}
	if(del == 0 && del != "")
	{
		$("#alert").fadeIn(1000);
		setTimeout(function(){$("#alert").fadeOut(1000);}, 2000);
		
		setTimeout(function(){
			window.location.href = window.location.href.replace("?del=0","")	
		}, 3000);
	}
	
	var ins = window.location.search.replace("?ins=", "");
	if(ins == 1)
	{	
		$("#alert").fadeIn(1000);
		setTimeout(function(){$("#alert").fadeOut(1000);}, 2000);
		
		setTimeout(function(){
			window.location.href = window.location.href.replace("?ins=1","")	
		}, 3000);
	}
	if(ins == 0 && ins != "")
	{
		$("#alert").fadeIn(1000);
		setTimeout(function(){$("#alert").fadeOut(1000);}, 2000);
		
		setTimeout(function(){
			window.location.href = window.location.href.replace("?ins=0","")	
		}, 3000);
	}
});