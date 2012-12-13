<? include("access.php");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8"> 
		<link rel="stylesheet" href="style1.css">
		<title>E-card Management Tool</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<style>
			#wrapper { margin: 0 auto; width: 999px; }
			#tabs { margin: 10px 0 0 0; }
			#newimage .catImages{max-height:300px; max-width:300px; }
			#imageTable img{height:80%; width:80%; }
			.center{width:80%; height:80%; margin:auto; padding:20px;}
			.cell{height:150px; padding:2%;}
			.buttons{ width:85%; margin:auto;}
			.btnpad{padding-right:2cm;}
			td:hover{color:yellow; background-color:black;}
		</style>
    </head>
	<script type="text/javascript" src="/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
function setup() {
   tinyMCE.init({
      mode : "textareas",
      theme : "advanced",
      plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
      theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
      theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
      theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
      theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
      theme_advanced_toolbar_location : "top",
      theme_advanced_toolbar_align : "left",
      theme_advanced_statusbar_location : "bottom",
      theme_advanced_resizing : true
   });
}


function getcatboxes(){

		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.open("GET","cat.xml",false);
		xmlhttp.send();
		xmlDoc=xmlhttp.responseXML; 
		var x=xmlDoc.getElementsByTagName("category");
		for (i=0;i<x.length;i++)
		  { 
		  var tempname = x[i].getElementsByTagName("name")[0].childNodes[0].nodeValue;
		  var tempdisname = x[i].getElementsByTagName("displayname")[0].childNodes[0].nodeValue;
		  document.write('<input type="checkbox" name="picType" value="');
		  document.write(tempname);
		  document.write('"/>');
		  document.write(tempdisname);
		  document.write(' <br>');

		  }
		
}
</script>


	<script>

	function validateFile(filename){
	 
	
	 var namelength = filename.length;
	 var dotposition = filename.lastIndexOf('.');
	 var extention = filename.substring(dotposition+1,namelength);
	 extention.toLowerCase();
	 //Look for valid extention
	if((extention !== "gif") && (extention !== "jpg") && (extention !== "png") ){
	   alert("You may only select image files." + "\n" + ".gif, .jpg, .png");
	   var temp = document.getElementById('uploadFile');
	   if(temp != null){
			document.getElementById('uploadFile').innerHTML = temp.innerHTML;
		}
	 } else {
		alert("Extention: " + extention + " is valid.");
	 }
	}
	
	
	function loadForm(formtype){
	  var temp = formtype;
	  document.getElementById("newimage").innerHTML = temp;
		
		if (window.XMLHttpRequest)
	    {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
	    {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
	    {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("newimage").innerHTML=xmlhttp.responseText;
			}
		 }

		 //Build String to call proper php form file
		 temp = temp.concat(".php");
		 temp = "./".concat(temp);
		 
		xmlhttp.open("GET",temp,false);
		xmlhttp.send();
		setup();

		
		
	}


	//Function to load edit image form
	function editimageform(image){

		if (window.XMLHttpRequest)
	  	  {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
	          }
		else
	    {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
	    {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("newimage").innerHTML=xmlhttp.responseText;
			}
		 }
		 
		xmlhttp.open("GET","editimageform.php?type="+image,false);
		xmlhttp.send();
		setup();


	}

	//Function to load the edit category form
	function loadeditcatform(cat){

		if (window.XMLHttpRequest)
	  	  {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
	          }
		else
	    {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
	    {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("newimage").innerHTML=xmlhttp.responseText;
			}
		 }
		 
		xmlhttp.open("GET","editcatform.php?type="+cat,false);
		xmlhttp.send();
		setup();


	}


	//Load the remove category form
	function loadremovecatform(cat){

		if (window.XMLHttpRequest)
	  	  {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
	          }
		else
	    {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
	    {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("newimage").innerHTML=xmlhttp.responseText;
			}
		 }
		 
		xmlhttp.open("GET","removecatform.php?type="+cat,false);
		xmlhttp.send();
		setup();




	}
	



	//Save image and discription, called from editimageform
	function saveDiscription(){
		if (window.XMLHttpRequest)
	  	  {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
	          }
		else
	    {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
	    {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("newimage").innerHTML=xmlhttp.responseText;
			}
		 }
		 
		xmlhttp.open("GET","saveDiscription.php",false);
		xmlhttp.send();


	}


	//Checks the images that belong to a category, called by editcatform.php
	function selectcatimages(categoryImages, checkBoxes){
		
		document.write("Hello");		


		//Loop through images checking cooresponding boxes
		for(i=0; i< categoryImages.length;i++){
			var found = false;
			for(j=0; j<checkBoxes.length; j++){
				
				//Is this the box?
				if(categoryImages[i] == checkBoxes[j].value){
					checkBoxes[j].checked = true;
					found = true;
				}		
			
			}
				

		}


	}


	//Removes an image from a category
	function removeImage(imageName, catName){

		
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}

			xmlhttp.open("GET","removeImageFromCat.php?image='"+imageName+"'&cat='"+catName+"'",false);
			xmlhttp.send();
			loadeditcatform(catName);
			
	}


	//Removes an image from a category
	function addImage(imageName, catName){
		
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}


			xmlhttp.open("GET","addImageToCat.php?image='"+imageName+"'&cat='"+catName+"'",false);
			xmlhttp.send();
			loadeditcatform(catName);
			

	}

	//Loads the remove image form
	function loadremoveimageform(image){

		if (window.XMLHttpRequest)
	  	  {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
	          }
		else
	    {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
	    {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("newimage").innerHTML=xmlhttp.responseText;
			}
		 }
		 
		xmlhttp.open("GET","removeimageform.php?type="+image,false);
		xmlhttp.send();
		setup();




	}
	


		</script>

	<body>
	<div id="wrapper">
		<div id="tabs">
			<div class="well">
				<div class="buttons">
				<button class="btn" onclick = 'loadForm("newcardform")'>New Picture</button>
				<button class="btn" onclick = 'loadForm("editimage")'>Edit Picture</button>
				<span class="btnpad"><button class="btn" style="padding-right="50px" onclick = 'loadForm("removeimgpreform")'>Remove Picture</button></span>
				<button class="btn" onclick = 'loadForm("createcatform")'>New Category</button>
				<button class="btn" onclick = 'loadForm("editcatpreform")'>Edit Category</button>
				<button class="btn" onclick = 'loadForm("removecatpreform")'>Remove Category</button>

				</div>
			</div>
		</div>
		<div id= "newimage"></div>
	</div>

	</body>
</html>