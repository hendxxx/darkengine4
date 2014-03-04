<?php 
	echo $html->includeJs('jscripts/ajax');
	echo $html->includeJs('jscripts/trims');
?>

<script language="javascript">

function jumpTo(path,confirmMessage) {
	var answer = confirm(confirmMessage);
	if (answer == 1)	{
		location.href = path;
	}
	
}

function show_panel(text,text_show,text_hide,panel,source){

	if (document.getElementById(panel).style.display=='none'){
		document.getElementById(panel).style.display="";
		document.getElementById(source).innerHTML=text_hide;
	}else{
		document.getElementById(panel).style.display='none';
		document.getElementById(source).innerHTML=text_show;
	}
	
}


function load_data_parent(path){
	InitAJAX();
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			h=ajax.responseText;
			document.adminform["page_level"].value = parseInt(h);
		}else{
			document.adminform["page_level"].value ='Please wait...';
		}
    }
    ajax.open("GET",path);
    ajax.send(null);
   
    
}

function load_data_from(path,result){
	InitAJAX();
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			document.getElementById(result).innerHTML=ajax.responseText;
		}else{
			document.getElementById(result).innerHTML='Please wait...';
		}
    }
    ajax.open("GET",path);
    ajax.send(null);
    
}
function GoToURL(j) {
	var location=(j);
	this.location.href = location;
}
function displayHTML(url,title) {
	win = window.open(url + '&title=' + title,'win','width=800,height=600 ,scrollbars = yes, toolbar = no, status = no');
}
function PrintNow(win){
	this.print();
	this.close();
}
function CustomConfrim(text){
	if(confirm(text)){
	return true;
	}
	else return false;
}
function validate_required(field,alerttxt){
	with (field){
		
		if (value==null || trim(value)=="")
			{alert(alerttxt);return false;}
		else {return true;}
	}
}

function validate_required_email(field,alerttxt){
	with (field)
	  {
	  apos=value.indexOf("@");
	  dotpos=value.lastIndexOf(".");
	  if (apos<1||dotpos-apos<2)
	    {alert(alerttxt);return false;}
	  else {return true;}
	  }
}

 
</script>
