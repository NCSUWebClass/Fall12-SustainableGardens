<?php include('access.php');

	//Get image name
	$imageName = $_REQUEST['type'];

	//Start form
	echo('<fieldset ><form id="editimageform" action="updateImage.php" method="post" enctype="multipart/form-data">');
	


	//Plant Name
	echo('Name: <input type="text" name="plantname" value="');
	echo($imageName);
	echo('" readonly><br/><br/>');

	//Input tag to change image
	echo('<fieldset><legend>Change '.$imageName.' Image</legend><div id="uploadFile">');
	echo('<input type="file" accept="image/*" name="changeimage" onchange="validateFile(this.value)" id="fileupload" value="New Image"><br/></div></fieldset>');
	
	
	//Display image
	echo'<img src="';
        echo "http://ecard.comule.com/flowers/".$imageName."/image.jpg";
	echo '" width="500" height="500"><br/><br/>';
	

	//Get Discription from text file
	$discription = file_get_contents(getcwd()."/flowers/".$imageName."/discription.txt");

	//Put discription in textarea
	echo('<br />Edit '.$imageName.' Description: <textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%" onload="javascript:setup()">');
	echo($discription);
	echo('</textarea><br />');

	//Call webpage script to initiate advanced textbox
	echo('<script type="text/javascript">setup()</script>');
	
	//Submit for button
	echo('<input type="submit" class="btn btn-primary" value="Save Changes"></form></fieldset >');

?>