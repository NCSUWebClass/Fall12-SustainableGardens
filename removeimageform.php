		<style>

			img{width:300px; height:300px}

		</style>








<?include("access.php");


$image=  $_REQUEST['type'];

if($image == ""){

	die('Image not selected.');

}

echo('<fieldset ><legend>Delete Image?</legend><form id="editimageform" action="removeimage.php" method="post" enctype="multipart/form-data">');

//Image Name
echo('Name: <input type="text" name="imagename" value="');
echo($image);
echo('" readonly><br/><br/>');


//Display image
echo'<img src="';
echo "http://ecard.comule.com/flowers/".$image."/image.jpg";
echo '" width="300" height="300"><br/><br/>';
	


//Submit for button
echo('<input type="submit" class="btn btn-primary" value="Delete Image"></form></fieldset >');


?>


</html>