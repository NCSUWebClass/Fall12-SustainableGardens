<html lang="en">
    <head>
		<meta charset="UTF-8"> 
		<link rel="stylesheet" href="style1.css">
		<title>CSC 342 Project Practice</title>
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
			.cell{padding:1%; position:relative; margin:auto;}
			.cell2{padding-left:17%; margin:auto;}
			.buttons{ width:10%; margin:auto;}
			a:hover{color:red;}
			img.plantImage{width:300px; height:300px}

		</style>
    </head>





<?php include('access.php');

	//Store variables from form
	$plantName = $_POST['plantname'];
	$discription = $_POST['elm1'];
	$fileName = $_FILES['changeimage']['name']; 
	$dat_path = getcwd()."/flowers/".$_POST['plantname']."/";

	//build path name to upload image to
	$upload_path = $_POST['plantname']; 
	$upload_path = "/flowers/".$upload_path."/";
	$upload_path = getcwd().$upload_path;

	//Declare Variables
	$uploadFormAddress = "http://ecard.comule.com/uploadform.php";
	

	//Check for new image file
	if(!($fileName == "")){

		//Configuration - Image Options
		$allowed_filetypes = array('jpg','gif','bmp','png'); // These will be the types of file that will pass the validation.
		$max_filesize = 5242880; // Maximum filesize in BYTES (currently ~5MB).
		$ext = end(explode(".", $_FILES['changeimage']['name']));

		//Check if the filetype is allowed, if not DIE and inform the user.
		if(!in_array($ext,$allowed_filetypes)){

			die('<fieldset><legend>ERROR</legend><div class="cell"><span class="label label-important">Error: The file you attempted to upload is not allowed.  Attempted: '.$ext.'</span></div><br><br><div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div></fieldset>');
		}
		
		//	Now check the filesize, if it is too large then DIE and inform the user.
		if(filesize($_FILES['changeimage']['tmp_name']) > $max_filesize){

			die('<fieldset><legend>ERROR</legend><div class="cell"><span class="label label-important">Error: The file you attempted to upload is too large.</span></div><br><br><div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div></fieldset>');

		}


		//Upload the file to your specified path.
		if(move_uploaded_file($_FILES['changeimage']['tmp_name'],$upload_path."image.jpg")){
			echo '<span class="label label-success">'.$plantName.' image was updated: </span>';	// It worked.
		}else{

			die('<fieldset><legend>ERROR</legend><div class="cell"><span class="label label-important">Error: There was an error during the file upload.  Please try again.</span></div><br><br><div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div></fieldset>');

		}
	}//End if new image file was selected
	else{
		echo'<span class="label label-info">'.$plantName.' image was not changed: </span>';
	}//End of new image if/else statement 
	

	
	//Remove escape characters from the discription string
	$discription = str_replace("\\","",$discription);

	//Save New Discription
	file_put_contents($dat_path."discription.txt",$discription);
	

	
	//Show current plant image
	echo('<br/><img class="plantImage" src="');
	echo "http://ecard.comule.com/flowers/".$plantName."/image.jpg";
	echo '" width="100" height="100"><br/>';
	
	//Show Plant Discription
	echo('<br/><fieldset><legend>Discription</legend>');
	echo($discription);
	echo('</fieldset>');
	echo('<br/><span class="label label-success">'.$plantName.' has been updated.      </span><a class="btn"href="'.$uploadFormAddress.'">Ok</a>');




?>

</html>