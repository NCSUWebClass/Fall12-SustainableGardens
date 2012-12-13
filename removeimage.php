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

$imageName = $_POST['imagename'];

$imageArray[0]="";
$i=0;


//Build Cat array from images.xml and remove image node
	$file = "images.xml";
	$fp = fopen($file, "rb") or die("cannot open file");
	$str = fread($fp, filesize($file));
	fclose($fp);

	$xml = new DOMDocument();
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = false;
	$xml->loadXML($str) or die("Error");

	$root = $xml->documentElement;
	$fnode = $root->getElementsByTagName('image');

	foreach($fnode as $child){
		
		$tempname = $child->getElementsByTagName('name');
		$tempp = $child->getElementsByTagName('cat');
		$tname = $tempname->item(0)->nodeValue;

		if(strcmp($tname,$imageName)==0){

			foreach($tempp as $t){
				
				$tcat = $t->nodeValue;
				$imageArray[$i]=$tcat;
				$i++;

			}
			
			$root->removeChild($child);
			break;

		}

	}

file_put_contents("images.xml",$xml->saveXML());


$newImageList[0] = "";
$size = count($imageArray);

//loop to cycle through imageArray and remove image from category.dat files
for($i=0; $i<$size; $i++){
	$catPath = getcwd()."/categories/";
	$catPath = $catPath.trim($imageArray[$i]).".dat";


	//Get images from dat file
	$catImages = file($catPath);
	$catSize = count($catImages);


	$j=0;
	for($w=0;$w<$catSize; $w++){

		if(strcmp(trim($catImages[$i]), $imageName)!=0){
	
			$newImageList[$j] = $catImages[$i];
			$j++;
		
		}
	}

	

	//update dat file
	file_put_contents($catPath, $newImageList);

}


$pathImage = getcwd()."/flowers/".$imageName;

//Remove Discription.txt
unlink($pathImage."/discription.txt");

//Remove Image
unlink($pathImage."/image.jpg");

//Remove directory
rmdir($pathImage);



echo('<br>'.$imageName.' has been removed</fieldset>');

echo('<div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div>');






?>