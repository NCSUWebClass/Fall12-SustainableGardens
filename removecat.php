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

		</style>
    </head>



<?
$cat =  $_POST['catname'];

if($cat==""){
	die('Category was not selected');
}



$path = getcwd()."/categories/".$cat.".dat";
$imageArray = file($path);
$imageCount = count($imageArray);
$catName = $cat;

echo('<fieldset><legend>Removing '.$catName.'</legend>');

//Remove Cat from images.xml
$file = "images.xml";
$fp = fopen($file, "rb") or die("cannot open file");
$str = fread($fp, filesize($file));
fclose($fp);

$xml = new DOMDocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->loadXML($str) or die("Error");



echo('<ul>');


//Loop through array removing cat from image nodes in images.xml
for($i=0; $i<$imageCount; $i++){



	$imageName= str_ireplace("/","", trim($imageArray[$i]));
	$root = $xml->documentElement;
	$fnode = $root->getElementsByTagName('image');

	foreach($fnode as $child){
		
		$tempname = $child->getElementsByTagName('name');
		$tempp = $child->getElementsByTagName('cat');
		$tname = $tempname->item(0)->nodeValue;



		if(strcmp($tname,$imageName)==0){
			

			foreach($tempp as $t){
				
				$tcat = $t->nodeValue;
				if(strcmp($tcat,$catName)==0){
					$child->removeChild($t);
					echo('<li>Removed from '.$tname.' node</li>');
					break;	
								
				}

			}

			break;

		}

	}






}

echo('</ul><br>');
file_put_contents("images.xml",$xml->saveXML());


//Remove Cat from images.xml
$file = "cat.xml";
$fp = fopen($file, "rb") or die("cannot open file");
$str = fread($fp, filesize($file));
fclose($fp);

$xml = new DOMDocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->loadXML($str) or die("Error");



	$root = $xml->documentElement;
	$fnode = $root->getElementsByTagName('category');


	foreach($fnode as $child){
		
		$tempname = $child->getElementsByTagName('name');
		$tname = $tempname->item(0)->nodeValue;


		foreach($tempname as $t){
			if(strcmp($tname,$catName)==0){
	
				$root->removeChild($child);
				echo('Removed node from category.xml<br><br>');
				break;

			}

		}
	}

file_put_contents("cat.xml",$xml->saveXML());


unlink($path);
echo('<br>'.$catName.'.dat file has been removed</fieldset>');

echo('<div class="cell2"><span class="btn"><a href="http://ecard.comule.com/uploadform.php">Return</a></span></div>');




?>

</html>