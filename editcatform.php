<?php

	//Get image name
	$catName = $_REQUEST['type'];

	//Open category.dat file and get content
	$filename = $catName.".dat";
	$images = file(getcwd()."/categories/".$filename);
	$discript1 = getcwd();
	
	//Create variable for array index
	$i = 0;
	
	//create array of images that belong to category
	foreach($images as $values){
		$imageName[$i] = str_replace('/', '', $values);
		$i++;

	}

	//Start form
	echo('<fieldset ><form id="editcatform" name="cateditform" action="" method="post" enctype="multipart/form-data">');
	
	//Category Name
	echo('Category: <input type="text" name="catname" value="');
	echo($catName);
	echo('" readonly><br /><br />');


	//Load images
	$xml = simplexml_load_file("images.xml");

	//Form heading
	echo('<fieldset><legend>Images:</legend>');
	echo '<table table id = "imageTable" width="999px" border = "1"><tr>';

	$number = 1;
	//Create check box for each image
	foreach($xml->children() as $child)
	{
 	
		//boolean to track if category contains the image
		$catcontainsimage = 0;

		echo('<td class="cell"><div id="images" class="center">');
		//echo('<input type ="checkbox" name="imagecatcheck" value ="');
		echo('<span class="label label-info">'.$child->name.'</span>');
		//echo($child->name);
		//echo('" ');
		
		//Check if this is an associated image
		for($i=0;$i < count($imageName); $i++){

			$current = $child->name;

			//If 
			if(strcmp(trim($imageName[$i]), $current)== 0){
				//echo('checked');

				//Category contains image
				$catcontainsimage=1;
				break;		
			}
		
		}

		//echo('>');
		//echo($child->name);
		echo('<br/>');
		echo'<img class="catImages" src="';
		echo "http://ecard.comule.com/flowers/".$child->name."/image.jpg";
		echo '" width="50" height="50"><br>';


		//Create button to add/remove image to category
		if($catcontainsimage == 1){
		
			echo '<ul class="nav nav-pills"><li class="buttons" onclick="removeImage(\''.$child->name.'\',\''.$catName.'\')"><a href="#">Remove</a></li></ul> ';
		
		} else {

			echo '<ul class="nav nav-pills"><li class="buttons" onclick="addImage(\''.$child->name.'\',\''.$catName.'\')"><a href="#">Add</a></li></ul> ';

		}

		echo'</div></td>';
		if($number == 5) {
			echo '</tr><tr>';
			$number = 1;
		} else {
			$number++;
		}
	}

	//End fieldset
	echo('</tr></table></fieldset>');

	


	//Script to check images that belong to category
	//echo '<script>selectcatimages('.$imageName.', document.cateditform.imagecatcheck)</script>';
	
	
	//Submit for button
	echo('<br /><input type="submit" class="btn btn-primary" value="Save Changes"></form></fieldset >');

?>
