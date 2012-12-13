<!DOCTYPE html>
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

			.cell{padding:1%; position:relative;}
			.cell2{padding-left:15%; margin:auto;}
			.center{width:70%; margin:auto;}
			img.plantImage{width:300px; height:300px;}

		</style>
    </head>



<?php include('access.php');

// NEED TO MAKE SURE TO TEST THAT ALL INPUT HAS BEEN PROVIDED


	//Store variables from form
	$plantName = $_POST['plantname'];
	$discription = $_POST['elm1'];
	$cat = $_POST['category'];
	$fileName = $_FILES['fileupload']['name']; 
	$dat_path = "/".$_POST['plantname']."/";

	//Validate Form Data
	if($plantName == ""){

		die('<fieldset><legend>ERROR</legend><div class="cell"><span class="label label-important">Error: Plant name not defined.  Try again.</span></div><br><br><div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div></fieldset>');

	}else if($fileName=="" ){


		die('<fieldset><legend>ERROR</legend><div class="cell"><span class="label label-important">Error: Image file not selected.  Try again.</span></div><br><br><div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div></fieldset>');


	}else if(count($cat)==0){

		die('<fieldset><legend>ERROR</legend><div class="cell"><span class="label label-important">Error: No categories were selected.  Try again.</span></div><br><br><div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div></fieldset>');

	}else if($discription == ""){

		die('<fieldset><legend>ERROR</legend><div class="cell"><span class="label label-important">Error: Plant discription was not provided.  Try again.</span></div><br><br><div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div></fieldset>');
	}





	//Remove escape characters from the discription string
	$discription = str_replace("\\","",$discription);

	//Configuration - Your Options
	$allowed_filetypes = array('jpg','gif','bmp','png'); // These will be the types of file that will pass the validation.
	$max_filesize = 5242880; // Maximum filesize in BYTES (currently ~5MB).
	$ext = end(explode(".", $_FILES['fileupload']['name']));

	//build path name to upload image to
	$upload_path = $_POST['plantname']; 
	$upload_path = "/flowers/".$upload_path."/";
	$upload_path = getcwd().$upload_path;

	//Check if the filetype is allowed, if not DIE and inform the user.
	if(!in_array($ext,$allowed_filetypes)){

		die('<fieldset><legend>ERROR</legend><div class="cell"><span class="label label-important">Error: The file you attempted to upload is not allowed.  Try again.</span></div><br><br><div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div></fieldset>');
	}
	
	//Now check the filesize, if it is too large then DIE and inform the user.
	if(filesize($_FILES['fileupload']['tmp_name']) > $max_filesize){

		die('<fieldset><legend>ERROR</legend><div class="cell"><span class="label label-important">Error: The file you attempted to upload is too large.  Try again.</span></div><br><br><div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div></fieldset>');
	}
	
	//Check that directory doesn't already exist
	if(is_dir($upload_path)){


		die('<fieldset><legend>ERROR</legend><div class="cell"><span class="label label-important">Error: The flower name you used already exist.  Please modify or change the name.</span></div><br><br><div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div></fieldset>');

	}else{ 
		//Create directory for image
		mkdir($upload_path, 0700);
	}

	//Upload the file to your specified path.
	if(move_uploaded_file($_FILES['fileupload']['tmp_name'],$upload_path."image.jpg")){
		echo '<span class="label label-info">'.$plantName.' image upload was successful.</span><br/>'; // It worked.
	}else{

		die('<fieldset><legend>ERROR</legend><div class="cell"><span class="label label-important">Error: There was an error during the file upload.  Please try again.</span></div><br><br><div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div></fieldset>');
 
	}

	//Create discription.txt 
	$ourFileName = $upload_path."discription.txt";
	$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
	$discriptionText = $discription;
	fwrite($ourFileHandle,$discriptionText);
	fclose($ourFileHandle);


	//Add image to selected categories
	$cat = $_POST['category'];
	if(empty($cat)){
		die('You didn\'t select a category');
	} else {
		$count = count($cat);
		for($i=0; $i < $count ; $i++){
			$datafile = getcwd()."/categories/".$cat[$i].".dat";
			$ourFileHandle = fopen($datafile, "a") or die("Category File Does not exist");
			fwrite($ourFileHandle, $dat_path."\n");
			fclose($ourFileHandle );
		}
	}

	//Add image to images.xml
	$xml = simplexml_load_file("images.xml");
	$card = $xml->addChild('image');

	//Add plant name
	$card->addChild('name', $plantName);

	//Add Categories
	for($i=0; $i<$count ; $i++){
		$card->addChild('cat', $cat[$i]);
	}

	//Save new node
	file_put_contents('images.xml', $xml->asXML());
	
	
	//Display Plant Saved Information

	//plant image
	echo('<br/><img class="plantImage" src="');
	echo "http://ecard.comule.com/flowers/".$plantName."/image.jpg";
	echo '" width="300" height="300"><br/>';
	
	//Discription
	echo('<br/><fieldset><legend>Discription</legend>');
	echo($discription);
	echo('</fieldset>');


	//Categories
	echo('<fieldset><legend>Categories</legend><ul>');
	for($i=0; $i<$count ; $i++){
		echo('<li>'.$cat[$i].'</li>');	
		//echo('<br />');
	}

	echo('</ul></fieldset><br/><div class="center"><span class="label label-success">Card has been created</span>   <br/><br/>');
	echo('<a href="uploadform.php" class="btn btn-large btn-primary">Ok</a></div>');
	
	
?>
<body>
</body>
</html>