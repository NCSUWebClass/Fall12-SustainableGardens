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
			img{width:300px; height:300px}

		</style>
    </head>





<?
	//Store category name and images
	$catName = $_POST['catname'];
	$images = $_POST['images'];

	//Check that $catName is not empty
	if($catName == ""){

		die('<fieldset><legend>ERROR</legend><div class="cell"><span class="label label-important">Error: Category name was not defined.  Try again.</span></div><br><br><div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div></fieldset>');

	}else{

	    $catName = " ".$catName;
	
	}



	//Load category xml file
	$xml = simplexml_load_file("cat.xml");


	//Check if cat already exist
	foreach($xml->children() as $child){
	
		$tempName = $child->name;
		//echo $tempName;

		if(strcmp($tempName, $catName)== 0){

			die('<span class="label label-warning">Category already exist. Try again</span><br/><br/><span class="badge badge-info"><a href="http://ecard.comule.com/uploadform.php">Ok</a></span>');
		}
	
	}

	//Category does not exist so add to xml and create a dat file
	
	//create new node
	$newCat = $xml->addChild('category');
	$newCat->addChild('name',$catName);
	$newCat->addChild('displayname', $catName);

	//Add Node to xml file
	file_put_contents('cat.xml',$xml->asXML());







	//Create .dat file and add images
	$datFile = getcwd()."/categories/".$catName.".dat";
	$ourFileHandle = fopen($datFile , "w") or die("Category File Does not exist");
	$count = count($images);


	for($i = 0; $i < $count ; $i++){		
		//Add image
		fwrite($ourFileHandle, "/".$images[$i]."/\n");


		}	

	fclose($ourFileHandle);	





	//add Cat from images.xml
	$file = "images.xml";
	$fp = fopen($file, "rb") or die("cannot open file");
	$str = fread($fp, filesize($file));
	fclose($fp);

	$xml = new DOMDocument();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->loadXML($str) or die("Error");


for($i=0;$i<$count;$i++){	
	$imageName = $images[$i];
	$root = $xml->documentElement;
	$fnode = $root->getElementsByTagName('image');

	foreach($fnode as $child){
		
		$tempname = $child->getElementsByTagName('name');
		$tempp = $child->getElementsByTagName('cat');
		$tname = $tempname->item(0)->nodeValue;



		if(strcmp($tname,$imageName)==0){

			$newCat = $xml->createElement('cat');
			$catText = $xml->createTextNode($catName);
			$newCat->appendChild($catText);
			$child->appendChild($newCat);
			
			break;

		}




	}
}

file_put_contents("images.xml",$xml->saveXML());











	//Display information
	echo ('Category: '.$catName.' has been created.<br/><br/>');
	echo ('<fieldset><legend>Images Associated With Category</legend>');


	for($i = 0; $i < $count ; $i++){		
		echo('<img src="');
		echo "http://ecard.comule.com/flowers/".$images[$i]."/image.jpg";
		echo '" width="300" height="300">';	
	}

	echo('</fieldset><br><br><div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div>');


?>

<body></body></html>